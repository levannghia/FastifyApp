<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrawlDLMT implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $response = Http::get('https://cskh-api.cpc.vn/api/remote/outages/area', [
                'orgCode' => 'PC07',
                'subOrgCode' => 'PC07AA',
                'fromDate' => '2024-10-09 00:00:00',
                'toDate' => '2024-10-17 23:59:59',
                'page' => 1,
                'limit' => 10,
            ]);

            // Log the response for debugging
            Log::info('API Response:', $response->json());
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error fetching data: ' . $e->getMessage());
        }
    }
}
