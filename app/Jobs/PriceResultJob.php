<?php

namespace App\Jobs;

use App\Exceptions\JobException;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\PriceResultMail;

class PriceResultJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var array $result */
    private $result = [];

    /**
     * Create a new job instance.
     *
     * PriceResultJob constructor.
     * @param array $result
     * @throws JobException
     */
    public function __construct(array $result)
    {
        if (empty($result)) {
            throw new JobException('Empty result');
        }
        $this->result = $result;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $to = config('mail.price_checker.result.to');
        Mail::to($to)
            ->send(new PriceResultMail($this->result));
    }
}
