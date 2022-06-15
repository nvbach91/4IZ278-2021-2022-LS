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

export type Activity = {
  __typename?: 'Activity';
  created_at: Scalars['DateTime'];
  type: ActivityType;
  updated_at: Scalars['DateTime'];
  work: TrackedWork;
};

export type ActivityLog = {
  __typename?: 'ActivityLog';
  activities?: Maybe<Array<Activity>>;
  date: Scalars['DateTime'];
  id: Scalars['ID'];
};

/** Types of activity */
export enum ActivityType {
  Continue = 'CONTINUE',
  End = 'END',
  Pause = 'PAUSE',
  Start = 'START'
}

export type Commit = {
  __typename?: 'Commit';
  committedDate?: Maybe<Scalars['DateTime']>;
  messageHeadline: Scalars['String'];
  url?: Maybe<Scalars['String']>;
};

export type Count = {
  __typename?: 'Count';
  assignedCount: Scalars['Int'];
  totalCount: Scalars['Int'];
};

export type DateRange = {
  __typename?: 'DateRange';
  from?: Maybe<Scalars['DateTime']>;
  to?: Maybe<Scalars['DateTime']>;
};

export type DateRangeInput = {
  from: Scalars['DateTime'];
  to: Scalars['DateTime'];
};

export type Language = {
  __typename?: 'Language';
  name: Scalars['String'];
  size: Scalars['Int'];
};

export type Log = {
  __typename?: 'Log';
  id: Scalars['ID'];
  log: Array<Maybe<ActivityLog>>;
  name: Scalars['String'];
};

export type Mutation = {
  __typename?: 'Mutation';
  continueWork: Activity;
  deleteWork: TrackedWork;
  endWork: Activity;
  pauseWork: Activity;
  startWork: Activity;
  synchronize: SynchronizeResult;
};


export type MutationContinueWorkArgs = {
  id: Scalars['ID'];
};


export type MutationDeleteWorkArgs = {
  id?: InputMaybe<Scalars['ID']>;
};


export type MutationEndWorkArgs = {
  id: Scalars['ID'];
};


export type MutationPauseWorkArgs = {
  id: Scalars['ID'];
};


export type MutationStartWorkArgs = {
  id: Scalars['ID'];
};

export type Owner = {
  __typename?: 'Owner';
  login: Scalars['String'];
  url: Scalars['String'];
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
  pushed_at: Scalars['DateTime'];
  /** When the account reference was updated. */
  updated_at: Scalars['DateTime'];
  user_id: Scalars['String'];
  visible: Scalars['Boolean'];
};

export type ProjectInfo = {
  __typename?: 'ProjectInfo';
  collaborators: Scalars['Int'];
  id: Scalars['ID'];
  isPrivate: Scalars['String'];
  issues: Count;
  languages: Array<Maybe<Language>>;
  lastCommit: Commit;
  name: Scalars['String'];
  owner: Owner;
  pullRequests: Count;
  status: TrackingStatus;
};

/** Indicates what fields are available at the top level of a query operation. */
export type Query = {
  __typename?: 'Query';
  activityLog: Log;
  lastWork: WorkData;
  /** Find a single user by an identifying attribute. */
  me?: Maybe<User>;
  projectInfo?: Maybe<ProjectInfo>;
  projectTree?: Maybe<Array<Project>>;
  totalTime: TotalTime;
  workByDate: WorkData;
};


/** Indicates what fields are available at the top level of a query operation. */
export type QueryActivityLogArgs = {
  id?: InputMaybe<Scalars['ID']>;
  name?: InputMaybe<Scalars['String']>;
};


/** Indicates what fields are available at the top level of a query operation. */
export type QueryLastWorkArgs = {
  id: Scalars['ID'];
};


/** Indicates what fields are available at the top level of a query operation. */
export type QueryProjectInfoArgs = {
  id?: InputMaybe<Scalars['ID']>;
  name?: InputMaybe<Scalars['String']>;
};


