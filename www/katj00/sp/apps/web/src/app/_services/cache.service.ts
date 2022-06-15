import {Injectable} from '@angular/core';
import {Apollo, gql} from "apollo-angular";
import {map} from "rxjs";

@Injectable({providedIn: 'root'})
export class CacheService {

  constructor(private readonly _apollo: Apollo) {
  }

  public selectedProject(projectName: string) {
    return this._apollo.client.readQuery<{ findProject: { id: string, name: string, __typename: 'Project' } }>({
      query: gql`
        query GET_PROJECT($name: String) {
          findProject(name: $name) {
            id
            name
            __typename
          }
        }`,
      variables: {name: projectName}
    });
  }


  public updateTimestamp(projectName: string) {
    this._apollo.client.cache.modify({
      id: this._apollo.client.cache.identify({__typename: "ProjectInfo", name: projectName}),
      fields: {
        status(cachedStatus) {
          return {...cachedStatus, timeSpent: cachedStatus.timeSpent + 1000}
        }
      }
    });
  }
}
