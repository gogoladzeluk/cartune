<?php

namespace App\Jobs;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDiscordNewRequestWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Request $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = sprintf('https://discord.com/api/webhooks/%s/%s',
            config('services.discord_webhooks.requests.id'),
            config('services.discord_webhooks.requests.token'),
        );

        $hookObject = json_encode($this->getPayload(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL        => $url,
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => $hookObject,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ]
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
    }

    private function getPayload(): array
    {
        return [
            'content' => '<@&994950815016026172>',
            'embeds' => [
                [
                    'color'       => 1223243,
                    'title'       => 'New Request',
                    'fields'      => [
                        [
                            'name'   => 'Name',
                            'value'  => $this->request->name,
                            'inline' => true,
                        ],
                        [
                            'name'   => 'Mobile',
                            'value'  => $this->request->mobile,
                            'inline' => true,
                        ],
                        [
                            'name'   => 'Description',
                            'value'  => $this->request->text,
                            'inline' => false,
                        ],
                    ],
                ],
            ],
        ];
    }
}