/** Indicates what fields are available at the top level of a query operation. */
export type QueryTotalTimeArgs = {
  id: Scalars['ID'];
};


/** Indicates what fields are available at the top level of a query operation. */
export type QueryWorkByDateArgs = {
  id: Scalars['ID'];
  range: DateRangeInput;
  represents: Scalars['String'];
};

export type SynchronizeResult = {
  __typename?: 'SynchronizeResult';
  timestamp: Scalars['DateTime'];
};

export type TotalTime = {
  __typename?: 'TotalTime';
  id: Scalars['ID'];
  name: Scalars['String'];
  time: Scalars['Int'];
};

export type TrackedWork = {
  __typename?: 'TrackedWork';
  created_at: Scalars['DateTime'];
  end: Activity;
  id: Scalars['ID'];
  project: Project;
  start: Activity;
  updated_at: Scalars['DateTime'];
  user: User;
};

export type TrackingStatus = {
  __typename?: 'TrackingStatus';
  inProgress: Scalars['Boolean'];
  lastAction?: Maybe<ActivityType>;
  timeSpent: Scalars['Int'];
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

export type WorkData = {
  __typename?: 'WorkData';
  date: DateRange;
  id: Scalars['ID'];
  name: Scalars['String'];
  represents: Scalars['String'];
  time: Scalars['Int'];
};

export type DeleteWorkMutationVariables = Exact<{
  id: Scalars['ID'];
}>;


export type DeleteWorkMutation = { __typename?: 'Mutation', deleteWork: { __typename?: 'TrackedWork', id: string } };

export type LogFragmentFragment = { __typename?: 'Log', id: string, name: string, log: Array<{ __typename?: 'ActivityLog', id: string, date: any, activities?: Array<{ __typename?: 'Activity', type: ActivityType, created_at: any }> | null } | null> };

export type ProjectInfoFragmentFragment = { __typename?: 'ProjectInfo', id: string, name: string, collaborators: number, isPrivate: string, languages: Array<{ __typename?: 'Language', size: number, name: string } | null>, issues: { __typename?: 'Count', totalCount: number, assignedCount: number }, pullRequests: { __typename?: 'Count', totalCount: number, assignedCount: number }, owner: { __typename?: 'Owner', login: string, url: string }, lastCommit: { __typename?: 'Commit', messageHeadline: string, committedDate?: any | null, url?: string | null } };

export type WorkDataFragmentFragment = { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } };

export type WorkActionFragment = { __typename?: 'Activity', type: ActivityType, created_at: any, work: { __typename?: 'TrackedWork', id: string, created_at: any, project: { __typename?: 'Project', id: string, name: string } } };

export type FetchProjectQueryVariables = Exact<{
  today: DateRangeInput;
  week: DateRangeInput;
  month: DateRangeInput;
  year: DateRangeInput;
  yesterday: DateRangeInput;
  lastWeek: DateRangeInput;
  lastMonth: DateRangeInput;
  id: Scalars['ID'];
}>;


export type FetchProjectQuery = { __typename?: 'Query', projectInfo?: { __typename?: 'ProjectInfo', id: string, name: string, collaborators: number, isPrivate: string, languages: Array<{ __typename?: 'Language', size: number, name: string } | null>, issues: { __typename?: 'Count', totalCount: number, assignedCount: number }, pullRequests: { __typename?: 'Count', totalCount: number, assignedCount: number }, owner: { __typename?: 'Owner', login: string, url: string }, lastCommit: { __typename?: 'Commit', messageHeadline: string, committedDate?: any | null, url?: string | null } } | null, activityLog: { __typename?: 'Log', id: string, name: string, log: Array<{ __typename?: 'ActivityLog', id: string, date: any, activities?: Array<{ __typename?: 'Activity', type: ActivityType, created_at: any }> | null } | null> }, totalTime: { __typename?: 'TotalTime', id: string, name: string, time: number }, today: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, week: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, month: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, year: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, yesterday: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, lastWeek: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, lastMonth: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, lastWork: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } } };

