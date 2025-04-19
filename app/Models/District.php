<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country_id',
        'country_code',
        'fips_code',
        'iso2',
        'type',
        'level',
        'parent_id',
        'latitude',
        'longitude',
        'flag',
    ];

    /**
     * Get the users that belong to this district.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the country that this district belongs to.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
} 