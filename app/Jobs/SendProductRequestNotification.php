<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ProductRequestNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendProductRequestNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $productRequest;
    public function __construct($productRequest)
    {
        //
        $this->productRequest = $productRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin = User::where('usertype', 'admin')->first();
        if ($admin) {
            $admin->notify(new ProductRequestNotification($this->productRequest));
        }
    }
}
