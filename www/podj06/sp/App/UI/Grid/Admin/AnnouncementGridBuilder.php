<?php
declare(strict_types=1);

namespace App\UI\Grid\Admin;

use App\Model\Database\Entity\AnnouncementEntity;
use App\Model\Database\EntityManager;
use App\UI\Grid\GridFactory;
use Doctrine\ORM\QueryBuilder;
use Nette\Application\UI\Presenter;
use Ublaboo\DataGrid\Column\Action\Confirmation\StringConfirmation;
use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\DataGrid;

class AnnouncementGridBuilder
{
    public function __construct(
        private GridFactory $gridFactory,
        private EntityManager $entityManager,
    )
    {
    }

    public function build(Presenter $presenter): DataGrid
    {
        $grid = $this->gridFactory->create($presenter, 'announcementGrid');

        $grid->setDataSource(
            $this
                ->entityManager
                ->getAnnouncementRepository()
                ->createQueryBuilder('a')
                ->leftJoin('a.user', 'user')
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
        $grid->addColumnCallback('name', function(Column $column, AnnouncementEntity $entity) {
            $column->setRenderer(function() use ($entity) {
                return sprintf('%s %s', $entity->getUser()->getName(), $entity->getUser()->getSurname());
            });
        });
        $grid->addColumnText('title', 'Titulek')
            ->setFilterText();
        $grid->addColumnDateTime('createdAt', 'Vytvořeno')
            ->setFormat('d. m. Y H:i');
        $grid->addAction('edit', 'Upravit')
            ->setClass('btn btn-secondary btn-sm');
        $grid->addAction('delete', 'Smazat')
            ->setClass('btn btn-danger btn-sm')
            ->setConfirmation(
                new StringConfirmation('Opravdu chcete odstranit toto oznámení?')
            );

        return $grid;
    }
}
