<?php
declare(strict_types=1);

namespace App\UI\Grid;

use Nette\ComponentModel\IContainer;
use Ublaboo\DataGrid\DataGrid;

class GridFactory
{
    public function create(IContainer $container, ?string $name = null): DataGrid
    {
        $grid = new DataGrid($container, $name);
        $grid->setDefaultPerPage(30);
        $grid->setRememberState(false);
        $grid->setAutoSubmit(false);

        return $grid;
    }
}