export type GetActivityLogQueryVariables = Exact<{
  name: Scalars['String'];
}>;


export type GetActivityLogQuery = { __typename?: 'Query', activityLog: { __typename?: 'Log', id: string, name: string, log: Array<{ __typename?: 'ActivityLog', id: string, date: any, activities?: Array<{ __typename?: 'Activity', type: ActivityType, created_at: any }> | null } | null> } };

export type GetProjectTreeQueryVariables = Exact<{ [key: string]: never; }>;


export type GetProjectTreeQuery = { __typename?: 'Query', projectTree?: Array<{ __typename: 'Project', id: string, node_id: string, name: string, pushed_at: any }> | null };

export type GetProjectInfoQueryVariables = Exact<{
  id?: InputMaybe<Scalars['ID']>;
  name?: InputMaybe<Scalars['String']>;
}>;


export type GetProjectInfoQuery = { __typename?: 'Query', projectInfo?: { __typename?: 'ProjectInfo', id: string, name: string, collaborators: number, isPrivate: string, status: { __typename?: 'TrackingStatus', inProgress: boolean, lastAction?: ActivityType | null, timeSpent: number }, languages: Array<{ __typename?: 'Language', size: number, name: string } | null>, issues: { __typename?: 'Count', totalCount: number, assignedCount: number }, pullRequests: { __typename?: 'Count', totalCount: number, assignedCount: number }, owner: { __typename?: 'Owner', login: string, url: string }, lastCommit: { __typename?: 'Commit', messageHeadline: string, committedDate?: any | null, url?: string | null } } | null };

export type SynchronizeMutationVariables = Exact<{ [key: string]: never; }>;


export type SynchronizeMutation = { __typename?: 'Mutation', synchronize: { __typename: 'SynchronizeResult', timestamp: any } };

export type GetUserQueryVariables = Exact<{ [key: string]: never; }>;


export type GetUserQuery = { __typename?: 'Query', me?: { __typename: 'User', id: string, node_id: string, email: string, username: string, avatar_url: string, name: string } | null };

export type GetStatsQueryVariables = Exact<{
  today: DateRangeInput;
  week: DateRangeInput;
  month: DateRangeInput;
  year: DateRangeInput;
  yesterday: DateRangeInput;
  lastWeek: DateRangeInput;
  lastMonth: DateRangeInput;
  id: Scalars['ID'];
}>;


export type GetStatsQuery = { __typename?: 'Query', totalTime: { __typename?: 'TotalTime', id: string, name: string, time: number }, today: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, week: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, month: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, year: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, yesterday: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, lastWeek: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, lastMonth: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } }, lastWork: { __typename: 'WorkData', id: string, name: string, represents: string, time: number, date: { __typename?: 'DateRange', from?: any | null, to?: any | null } } };

export type StartWorkMutationVariables = Exact<{
  id: Scalars['ID'];
}>;


export type StartWorkMutation = { __typename?: 'Mutation', startWork: { __typename?: 'Activity', type: ActivityType, created_at: any, work: { __typename?: 'TrackedWork', id: string, created_at: any, project: { __typename?: 'Project', id: string, name: string } } } };

export type PauseWorkMutationVariables = Exact<{
  id: Scalars['ID'];
}>;


export type PauseWorkMutation = { __typename?: 'Mutation', pauseWork: { __typename?: 'Activity', type: ActivityType, created_at: any, work: { __typename?: 'TrackedWork', id: string, created_at: any, project: { __typename?: 'Project', id: string, name: string } } } };

export type ContinueWorkMutationVariables = Exact<{
  id: Scalars['ID'];
}>;


export type ContinueWorkMutation = { __typename?: 'Mutation', continueWork: { __typename?: 'Activity', type: ActivityType, created_at: any, work: { __typename?: 'TrackedWork', id: string, created_at: any, project: { __typename?: 'Project', id: string, name: string } } } };

