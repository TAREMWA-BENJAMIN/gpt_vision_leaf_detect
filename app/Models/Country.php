<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'iso3',
        'numeric_code',
        'iso2',
        'phonecode',
        'capital',
        'currency',
        'currency_name',
        'currency_symbol',
        'tld',
        'region_id',
        'subregion_id',
        'nationality',
        'timezones',
        'latitude',
        'longitude',
        'emoji',
        'emojiU',
        'flag',
    ];

    /**
     * Get the users that belong to this country.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the districts that belong to this country.
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    /**
     * Get the region that this country belongs to.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the subregion that this country belongs to.
     */
    public function subregion()
    {
        return $this->belongsTo(Subregion::class);
    }
} 