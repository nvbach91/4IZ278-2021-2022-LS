<?php

namespace App\Console\Commands\App;

use Illuminate\Console\Command;

class AppInstallCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * @var string
     */
    protected $description = 'Installs application';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->call('migrate:fresh');

        $this->call('db:seed');

        return 0;
    }
}
