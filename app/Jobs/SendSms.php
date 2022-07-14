<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $destination;

    public $content;

    public $reference;

    public $author;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($destination, $content, $reference = '', $author = 'cartune.ge')
    {
        $this->destination = $destination;
        $this->content = urlencode($content);
        $this->reference = $reference;
        $this->author = $author;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = sprintf('http://smsoffice.ge/api/v2/send?key=%s&sender=%s&destination=%s&content=%s&reference=%s',
            config('services.sms_office.key'), $this->author, $this->destination, $this->content, $this->reference);
        $response = json_decode(file_get_contents($url), true);

        if (!$response['Success']) {
            Log::error($response);
        }
    }
}
