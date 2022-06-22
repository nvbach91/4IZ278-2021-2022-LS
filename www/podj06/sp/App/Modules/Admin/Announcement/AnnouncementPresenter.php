<?php
declare(strict_types=1);

namespace App\Modules\Admin\Announcement;

use App\Model\Database\Entity\AnnouncementEntity;
use App\Model\Database\EntityManager;
use App\Modules\Admin\BaseAdminPresenter;
use App\UI\Form\Admin\Announcement\EditAnnouncementFormFactory;
use App\UI\Grid\Admin\AnnouncementGridBuilder;
use Nette\Application\UI\Form;
use Ublaboo\DataGrid\DataGrid;

class AnnouncementPresenter extends BaseAdminPresenter
{
    private ?AnnouncementEntity $entity = null;

    public function __construct(
        private AnnouncementGridBuilder $announcementGridBuilder,
        private EntityManager $entityManager,
        private EditAnnouncementFormFactory $announcementFormFactory,
    )
    {
        parent::__construct();
    }

    public function actionEdit(?int $id): void
    {
        $this->entity = $id === null ? null : $this->entityManager->getAnnouncementRepository()->find($id);
    }

    public function createComponentAnnouncementGrid(): DataGrid
    {
        return $this->announcementGridBuilder->build($this);
    }

    public function createComponentEditAnnouncementForm(): Form
    {
        return $this->announcementFormFactory->create($this->entity);
    }

}