export type EndWorkMutationVariables = Exact<{
  id: Scalars['ID'];
}>;


export type EndWorkMutation = { __typename?: 'Mutation', endWork: { __typename?: 'Activity', type: ActivityType, created_at: any, work: { __typename?: 'TrackedWork', id: string, created_at: any, project: { __typename?: 'Project', id: string, name: string } } } };

export const LogFragmentFragmentDoc = gql`
    fragment LogFragment on Log {
  id
  name
  log {
    id
    date
    activities {
      type
      created_at
    }
  }
}
    `;
export const ProjectInfoFragmentFragmentDoc = gql`
    fragment ProjectInfoFragment on ProjectInfo {
  id
  name
  collaborators
  isPrivate
  languages {
    size
    name
  }
  issues {
    totalCount
    assignedCount
  }
  pullRequests {
    totalCount
    assignedCount
  }
  owner {
    login
    url
  }
  lastCommit {
    messageHeadline
    committedDate
    url
  }
}
    `;
export const WorkDataFragmentFragmentDoc = gql`
    fragment WorkDataFragment on WorkData {
  id
  name
  represents
  date {
    from
    to
  }
  time
  __typename
}
    `;
export const WorkActionFragmentDoc = gql`
    fragment WorkAction on Activity {
  type
  work {
    id
    created_at
    project {
      id
      name
    }
  }
  created_at
}
    `;
export const DeleteWorkDocument = gql`
    mutation DeleteWork($id: ID!) {
  deleteWork(id: $id) {
    id
  }
}
    `;

  @Injectable({
    providedIn: 'root'
  })
  export class DeleteWorkGQL extends Apollo.Mutation<DeleteWorkMutation, DeleteWorkMutationVariables> {
    document = DeleteWorkDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }
export const FetchProjectDocument = gql`
    query fetchProject($today: DateRangeInput!, $week: DateRangeInput!, $month: DateRangeInput!, $year: DateRangeInput!, $yesterday: DateRangeInput!, $lastWeek: DateRangeInput!, $lastMonth: DateRangeInput!, $id: ID!) {
  projectInfo(id: $id) {
    ...ProjectInfoFragment
  }
  activityLog(id: $id) {
    ...LogFragment
  }
  totalTime(id: $id) {
    id
    name
    time
  }
  today: workByDate(id: $id, range: $today, represents: "today") {
    ...WorkDataFragment
  }
  week: workByDate(id: $id, range: $week, represents: "week") {
    ...WorkDataFragment
  }
  month: workByDate(id: $id, range: $month, represents: "month") {
    ...WorkDataFragment
  }
  year: workByDate(id: $id, range: $year, represents: "year") {
    ...WorkDataFragment
  }
  yesterday: workByDate(id: $id, range: $yesterday, represents: "yesterday") {
    ...WorkDataFragment
  }
  lastWeek: workByDate(id: $id, range: $lastWeek, represents: "lastWeek") {
    ...WorkDataFragment
  }
  lastMonth: workByDate(id: $id, range: $lastMonth, represents: "lastMonth") {
    ...WorkDataFragment
  }
  lastWork: lastWork(id: $id) {
    ...WorkDataFragment
  }
}
    ${ProjectInfoFragmentFragmentDoc}
${LogFragmentFragmentDoc}
${WorkDataFragmentFragmentDoc}`;

  @Injectable({
    providedIn: 'root'
  })
  export class FetchProjectGQL extends Apollo.Query<FetchProjectQuery, FetchProjectQueryVariables> {
    document = FetchProjectDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }
export const GetActivityLogDocument = gql`
    query GetActivityLog($name: String!) {
  activityLog(name: $name) {
    ...LogFragment
  }
}
    ${LogFragmentFragmentDoc}`;

  @Injectable({
    providedIn: 'root'
  })
  export class GetActivityLogGQL extends Apollo.Query<GetActivityLogQuery, GetActivityLogQueryVariables> {
    document = GetActivityLogDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }
