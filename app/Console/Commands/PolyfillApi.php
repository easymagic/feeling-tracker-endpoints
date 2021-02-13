<?php

namespace App\Console\Commands;

use App\Models\Scale;
use App\Models\User;
use Illuminate\Console\Command;

class PolyfillApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:polyfill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->line('Populating EndPoints ...');

        $this->line('Populating scale ...');

        Scale::populate();

        $this->line('Populating Users ...');
         User::populate();

        $this->alert('Done...');
        return 'Done';
    }
}
