<?php

namespace App\GraphQL\Mutations;

use App\Models\Project;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class Synchronize
{
    /**
     * @param null $rootValue
     * @param array{} $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {

        $userID = $context->user()->getAuthIdentifier();
        $node_id = $context->user()['node_id'];
        $token = $context->request()->bearerToken();
        $headers = ['Content-Type: application/json'];
        $url = env("GITHUB_API") . "/user/repos?visibility=all";
        $value = Http::acceptJson()->withHeaders($headers)->withToken($token)->get($url);
        $projects = $value->json();
        foreach ($projects as $project) {
            Project::updateOrCreate([
                'node_id' => $project['node_id']
            ], [
                'owner_id' => $userID,
                'name' => $project['full_name'],
                'visible' => true,
                'pushed_at' => Carbon::parse($project['pushed_at'])
            ]);
        }
        $user = User::find($userID)->first();
        $user["last_synchronized"] = Carbon::now();
        $user->save();
        return ["timestamp" => $user["last_synchronized"]];
//            ->then(function ($value) use ($userGID) {
//            $projects = $value->json();
//            foreach ($projects as $project) {
//                DB::table('projects')->updateOrInsert([
//                    'gid' => $project['node_id']
//                ], [
//                    'owner' => $userGID,
//                    'name' => $project['full_name'],
//                    'visible' => true
//                ]);
//            }
//        })->then(function () {
//            DB::table('users')->update([
//                "last_synchronized" => Carbon::now()
//            ]);
//        })->then(function () use ($userGID) {
//            $timestamp = DB::table('users')->get("last_synchronized")->where("gid", $userGID)->first();
//            var_dump($timestamp);
//            return response()->json(["timestamp" => $timestamp]);
//        })->wait();
    }
}
