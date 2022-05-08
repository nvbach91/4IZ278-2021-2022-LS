<?php

namespace App\Constants;

class PositionTabConstants
{
    public const TAB_DETAIL = 'detail',
        TAB_STATISTICS = 'statistics';

    /**
     * @return list<string>
     */
    public static function getTabs(): array
    {
        return [
            self::TAB_DETAIL,
            self::TAB_STATISTICS,
        ];
    }
}
