<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServerDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model', 'ram', 'hardisk', 'location', 'price', 'hardisk_capacity_mb', 'ram_capacity_mb'
    ];
}
