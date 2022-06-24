<?php
declare(strict_types=1);

namespace App\UI\Grid\Admin;

use App\Model\Database\Entity\HousingUnitEntity;
use App\Model\Database\EntityManager;
use App\UI\Grid\GridFactory;
use Doctrine\ORM\QueryBuilder;
use Nette\Application\UI\Presenter;
use Ublaboo\DataGrid\Column\Action\Confirmation\StringConfirmation;
use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\DataGrid;

class HousingUnitGridBuilder
{

    public function __construct(
        private GridFactory $gridFactory,
        private EntityManager $entityManager,
    )
    {
    }

    public function build(Presenter $presenter): DataGrid
    {
        $grid = $this->gridFactory->create($presenter, 'housingUnitGrid');

        $grid->setDataSource(
            $this
                ->entityManager
                ->getHousingUnitRepository()
                ->createQueryBuilder('hu')
                ->leftJoin('hu.owner', 'o')
        );
        $grid->addColumnText('number', 'Číslo jednotky')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('ownerName', 'Vlastník', 'owner.name')
            ->setFilterText()
            ->setCondition(function(QueryBuilder $builder, string $value) {
                $builder->andWhere(
                    $builder->expr()->orX(
                        $builder->expr()->like(
                            $builder->expr()->concat(
                                'o.name',
                                $builder->expr()->concat(
                                    $builder->expr()->literal(' '),
                                    'o.surname'
                                )
                            ),
                            $builder->expr()->literal($value . '%')
                        ),
                        $builder->expr()->like(
                            $builder->expr()->concat(
                                'o.surname',
                                $builder->expr()->concat(
                                    $builder->expr()->literal(' '),
                                    'o.name'
                                )
                            ),
                            $builder->expr()->literal($value . '%')
                        )
                    )
                );
            });
        $grid->addColumnCallback('ownerName', function(Column $column, HousingUnitEntity $entity) {
            $column->setRenderer(function() use ($entity) {
                if ($entity->getOwner() === null) {
                    return "";
                }

                return $entity->getOwner()->getName() . ' ' . $entity->getOwner()->getSurname();
            });
        });
        $grid->addColumnNumber('floor', 'Poschodí')
            ->setFilterText()
            ->setAttribute('type', 'number')
            ->setCondition(function(QueryBuilder $builder, $value) {
                $builder->andWhere('hu.floor = :floor')
                    ->setParameter('floor', $value);
            });
        $grid->addColumnNumber('area', 'Plocha')
            ->setFormat(2, ',', '');

        $grid->addColumnNumber('votesShare', 'Počet hlasů');

        $grid->addAction('edit', 'Upravit')
            ->setClass('btn btn-secondary btn-sm');

        $grid->addAction('delete', 'Smazat')
            ->setClass('btn btn-danger btn-sm')
            ->setConfirmation(
                new StringConfirmation('Opravdu chcete odstranit jednotku %s?', 'number')
            );

        return $grid;
    }
}
