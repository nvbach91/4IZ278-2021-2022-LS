<?php
declare(strict_types=1);

namespace App\UI\Grid\Admin;

use App\Model\Database\EntityManager;
use App\UI\Grid\GridFactory;
use Nette\Application\UI\Presenter;
use Ublaboo\DataGrid\Column\Action\Confirmation\StringConfirmation;
use Ublaboo\DataGrid\DataGrid;

class ApiCredentialsGridBuilder
{
    public function __construct(
        private GridFactory $gridFactory,
        private EntityManager $entityManager,
    )
    {
    }

    public function build(Presenter $presenter): DataGrid
    {
        $grid = $this->gridFactory->create($presenter, 'apiCredentialsGrid');

        $grid->setDataSource(
            $this
                ->entityManager
                ->getApiCredentialsRepository()
                ->createQueryBuilder('ac')
        );

        $grid->addColumnText('company', 'Společnost');
        $grid->addColumnText('key', 'Klíč');
        $grid->addColumnText('secret', 'Secret');
        $grid->addAction('delete', 'Smazat')
            ->setClass('btn btn-danger btn-sm')
            ->setConfirmation(
                new StringConfirmation('Opravdu chcete odstranit tento API klíč?')
            );

        return $grid;
    }
}
