<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const TYPE_USER = 0;
    const TYPE_MECHANIC = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'profile_picture',
        'garage_picture',
        'type',
        'password',
        'active',
        'town_id',
        'district_id',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function town()
    {
        return $this->hasOne(Town::class);
    }

    public function district()
    {
        return $this->hasOne(District::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function getFullNameAttribute(): string
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    public function getIsMechanic(): bool
    {
        return $this->type == self::TYPE_MECHANIC;
    }


    public static function getActiveMechanicsByServiceIds(?array $serviceIds) // TODO add: ->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating')
    {
        /** @var Builder $query */
        $query = self::mechanics()->active()->offersServices($serviceIds);
        return self::mechanics()->active()->offersServices($serviceIds)->get();
    }

    public static function getActiveMechanicById($id): User
    {
        return self::mechanics()->active()->findOrFail($id);
    }


    public function scopeUsers(Builder $query): Builder
    {
        return $query->where('type', User::TYPE_USER);
    }

    public function scopeMechanics(Builder $query): Builder
    {
        return $query->where('type', User::TYPE_MECHANIC);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeOffersService(Builder $query, int $serviceId): Builder
    {
        return $query->whereHas('services', fn(Builder $query) => $query->where('services.id', $serviceId));
    }

    public function scopeOffersServices(Builder $query, ?array $serviceIds): Builder
    {
//        return $query->whereHas('services', fn(Builder $query) => $query->whereIn('id', $serviceIds), '==', count($serviceIds));
        foreach ($serviceIds as $serviceId) {
            $query = $query->offersService($serviceId);
        }
        return $query;
    }
}
