<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registrar extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'name',
        'website',
    ];

    public function accounts(): HasMany
    {
        return $this->hasMany(RegistrarAccount::class);
    }
}
