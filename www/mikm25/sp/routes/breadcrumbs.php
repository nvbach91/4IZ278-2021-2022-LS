<?php

use App\Models\Company;
use App\Models\Position;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('app.dashboard', static function (BreadcrumbTrail $trail): void {
    /** @var string $title */
    $title = __('pages.app.dashboard');

    $trail->push($title, route('app.dashboard'));
});

Breadcrumbs::for('app.positions.index', static function (BreadcrumbTrail $trail): void {
    /** @var string $title */
    $title = __('pages.app.positions.index');

    $trail->push($title, route('app.positions.index'));
});

Breadcrumbs::for('app.positions.create', static function (BreadcrumbTrail $trail): void {
    $trail->parent('app.positions.index');

    /** @var string $title */
    $title = __('pages.app.positions.create');

    $trail->push($title, route('app.positions.create'));
});

Breadcrumbs::for('app.positions.show', static function (BreadcrumbTrail $trail): void {
    /** @var Position $position */
    $position = request()->route('position');

    $tab = (string) request()->route('tab');

    $trail->parent('app.positions.index');

    /** @var string $title */
    $title = __('pages.app.positions.show', ['positionName' => $position->title_name]);

    $trail->push($title, route('app.positions.show', [
        'position' => $position->id,
        'tab' => $tab,
    ]));
});

Breadcrumbs::for('app.positions.edit', static function (BreadcrumbTrail $trail): void {
    /** @var Position $position */
    $position = request()->route('position');

    $trail->parent('app.positions.index');

    /** @var string $title */
    $title = __('pages.app.positions.edit', ['positionName' => $position->title_name]);

    $trail->push($title, route('app.positions.edit', [
        'position' => $position->id,
    ]));
});

Breadcrumbs::for('app.companies.index', static function (BreadcrumbTrail $trail): void {
    /** @var string $title */
    $title = __('pages.app.companies.index');

    $trail->push($title, route('app.companies.index'));
});

Breadcrumbs::for('app.companies.create', static function (BreadcrumbTrail $trail): void {
    $trail->parent('app.companies.index');

    /** @var string $title */
    $title = __('pages.app.companies.create');

    $trail->push($title, route('app.companies.create'));
});

Breadcrumbs::for('app.companies.show', static function (BreadcrumbTrail $trail): void {
    /** @var Company $company */
    $company = request()->route('company');

    $trail->parent('app.companies.index');

    /** @var string $title */
    $title = __('pages.app.companies.show', ['companyName' => $company->title_name]);

    $trail->push($title, route('app.companies.show', [
        'company' => $company->id,
    ]));
});

Breadcrumbs::for('app.companies.edit', static function (BreadcrumbTrail $trail): void {
    /** @var Company $company */
    $company = request()->route('company');

    $trail->parent('app.companies.index');

    /** @var string $title */
    $title = __('pages.app.companies.edit', ['companyName' => $company->title_name]);

    $trail->push($title, route('app.companies.edit', [
        'company' => $company->id,
    ]));
});
