<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('app.dashboard', static function (BreadcrumbTrail $trail): void {
    $trail->push(__('pages.app.dashboard'), route('app.dashboard'));
});