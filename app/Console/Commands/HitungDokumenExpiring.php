<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Land;
use Carbon\Carbon;

class HitungDokumenExpiring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dokumen:hitung-expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghitung jumlah tanah dengan dokumen yang akan kadaluarsa dalam 30 hari dan menyimpan hasilnya ke cache';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $today     = Carbon::today();
        $threshold = $today->copy()->addDays(30);

        $count = Land::whereNotNull('dokumen_expiry')
            ->whereBetween('dokumen_expiry', [$today, $threshold])
            ->count();

        // Simpan ke cache (expired in 60 minutes)
        cache()->put('dokumen_expiring_count', $count, now()->addMinutes(60));

        $this->info("Jumlah dokumen expiring soon: {$count}");

        return 0;
    }
}
