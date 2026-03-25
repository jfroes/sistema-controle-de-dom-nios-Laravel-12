<?php

namespace App\Enums;

enum DomainStatusEnum: string
{
    case ACTIVE = 'ativo';
    case INACTIVE = 'inativo';
    case BLOCKED = 'bloqueado';

    case EXPIRED = 'expirado';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Ativo',
            self::INACTIVE => 'Inativo',
            self::BLOCKED => 'Bloqueado',
            self::EXPIRED => 'Expirado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'green',
            self::INACTIVE => 'gray',
            self::BLOCKED => 'orange',
            self::EXPIRED => 'red',

        };
    }
}
