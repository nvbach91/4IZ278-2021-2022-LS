<?php

class SiteController
{
    public function actionIndex()
    {   
        $status = Db::getStatusConnection();
        require_once(ROOT . '/views/site/index.php');
        return true;
    }
}
