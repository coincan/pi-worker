<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PriceResultMail extends Mailable
{
    use Queueable, SerializesModels;

    private $result;

    /**
     * Create a new message instance.
     *
     * PriceResultMail constructor.
     * @param array $result
     */
    public function __construct(array $result)
    {
        $this->result = $result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = sprintf('Result for %s', Carbon::today());
        $from = config('mail.price_checker.result.from');
        return $this->from($from)
            ->subject($subject)
            ->view('price.result', ['result' => $this->result]);
    }
}
