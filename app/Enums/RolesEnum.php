<?php

namespace App\Enums;

enum RolesEnum: string
{
    case root = 'root';
    case guest = 'guest';
    case botaniste = 'botaniste';

    public function label(): string
    {
        return match ($this) {
            self::root => 'root',
            self::guest => 'guest',
            self::botaniste => 'botaniste',
        };
    }

    public function has($student) : bool
    {
        return $this->value === $student;
    }
}
