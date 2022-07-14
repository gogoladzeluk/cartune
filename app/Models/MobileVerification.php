<?php

namespace App\Models;

use App\Jobs\RemoveMobileVerification;
use App\Jobs\SendSms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileVerification extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mobile',
        'code',
    ];

    public static function getMasterKey() {
        return env('MOBILE_VERIFICATION_MASTER_KEY');
    }

    /**
     * @throws \Exception
     */
    public static function store(array $attributes = [])
    {
        if (self::where('mobile', $attributes['mobile'])->where('created_at', '>=', now()->subSeconds(30))->exists()) {
            throw new \Exception('You have to wait before sending another SMS');
        }
        self::where('mobile', $attributes['mobile'])->delete();

        $attributes['code'] = sprintf("%04d", mt_rand(1, 9999));
        /** @var MobileVerification $model */
        $model = self::create($attributes);

        $model->sendSms();

        return $model;
    }

    public static function getCodeByMobile($mobile)
    {
        self::where('created_at', '<', now()->subMinutes(2))->delete();
        return self::where('mobile', $mobile)->value('code');
    }

    public function sendSms()
    {
        $content = sprintf('თქვენი კოდია %s', $this->code);
        SendSms::dispatch(
            $this->mobile,
            $content,
            config('services.sms_office.reference_types')[MobileVerification::class] . ':' . $this->id
        );
    }
}
