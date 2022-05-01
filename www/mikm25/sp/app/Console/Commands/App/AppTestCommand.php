<?php

namespace App\Console\Commands\App;

use App\Models\Company;
use App\Models\Position;
use Illuminate\Console\Command;

class AppTestCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * @var string
     */
    protected $description = 'Fills database with fake data from factories';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        Company::factory()->count(20)->create();

        Position::factory()->count(50)->create();

        return 0;
    }
}
