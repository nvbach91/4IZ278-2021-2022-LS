<?php declare(strict_types = 1);

namespace App\Modules\Front\Home;

use App\Modules\Front\BaseFrontPresenter;

final class HomePresenter extends BaseFrontPresenter
{
    public function actionDefault(): void
    {
        $this->redirect(':Front:Announcement:');
    }
}
