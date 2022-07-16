<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tracking extends Model
{
    use HasFactory, SoftDeletes;

    const TYPE_LOAD = 0;
    const TYPE_MOBILE = 1;
    const TYPE_SEND_CODE = 4;
    const TYPE_CODE = 2;
    const TYPE_FINAL = 3;

    const TYPES = [
        self::TYPE_LOAD,
        self::TYPE_MOBILE,
        self::TYPE_SEND_CODE,
        self::TYPE_CODE,
        self::TYPE_FINAL,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'token',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
