<?php
declare(strict_types=1);

namespace App\UI\Grid\Admin;

use App\Model\Database\EntityManager;
use App\UI\Grid\GridFactory;
use Doctrine\ORM\Query\Expr\Join;
use Nette\Application\UI\Presenter;
use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\DataGrid;

class PollGridBuilder
{
    public function __construct(
        private GridFactory $gridFactory,
        private EntityManager $entityManager,
    )
    {
    }

    public function create(Presenter $presenter): DataGrid
    {
        $grid = $this->gridFactory->create($presenter, 'pollGrid');

        $totalVotesInBuilding = $this->entityManager->getHousingUnitRepository()->getTotalVoteShares();

        $grid->setDataSource(
            $this->entityManager->getPollRepository()
                ->createQueryBuilder('p')
                ->addSelect('SUM(DISTINCT hu.votesShare) as votedSharesTotal')
                ->addSelect('p.id as id')
                ->addSelect('p.title as title')
                ->leftJoin('p.userVotes', 'uv')
                ->leftJoin('uv.user', 'u')
                ->leftJoin('u.housingUnits', 'hu')
                ->groupBy('p.id')
        );

        $grid->addColumnText('title', 'Název hlasování')
            ->setFilterText();
        $grid->addColumnNumber('votedSharesTotal', 'Odhlasováno');
        $grid->addColumnCallback('votedSharesTotal', function(Column $column, array $data) use ($totalVotesInBuilding) {
            $voted = $data['votedSharesTotal'];
            $column->setAlign('right');
            $column->setRenderer(function () use ($voted, $totalVotesInBuilding) {
               return sprintf('%d/%d (%d%%)', $voted, $totalVotesInBuilding, ($voted/$totalVotesInBuilding)*100);
            });
        });

        $grid->addAction('edit', 'Upravit');

        return $grid;
    }
}
