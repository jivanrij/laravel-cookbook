<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestIt extends Command
{
    protected $signature = 'testit';

    protected $description = 'Test code';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        return 0;
    }
}
