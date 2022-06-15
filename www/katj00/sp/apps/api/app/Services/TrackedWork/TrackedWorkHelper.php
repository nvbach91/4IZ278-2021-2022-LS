<?php

namespace App\Services\TrackedWork;

use App\Models\TrackedWork;
use App\Models\Activity;
use App\Services\Time\TimeHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TrackedWorkHelper
{
    public static function getCurrentWork(string $projectID): Model|Builder|null
    {
        return TrackedWork::where('project_id', $projectID)->whereNull('end_id')->with(['activities' => function ($query) {
            return $query->select(['id', 'work_id', 'type', 'created_at'])->orderBy('created_at', 'ASC');
        }])->first();
    }

    public static function getPreviousWork(string $projectID): Model|Builder|null
    {
        return TrackedWork::where('project_id', $projectID)
            ->whereNotNull('end_id')
            ->orderBy('created_at', 'DESC')
            ->with(['activities' => function ($query) {
                return $query->select(['id', 'work_id', 'type', 'created_at'])->orderBy('created_at', 'ASC');
            }])->first();
    }

    public static function getLog(string $projectID): Collection|array
    {
        return TrackedWork::where('project_id', $projectID)
            ->orderBy('created_at', 'DESC')
            ->with(['project' => function ($query) {
                return $query->select(['id', 'name']);
            }])
            ->with(['activities' => function ($query) {
                return $query->select(['id', 'work_id', 'type', 'created_at'])->orderBy('created_at', 'DESC');
            }])->get();
    }

    public static function getLastWork(string $projectID): Model|Builder|null
    {
        return TrackedWork::where('project_id', $projectID)->orderBy('created_at', 'DESC')->with(['activities' => function ($query) {
            return $query->select(['id', 'work_id', 'type', 'created_at'])->orderBy('created_at', 'ASC');
        }]);
    }

    public static function getLastActivity(Model $trackedWork): Activity|null
    {
        $length = count($trackedWork['activities']->toArray());
        if ($length > 0) {
            return $trackedWork['activities'][$length-1];
        } else {
            return null;
        }
    }

    public static function totalTime(string $projectID)
    {
        $workForProject = TrackedWork::where('project_id', $projectID)->whereNotNull('end_id')->with(['activities' => function ($query) {
            return $query->select(['id', 'work_id', 'type', 'created_at'])->orderBy('created_at', 'ASC');
        }])->get();
        $result = 0;
        foreach ($workForProject as $work) {
            $result += TimeHelper::timeDiff($work['activities']->toArray());
        }
        return $result;
    }

    public static function workByDate(string $projectID, array $date)
    {
        $from = Carbon::parse($date['from'])->toDateTimeString();
        $to = Carbon::parse($date['to'])->toDateTimeString();
        return TrackedWork::where('project_id', $projectID)->whereNotNull('end_id')->whereBetween('created_at', ["$from", "$to"])->with(['activities' => function ($query) {
            return $query->select(['id', 'work_id', 'type', 'created_at'])->orderBy('created_at', 'ASC');
        }])->get();
    }
}

