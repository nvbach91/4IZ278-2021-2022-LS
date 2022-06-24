<?php
declare(strict_types=1);

namespace App\UI\Grid\Admin;

use App\Model\Database\EntityManager;
use App\UI\Grid\GridFactory;
use Doctrine\ORM\QueryBuilder;
use Nette\Application\UI\Presenter;
use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\DataGrid;

class OwnerGridBuilder
{
    public function __construct(
        private GridFactory $gridFactory,
        private EntityManager $entityManager,
    )
    {
    }

    public function create(Presenter $presenter): DataGrid
    {
        $grid = $this->gridFactory->create($presenter, 'ownerGrid');

        $grid->setDataSource(
            $this
                ->entityManager
                ->getUserRepository()
                ->createQueryBuilder('user')
                ->addSelect('COUNT(hu.id) as unitsOwned')
                ->addSelect('user.id as id')
                ->addSelect('user.name as name')
                ->addSelect('user.surname as surname')
                ->addSelect('user.email as email')
                ->addSelect('user.phone as phone')
                ->addSelect('user.role as role')
                ->leftJoin('user.housingUnits', 'hu', 'WITH', 'hu.owner = user.id')
                ->groupBy('user.id')
        );

        $grid->addColumnText('name', 'Jméno', 'name')
            ->setFilterText()
            ->setCondition(function(QueryBuilder $builder, string $value) {
                $builder->andWhere(
                    $builder->expr()->orX(
                        $builder->expr()->like(
                            $builder->expr()->concat(
                                'user.name',
                                $builder->expr()->concat(
                                    $builder->expr()->literal(' '),
                                    'user.surname'
                                )
                            ),
                            $builder->expr()->literal($value . '%')
                        ),
                        $builder->expr()->like(
                            $builder->expr()->concat(
                                'user.surname',
                                $builder->expr()->concat(
                                    $builder->expr()->literal(' '),
                                    'user.name'
                                )
                            ),
                            $builder->expr()->literal($value . '%')
                        )
                    )
                );
            });
        $grid->addColumnCallback('name', function(Column $column, array $arr) {
            $column->setRenderer(function() use ($arr) {
                $entity = $arr[0];
                return sprintf('%s %s', $entity->getName(), $entity->getSurname());
            });
        });
        $grid->addColumnText('email', 'Email')
            ->setFilterText();
        $grid->addColumnText('phone', 'Telefon')
            ->setFilterText();
        $grid->addColumnNumber('unitsOwned', 'Jednotek ve vlastnictví');
        $grid->addColumnStatus('role', 'Role')
            ->setCaret(false)
            ->addOption('user', 'Uživatel')
            ->setIcon('check')
            ->setClass('btn-success btn-sm')
            ->endOption()
            ->addOption('admin', 'Administrátor')
            ->setIcon('user')
            ->setClass('btn-danger btn-sm')
            ->endOption();
        $grid->addAction('edit', 'Upravit')
            ->setClass('btn btn-secondary btn-sm');

        $grid->addAction('resetPassword', 'Resetovat heslo')
            ->setClass('btn btn-outline-warning btn-sm');

        return $grid;
    }
}
