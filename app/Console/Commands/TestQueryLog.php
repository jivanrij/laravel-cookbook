<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestQueryLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:querylog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing the query log logic.';

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
        QueryMonitorFacade::injectListener();

        QueryMonitorFacade::startListening();

        $user = User::all()->first();
        $user = User::all()->first();
        User::where('id', '>', 4)->get();
        $users = User::where('id', '>', 6)->get();

        QueryMonitorFacade::logResults();

        $this->info('done fetching ');
        return 1;
    }
}
