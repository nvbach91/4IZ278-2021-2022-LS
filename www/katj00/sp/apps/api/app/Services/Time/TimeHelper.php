<?php

namespace App\Services\Time;

use Closure;

function sortByTimestamp($key): Closure
{
    return function ($a, $b) use ($key) {
        return strnatcmp(strtotime($a[$key]), strtotime($b[$key]));
    };
}


class TimeHelper
{
    public static function timeDiff(array $arr): int
    {
        if (!$arr) return 0;
        usort($arr, sortByTimestamp('created_at'));
        $resultTimestamp = 0;
        $index = -1;
        foreach ($arr as $activity) {
            $index++;
            if ($activity["type"] == "START") {
                $resultTimestamp -= strtotime($activity["created_at"]);
                continue;
            }
            if ($activity["type"] == "PAUSE") {
                if (count($arr) <= $index + 1) {
                    $resultTimestamp += strtotime($activity["created_at"]);
                    return $resultTimestamp * 1000;
                }
                $next = $arr[$index + 1];
                if ($next["type"] == "CONTINUE") {
                    $resultTimestamp -= (strtotime($next['created_at']) - strtotime($activity['created_at']));
                    continue;
                } else if ($next["type"] == "END") {
                    $resultTimestamp += strtotime($activity['created_at']);
                    return $resultTimestamp * 1000;
                }
            }
            if ($activity["type"] == "END") {
                $resultTimestamp += (strtotime($activity['created_at']));
                return $resultTimestamp * 1000;
            }
        }
        return ($resultTimestamp + time()) * 1000;
    }
}

