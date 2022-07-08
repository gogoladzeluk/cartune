<?php

namespace App\Models;

use App\Jobs\SendDiscordNewRequestWebhook;
use App\Jobs\SendSMS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        'text',
        'price',
    ];

    public function sendSMS()
    {
        $content = sprintf('შემოვიდა განცხადება მობილურიდან: %s', $this->mobile);
        SendSMS::dispatch(config('services.smsoffice.admin_mobile'), $content);
    }

    public function sendDiscordMessage()
    {
        SendDiscordNewRequestWebhook::dispatch($this);
    }
}
