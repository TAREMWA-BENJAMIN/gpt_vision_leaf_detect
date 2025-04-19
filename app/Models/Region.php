<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'flag',
    ];

    /**
     * Get the subregions that belong to this region.
     */
    public function subregions()
    {
        return $this->hasMany(Subregion::class);
    }

    /**
     * Get the countries that belong to this region.
     */
    public function countries()
    {
        return $this->hasMany(Country::class);
    }
} 