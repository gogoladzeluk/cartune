<?php

namespace App\Jobs;

use App\Models\Request;
use App\Models\SmsOfficeDeliveryReport;
use App\Models\Tracking;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDiscordDailyReportWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $reportDay;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($reportDay = null)
    {
        if (!$reportDay) {
            $reportDay = Carbon::yesterday();
        }
        $this->reportDay = $reportDay;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = sprintf('https://discord.com/api/webhooks/%s/%s',
            config('services.discord_webhooks.reports.id'),
            config('services.discord_webhooks.reports.token'),
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
        $title = sprintf('Daily Report - %s', $this->reportDay->toFormattedDateString());

        /** @var Collection $trackings */
        $trackings = Tracking::whereDate('created_at', $this->reportDay)->get();
        $timesUntil = [];
        foreach (Tracking::TYPES as $trackingType) {
            $timesUntil[$trackingType] = [];
        }
        /** @var Collection $tokenTrackings */
        foreach ($trackings->groupBy('token') as $tokenTrackings) {
            foreach (Tracking::TYPES as $trackingType) {
                if ($tokenTrackings->where('type', $trackingType)->isEmpty()) continue;
                $avgTime = $tokenTrackings->where('type', $trackingType)->map(fn ($item) => $item->created_at->timestamp)->avg();
                if (isset($lastAvgTime)) {
                    $timesUntil[$trackingType][] = $avgTime - $lastAvgTime;
                }
                $lastAvgTime = $avgTime;
            }
        }
        $trackingText = '';
        $trackingText .= sprintf("**%d** - Website Loads\n", $trackings->where('type', Tracking::TYPE_LOAD)->count());
        $trackingText .= sprintf(":stopwatch: **%d Secs** - Avg Time\n", collect($timesUntil[Tracking::TYPE_MOBILE])->avg());
        $trackingText .= sprintf("**%d** - Mobile Inputs\n", $trackings->where('type', Tracking::TYPE_MOBILE)->count());
        $trackingText .= sprintf(":stopwatch: **%d Secs** - Avg Time\n", collect($timesUntil[Tracking::TYPE_SEND_CODE])->avg());
        $trackingText .= sprintf("**%d** - Send Code Presses\n", $trackings->where('type', Tracking::TYPE_SEND_CODE)->count());
        $trackingText .= sprintf(":stopwatch: **%d Secs** - Avg Time\n", collect($timesUntil[Tracking::TYPE_CODE])->avg());
        $trackingText .= sprintf("**%d** - Code Inputs\n", $trackings->where('type', Tracking::TYPE_CODE)->count());
        $trackingText .= sprintf(":stopwatch: **%d Secs** - Avg Time\n", collect($timesUntil[Tracking::TYPE_FINAL])->avg());
        $trackingText .= sprintf("**%d** - Request Sends\n", $trackings->where('type', Tracking::TYPE_FINAL)->count());

        $getSmsBalanceUrl = sprintf('http://smsoffice.ge/api/getBalance/?key=%s', config('services.sms_office.key'));
        $smsText = '';
        $smsText .= sprintf("**%d** - Smses Not Delivered\n", SmsOfficeDeliveryReport::whereDate('created_at', $this->reportDay)->where('status', '!=', 'Delivered')->count());
        $smsText .= sprintf("**%d** - Smses On Balance\n", file_get_contents($getSmsBalanceUrl));

        return [
            'embeds' => [
                [
                    'color'  => 1223243,
                    'title'  => $title,
                    'fields' => [
                        [
                            'name'   => 'Tracking',
                            'value'  => $trackingText,
                            'inline' => false,
                        ],
                        [
                            'name'   => 'SMS',
                            'value'  => $smsText,
                            'inline' => false,
                        ],
                    ],
                ],
            ],
        ];
    }
}
