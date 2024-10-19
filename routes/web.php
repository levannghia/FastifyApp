<?php

use App\Http\Controllers\CronTaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\Async\Pool;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/test', function () {
    $pool = Pool::create();
    $counter = 0;

    foreach (range(1, 5) as $i) {
        $pool[] = async(function () use ($i) {
            usleep(random_int(1000, 10000));
            Log::info("Task {$i} completed."); // Ghi log khi tác vụ hoàn thành
            return 2;
        })->then(function (int $output) use (&$counter, $i) {
            $counter += $output;
            Log::info("Task {$i} returned value: {$output}"); // Ghi log giá trị trả về
        });
    }

    await($pool);
    Log::info("Total counter value: {$counter}"); // Ghi log tổng giá trị
    return "The counter value is: " . $counter;
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/lcd-mt', [CronTaskController::class, 'LCDMT']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
