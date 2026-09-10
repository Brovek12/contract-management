<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AlatKesehatan;
use App\Mail\ExpiryReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendExpiryReminder extends Command
{
    protected $signature = 'reminder:expiry';
    protected $description = 'Kirim email jika alat kesehatan akan kadaluarsa besok';

  public function handle()
{
    \Log::info('Scheduler reminder:expiry dijalankan');

    $tomorrow = Carbon::tomorrow()->format('Y-m-d');

    $items = AlatKesehatan::where('tanggal_kadaluarsa', $tomorrow)->get();

    foreach ($items as $item) {
        Mail::to('taufiky321@gmail.com')->send(new ExpiryReminderMail($item));
    }

    $this->info('Email reminder terkirim!');
}

}
