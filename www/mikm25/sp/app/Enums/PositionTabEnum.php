<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self detail()
 * @method static self statistics()
 * @method static self applications()
 */
class PositionTabEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'detail' => 'detail',
            'statistics' => 'statistics',
            'applications' => 'applications'
        ];
    }
}