<?php

namespace App\Enums;

enum RolesEnum: string
{
    case simple_user = 'simple_user';
    case botaniste = 'botaniste';

    public function label(): string
    {
        return match ($this) {
            self::simple_user => 'simple_user',
            self::botaniste => 'botaniste',
        };
    }

    public function has($user) : bool
    {
        return $this->value === $user;
    }
}