export const GetProjectTreeDocument = gql`
    query GetProjectTree {
  projectTree {
    id
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
export const GetProjectInfoDocument = gql`
    query GetProjectInfo($id: ID, $name: String) {
  projectInfo(id: $id, name: $name) {
    ...ProjectInfoFragment
    status {
      inProgress
      lastAction
      timeSpent
    }
  }
}
    ${ProjectInfoFragmentFragmentDoc}`;

  @Injectable({
    providedIn: 'root'
  })
  export class GetProjectInfoGQL extends Apollo.Query<GetProjectInfoQuery, GetProjectInfoQueryVariables> {
    document = GetProjectInfoDocument;
    
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
export const GetStatsDocument = gql`
    query GetStats($today: DateRangeInput!, $week: DateRangeInput!, $month: DateRangeInput!, $year: DateRangeInput!, $yesterday: DateRangeInput!, $lastWeek: DateRangeInput!, $lastMonth: DateRangeInput!, $id: ID!) {
  totalTime(id: $id) {
    id
    name
    time
  }
  today: workByDate(id: $id, range: $today, represents: "today") {
    ...WorkDataFragment
  }
  week: workByDate(id: $id, range: $week, represents: "week") {
    ...WorkDataFragment
  }
  month: workByDate(id: $id, range: $month, represents: "month") {
    ...WorkDataFragment
  }
  year: workByDate(id: $id, range: $year, represents: "year") {
    ...WorkDataFragment
  }
  yesterday: workByDate(id: $id, range: $yesterday, represents: "yesterday") {
    ...WorkDataFragment
  }
  lastWeek: workByDate(id: $id, range: $lastWeek, represents: "lastWeek") {
    ...WorkDataFragment
  }
  lastMonth: workByDate(id: $id, range: $lastMonth, represents: "lastMonth") {
    ...WorkDataFragment
  }
  lastWork: lastWork(id: $id) {
    ...WorkDataFragment
  }
}
    ${WorkDataFragmentFragmentDoc}`;

  @Injectable({
    providedIn: 'root'
  })
  export class GetStatsGQL extends Apollo.Query<GetStatsQuery, GetStatsQueryVariables> {
    document = GetStatsDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }
export const StartWorkDocument = gql`
    mutation StartWork($id: ID!) {
  startWork(id: $id) {
    ...WorkAction
  }
}
    ${WorkActionFragmentDoc}`;

  @Injectable({
    providedIn: 'root'
  })
  export class StartWorkGQL extends Apollo.Mutation<StartWorkMutation, StartWorkMutationVariables> {
    document = StartWorkDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }
export const PauseWorkDocument = gql`
    mutation PauseWork($id: ID!) {
  pauseWork(id: $id) {
    ...WorkAction
  }
}
    ${WorkActionFragmentDoc}`;

  @Injectable({
    providedIn: 'root'
  })
  export class PauseWorkGQL extends Apollo.Mutation<PauseWorkMutation, PauseWorkMutationVariables> {
    document = PauseWorkDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }
export const ContinueWorkDocument = gql`
    mutation ContinueWork($id: ID!) {
  continueWork(id: $id) {
    ...WorkAction
  }
}
    ${WorkActionFragmentDoc}`;

  @Injectable({
    providedIn: 'root'
  })
  export class ContinueWorkGQL extends Apollo.Mutation<ContinueWorkMutation, ContinueWorkMutationVariables> {
    document = ContinueWorkDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }
export const EndWorkDocument = gql`
    mutation EndWork($id: ID!) {
  endWork(id: $id) {
    ...WorkAction
  }
}
    ${WorkActionFragmentDoc}`;

  @Injectable({
    providedIn: 'root'
  })
  export class EndWorkGQL extends Apollo.Mutation<EndWorkMutation, EndWorkMutationVariables> {
    document = EndWorkDocument;
    
    constructor(apollo: Apollo.Apollo) {
      super(apollo);
    }
  }