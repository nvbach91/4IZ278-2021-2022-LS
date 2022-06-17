<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    public function createApplication(): Application
    {
        /** @var Application $app */
        $app = require __DIR__ . '/../bootstrap/app.php';

        /** @var Kernel $kernel */
        $kernel = $app->make(Kernel::class);

        $kernel->bootstrap();

        return $app;
    }
}
