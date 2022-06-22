<?php declare(strict_types = 1);

namespace App\Model\Router;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

final class RouterFactory
{

	public function create(): RouteList
	{
		$router = new RouteList();

        $this->buildApi($router);
		$this->buildAdmin($router);
		$this->buildFront($router);

		return $router;
	}

	protected function buildAdmin(RouteList $router): RouteList
	{
		$router[] = $list = new RouteList('Admin');
		$list[] = new Route('admin/<presenter>/<action>[/<id>]', 'Home:default');

		return $router;
	}

	protected function buildFront(RouteList $router): RouteList
	{
		$router[] = $list = new RouteList('Front');
		$list[] = new Route('<presenter>/<action>[/<id>]', 'Home:default');

		return $router;
	}

    protected function buildApi(RouteList $router): RouteList
    {
        $router[] = $list = new RouteList('Api');
        $list[] = new Route('/api/v1/verify', 'Home:verify');
        $list[] = new Route('/api/v1/publishMeasurement', 'Home:publishMeasurement');
        $list[] = new Route('/api/v1/<presenter>/<action>[/<id>]', 'Home:default');

        return $router;
    }

}
