<?php
declare(strict_types=1);

namespace App\Modules\Front\Announcement;

use App\Model\Database\EntityManager;
use App\Modules\Front\BaseFrontPresenter;

class AnnouncementPresenter extends BaseFrontPresenter
{
    public function __construct(
        private EntityManager $entityManager,
    )
    {
        parent::__construct();
    }

    public function renderDefault(): void
    {
        $this->template->announcements = $this
            ->entityManager
            ->getAnnouncementRepository()
            ->findLatestWithLimitAndOffset();
    }
}
