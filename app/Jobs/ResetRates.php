<?php

namespace App\Jobs;

use App\Models\SourceRate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ResetRates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        SourceRate::where('company_id', config('app.company_id'))
            ->where('rate', '>', 0)
            ->whereNull('deleted_at')
            ->update([
                'rate' => 0,
                'sub_agent_rate' => 0,
            ]);
        
    }
}
