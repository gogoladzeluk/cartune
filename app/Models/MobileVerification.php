<?php

namespace App\Models;

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

        $model->sendSms();

        return $model;
    }

    public static function getCodeByMobile(string $mobile)
    {
        $mobileVerification = self::where('mobile', $mobile)->first();

        return $mobileVerification ? $mobileVerification->code : null;
    }

    public function sendSms($author = 'cartune.ge')
    {
        $content = urlencode(sprintf('თქვენი კოდია %s', $this->code));
        // TODO: smsoffice.ge logic
    }
}
