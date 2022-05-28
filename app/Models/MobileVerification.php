<?php

namespace App\Models;

use App\Jobs\RemoveMobileVerification;
use App\Jobs\SendSMS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileVerification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mobile',
        'code',
    ];

    public static function create(array $attributes = [])
    {
        self::where('mobile', $attributes['mobile'])->delete();

        $attributes['code'] = sprintf("%06d", mt_rand(1, 999999));
        /** @var MobileVerification $model */
        $model = static::query()->create($attributes);

        $model->sendSMS();

        RemoveMobileVerification::dispatch($model->id)->delay(now()->addMinutes(2));

        return $model;
    }

    public static function getCodeByMobile($mobile)
    {
        return self::where('mobile', $mobile)->value('code');
    }

    public function sendSMS()
    {
        $content = urlencode(sprintf('თქვენი კოდია %s', $this->code));
        SendSMS::dispatch($this->mobile, $content);
    }
}
