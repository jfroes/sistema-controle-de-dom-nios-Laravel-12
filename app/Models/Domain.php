<?php

namespace App\Models;

use App\Enums\DomainStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'client_id',
        'registrar_account_id',
        'host',
        'host_user',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'expires_at' => 'date',
        'status' => DomainStatusEnum::class,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function registrarAccount(): BelongsTo
    {
        return $this->belongsTo(RegistrarAccount::class);
    }
}
