<?php

namespace App\Console\Commands;

use App\Models\MonthlyTanamanSummary;
use App\Models\PendataanTanaman;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateMonthlySummary extends Command
{   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-monthly-summary';

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
        $lastMonth = Carbon::now()->subMonth();

        $summaries = PendataanTanaman::select(
            'spesies_id',
            DB::raw('SUM(jumlah_tanaman) as total_tanaman')
        )
        // ->whereYear('created_at', $lastMonth->year)
        // ->whereMonth('created_at', $lastMonth->month)
        ->groupBy('spesies_id')
        ->get();
        // Tambahkan baris ini tepat di bawahnya
        // dd($summaries);

        foreach ($summaries as $summary) {
            MonthlyTanamanSummary::updateOrCreate(
                [
                    'spesies_id' => $summary->spesies_id,
                    'year' => now()->year,
                    'month' => now()->month,
                ],
                [
                    'total_tanaman' => (int) $summary->total_tanaman,
                ]
            );
        }

        $this->info('Monthly summary calculated successfully!');

        return Command::SUCCESS;
    }
}
