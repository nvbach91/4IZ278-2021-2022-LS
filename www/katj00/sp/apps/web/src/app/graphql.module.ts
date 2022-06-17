import {NgModule} from '@angular/core';
import {ApolloModule, APOLLO_OPTIONS, gql} from 'apollo-angular';
import {ApolloLink, InMemoryCache} from '@apollo/client/core';
import {setContext} from "@apollo/client/link/context";
import {HttpLink} from 'apollo-angular/http';
import {LocalStorageWrapper, persistCacheSync} from "apollo3-cache-persist";
import {createPersistedQueryLink} from "apollo-angular/persisted-queries";
import {sha256} from 'crypto-hash';
const uri = 'http://localhost:8080/graphql'; // <-- add the URL of the GraphQL server here
export function createApollo(httpLink: HttpLink) {
  const persited = createPersistedQueryLink({sha256})
  const basic = setContext((operation, context) => ({
    headers: {
      Accept: 'charset=utf-8'
    }
  }));

  const auth = setContext((operation, context) => {
    const token = localStorage.getItem('access_token');

    if (token === null) {
      return {};
    } else {
      return {
        headers: {
          Authorization: `Bearer ${token}`
        }
      };
    }
  });

  const link = ApolloLink.from([persited, basic, auth, httpLink.create({uri})]);
  const cache = new InMemoryCache({
    typePolicies: {
      Query: {
        fields: {
          findProject: {
            keyArgs: ['name'],
            read: (existingData, {args, toReference}) => {
              return existingData ||
                toReference({__typename: 'Project', name: args?.['name']});
            }
          },
          findProjectInfo: {
            keyArgs: ['name'],
            read: (existingData, {args, toReference}) => {
              return existingData ||
                toReference({__typename: 'ProjectInfo', name: args?.['name']});
            }
          }
        }
      },
      Project: {
        keyFields: ['name']
      },
      Log: {
        keyFields: ['id']
      },
      ActivityLog: {
        keyFields: ['id']
      },
      ProjectInfo: {
        keyFields: ['name']
      },
      WorkData: {
        keyFields: ['id', 'represents']
      }
    }
  });
  persistCacheSync({
    cache,
    storage: new LocalStorageWrapper(localStorage),
  });
  return {
    link,
    cache,
    typeDefs: gql`
      extend type Query {
        findProject(id: ID, node_id: ID, name: String): Project!
        findProjectInfo(name: String!): ProjectInfo!
      }`
  }
}

@NgModule({
  exports: [ApolloModule],
  providers: [
    {
      provide: APOLLO_OPTIONS,
      useFactory: createApollo,
      deps: [HttpLink],
    },
  ],
})
export class GraphQLModule {
}
