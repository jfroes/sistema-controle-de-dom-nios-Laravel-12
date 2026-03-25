<?php

    namespace App\Enums;

    enum UserRoleEnum: string
    {
        case ADMIN = 'admin';
        case USER = 'user';

        public function label(): string
        {
            return match ($this) {
                self::ADMIN => 'Admin',
                self::USER => 'User',
            };
        }

        public function color(): string
        {
            return match ($this) {
                self::ADMIN => 'blue',
                self::USER => 'gray',
            };
        }

    }

