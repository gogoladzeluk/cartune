<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    const TYPE_START = 0;
    const TYPE_MOBILE = 1;
    const TYPE_CODE = 2;
    const TYPE_FINAL = 3;
    const TYPE_SEND_SMS = 4;

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