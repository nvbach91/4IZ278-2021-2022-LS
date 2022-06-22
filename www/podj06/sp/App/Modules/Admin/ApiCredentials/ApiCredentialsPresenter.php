<?php
declare(strict_types=1);

namespace App\Modules\Admin\ApiCredentials;

use App\Modules\Admin\BaseAdminPresenter;
use App\UI\Form\Admin\ApiCredentials\CreateApiCredentialsFormFactory;
use App\UI\Grid\Admin\ApiCredentialsGridBuilder;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class ApiCredentialsPresenter extends BaseAdminPresenter
{
    public function __construct(
        private ApiCredentialsGridBuilder $apiKeysGridBuilder,
        private CreateApiCredentialsFormFactory $createApiCredentialsFormFactory,
    )
    {
        parent::__construct();
    }

    public function createComponentCreateApiCredentialsForm(): Form
    {
        return $this->createApiCredentialsFormFactory->create();
    }

    public function createComponentApiCredentialsGrid(): IComponent
    {
        return $this->apiKeysGridBuilder->build($this);
    }
}
