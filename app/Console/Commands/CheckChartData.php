<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendataanTanaman;
use Illuminate\Support\Facades\DB;

class CheckChartData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-chart-data';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $data = PendataanTanaman::select('spesies_id', DB::raw('SUM(jumlah_tanaman) as total_tanaman'))
            ->groupBy('spesies_id')
            ->pluck('total_tanaman', 'spesies_id')
            ->toArray();

        $this->info("Checking chart data...");
        $this->info(json_encode($data, JSON_PRETTY_PRINT));
        
        return Command::SUCCESS;
    }
}
