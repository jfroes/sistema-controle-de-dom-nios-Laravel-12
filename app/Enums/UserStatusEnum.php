<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case ACTIVE = 'ativo';
    case INACTIVE = 'inativo';
    case BLOCKED = 'bloqueado';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Ativo',
            self::INACTIVE => 'Inativo',
            self::BLOCKED => 'Bloqueado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'emerald',
            self::INACTIVE => 'gray',
            self::BLOCKED => 'red',
        };
    }
}

