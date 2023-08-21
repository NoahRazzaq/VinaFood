<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PurgeOrders extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:purge-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete orders older than 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Order::where('created_at', '<', Carbon::now()->subDays(7))->delete();
    }
}
