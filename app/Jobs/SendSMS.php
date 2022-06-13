<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $destination;

    public $content;

    public $author;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($destination, $content, $author = 'cartune.ge')
    {
        $this->destination = $destination;
        $this->content = urlencode($content);
        $this->author = $author;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = sprintf('http://smsoffice.ge/api/v2/send?key=%s&sender=%s&destination=%s&content=%s',
            config('smsoffice.key'), $this->author, $this->destination, $this->content);
        $response = file_get_contents($url);
    }
}
