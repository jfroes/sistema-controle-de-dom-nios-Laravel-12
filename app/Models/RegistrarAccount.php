<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrarAccount extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'registrar_id',
        'label',
        'username',
        'notes'
    ];

    public function registrar(): BelongsTo
    {
        return $this->belongsTo(Registrar::class);
    }

    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class);
    }


}
