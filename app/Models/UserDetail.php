<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
