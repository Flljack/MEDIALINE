<?php

namespace App\Console\Commands;

use App\Services\Grabber\RBK\Grabber;
use Illuminate\Console\Command;

class RBKGrab extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grab:rbk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab RBK.ru';

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
    public function handle(Grabber $grabber)
    {
        $grabber->grab();
        return Command::SUCCESS;
    }
}
