<?php

namespace App\Services\Synchronize;


use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class SynchronizeHelper
{
    public static function synchronize($userID, $token)
    {
        $headers = ['Content-Type: application/json'];
        $url = env("GITHUB_API") . "/user/repos?visibility=all";
        $value = Http::acceptJson()->withHeaders($headers)->withToken($token)->get($url);
        $projects = $value->json();
        foreach ($projects as $project) {
            Project::updateOrCreate([
                'node_id' => $project['node_id']
            ], [
                'user_id' => $userID,
                'name' => $project['full_name'],
                'visible' => true,
                'pushed_at' => Carbon::parse($project['pushed_at'])
            ]);
        }
        $user = User::find($userID)->first();
        $user["last_synchronized"] = Carbon::now();
        $user->save();
        return ["timestamp" => $user["last_synchronized"]];
    }
}

