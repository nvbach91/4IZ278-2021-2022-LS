<?php declare(strict_types = 1);

namespace App\Modules\Admin\Home;

use App\Modules\Admin\BaseAdminPresenter;

final class HomePresenter extends BaseAdminPresenter
{
    public function actionDefault(): void
    {
        $this->redirect(':Admin:Announcement:');
    }
}
