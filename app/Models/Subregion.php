<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subregion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'region_id',
        'flag',
    ];

    /**
     * Get the users that belong to this subregion.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the region that this subregion belongs to.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the countries that belong to this subregion.
     */
    public function countries()
    {
        return $this->hasMany(Country::class);
    }
} 