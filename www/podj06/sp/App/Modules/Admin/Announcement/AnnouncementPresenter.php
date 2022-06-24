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

	public function actionDelete(int $id): void
	{
		$announcement = $this->entityManager->getAnnouncementRepository()->find($id);

		if ($announcement === null) {
			$this->flashError(sprintf('Oznámení s id %s nenalezeno', $id));
			$this->redirect(':Admin:Announcement:');
		}

		$this->entityManager->remove($announcement);
		$this->entityManager->flush();

		$this->flashSuccess('Oznámení úspěšně smazáno');
		$this->redirect(':Admin:Announcement:');
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
