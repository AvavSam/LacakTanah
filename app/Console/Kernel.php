<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  /**
   * Daftar command kustom yang tersedia.
   *
   * @var array<int, class-string>
   */
  protected $commands = [\App\Console\Commands\HitungDokumenExpiring::class];

  /**
   * Definisikan jadwal task.
   */
  protected function schedule(Schedule $schedule): void
  {
    // Jalankan sekali sehari jam 08:00
    $schedule->command('dokumen:hitung-expiring')->dailyAt('08:00');
  }

  /**
   * Daftarkan command.
   */
  protected function commands(): void
  {
    // Load semua file dalam folder Commands
    $this->load(__DIR__ . '/Commands');

    // Juga load routes/console.php jika ada
    require base_path('routes/console.php');
  }
}
