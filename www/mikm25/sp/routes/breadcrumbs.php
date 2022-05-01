<?php

use App\Models\Position;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('app.dashboard', static function (BreadcrumbTrail $trail): void {
    $trail->push(__('pages.app.dashboard'), route('app.dashboard'));
});

Breadcrumbs::for('app.positions.index', static function (BreadcrumbTrail $trail): void {
    $trail->push(__('pages.app.positions.index'), route('app.positions.index'));
});

Breadcrumbs::for('app.positions.create', static function (BreadcrumbTrail $trail): void {
    $trail->parent('app.positions.index');
    $trail->push(__('pages.app.positions.create'), route('app.positions.create'));
});

Breadcrumbs::for('app.positions.detail', static function (BreadcrumbTrail $trail): void {
    /** @var Position $position */
    $position = request()->route('position');

    $tab = (string) request()->route('tab');

    $trail->parent('app.positions.index');
    $trail->push(__('pages.app.positions.detail', ['positionName' => $position->name]), route('app.positions.detail', [
        'position' => $position->id,
        'tab' => $tab,
    ]));
});
