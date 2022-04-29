<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('app.dashboard', static function (BreadcrumbTrail $trail): void {
    $trail->push(__('pages.app.dashboard'), route('app.dashboard'));
});

Breadcrumbs::for('app.positions.index', static function (BreadcrumbTrail $trail): void {
    $trail->push(__('pages.app.positions'), route('app.positions.index'));
});

Breadcrumbs::for('app.positions.create', static function (BreadcrumbTrail $trail): void {
    $trail->parent('app.positions.index');
    $trail->push(__('pages.app.positions_create'), route('app.positions.create'));
});
