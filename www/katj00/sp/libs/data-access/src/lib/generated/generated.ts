import { gql } from 'apollo-angular';
import { Injectable } from '@angular/core';
import * as Apollo from 'apollo-angular';
export type Maybe<T> = T | null;
export type InputMaybe<T> = Maybe<T>;
export type Exact<T extends { [key: string]: unknown }> = { [K in keyof T]: T[K] };
export type MakeOptional<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]?: Maybe<T[SubKey]> };
export type MakeMaybe<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]: Maybe<T[SubKey]> };
/** All built-in and custom scalars, mapped to their actual values */
export type Scalars = {
  ID: string;
  String: string;
  Boolean: boolean;
  Int: number;
  Float: number;
  /** A datetime string with format `Y-m-d H:i:s`, e.g. `2018-05-23 13:43:32`. */
  DateTime: any;
};

export type Mutation = {
  __typename?: 'Mutation';
  synchronize: SynchronizeResult;
};

/** Account of a person who utilizes this application. */
export type Project = {
  __typename?: 'Project';
  /** When the account reference was created. */
  created_at: Scalars['DateTime'];
  /** Unique primary key. */
  id: Scalars['ID'];
  name: Scalars['String'];
  /** Non-unique name. */
  node_id: Scalars['String'];
  owner_id: Scalars['String'];
  pushed_at: Scalars['DateTime'];
  /** When the account reference was updated. */
  updated_at: Scalars['DateTime'];
  visible: Scalars['Boolean'];
};

/** Indicates what fields are available at the top level of a query operation. */
export type Query = {
  __typename?: 'Query';
  /** Find a single user by an identifying attribute. */
  me?: Maybe<User>;
  projectTree?: Maybe<Array<Project>>;
};

export type SynchronizeResult = {
  __typename?: 'SynchronizeResult';
  timestamp: Scalars['DateTime'];
};

/** Reference of 3rd party account of a person who utilizes this application. */
export type User = {
  __typename?: 'User';
  avatar_url: Scalars['String'];
  /** When the account reference was created. */
  created_at: Scalars['DateTime'];
  /** Unique email address. */
  email: Scalars['String'];
  /** Unique primary key. */
  id: Scalars['ID'];
  name: Scalars['String'];
  /** Non-unique name. */
  node_id: Scalars['ID'];
  projects: Array<Project>;
  /** When the account reference was updated. */
  updated_at: Scalars['DateTime'];
  username: Scalars['String'];
};

export type GetProjectTreeQueryVariables = Exact<{ [key: string]: never; }>;


export type GetProjectTreeQuery = { __typename?: 'Query', projectTree?: Array<{ __typename: 'Project', node_id: string, name: string, pushed_at: any }> | null };

export type SynchronizeMutationVariables = Exact<{ [key: string]: never; }>;


export type SynchronizeMutation = { __typename?: 'Mutation', synchronize: { __typename: 'SynchronizeResult', timestamp: any } };

export type GetUserQueryVariables = Exact<{ [key: string]: never; }>;


export type GetUserQuery = { __typename?: 'Query', me?: { __typename: 'User', id: string, node_id: string, email: string, username: string, avatar_url: string, name: string } | null };

export const GetProjectTreeDocument = gql`
    query GetProjectTree {
  projectTree {
    node_id
    name
    pushed_at
    __typename
  }
}
    `;

  @Injectable({
    providedIn: 'root'
  })
  export class GetProjectTreeGQL extends Apollo.Query<GetProjectTreeQuery, GetProjectTreeQueryVariables> {
    document = GetProjectTreeDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }
export const SynchronizeDocument = gql`
    mutation Synchronize {
  synchronize {
    timestamp
    __typename
  }
}
    `;

  @Injectable({
    providedIn: 'root'
  })
  export class SynchronizeGQL extends Apollo.Mutation<SynchronizeMutation, SynchronizeMutationVariables> {
    document = SynchronizeDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }
export const GetUserDocument = gql`
    query GetUser {
  me {
    id
    node_id
    email
    username
    avatar_url
    name
    __typename
  }
}
    `;

  @Injectable({
    providedIn: 'root'
  })
  export class GetUserGQL extends Apollo.Query<GetUserQuery, GetUserQueryVariables> {
    document = GetUserDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }