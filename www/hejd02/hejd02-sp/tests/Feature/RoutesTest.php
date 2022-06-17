<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;

class RoutesTest extends TestCase
{


    /**
     * test all route
     *
     * @group route
     */

    public function testAllRoute()
    {
        $routeCollection = Route::getRoutes();
        $this->withoutEvents();
        $blacklist = [
            '/',
            'api/user',
            'api/user-signout',
            'sanctum/csrf-cookie',
            '_ignition/health-check',
            '_debugbar/assets/javascript',
            '_debugbar/assets/stylesheets',
            '_debugbar/open',
            '_debugbar/clockwork',
            'error'

        ];
        $dynamicReg = "/{\\S*}/";
        foreach ($routeCollection as $route) {
            if (!preg_match($dynamicReg, $route->uri()) &&
                in_array('GET', $route->methods()) &&
                !in_array($route->uri(), $blacklist) && str_contains( 'api/admin',$route->uri())
            ) {
                $start = $this->microtimeFloat();
                fwrite(STDERR, print_r('test ' . $route->uri() . "\n", true));
                $response = $this->get( $route->uri(),['Accept' => 'application/json', 'authorization' => 'Bearer ' . "1|vNodoYQh2cUkOybjfxUhLy07o29eItcRoMOYEclb"]);
                $end   = $this->microtimeFloat();
                $temps = round($end - $start, 3);
                fwrite(STDERR, print_r('time: ' . $temps . "\n", true));
                $this->assertLessThan(15, $temps, "too long time for " . $route->uri());
                $this->assertEquals(200, $response->getStatusCode(), $route->uri()." " . " failed to load");

            }

        }
    }

    public function microtimeFloat()
    {
        list($usec, $asec) = explode(" ", microtime());

        return ((float) $usec + (float) $asec);

    }
}

