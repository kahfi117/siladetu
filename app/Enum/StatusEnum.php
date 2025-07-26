<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum :string implements HasLabel, HasIcon, HasColor
{
    case NEW = "new";
    case REJECTED = "rejected";
    case ASSIGNED = "assigned";
    case PROCESS = "process";
    case DONE = "done";

    public function getLabel(): string|null
    {
        return match ($this) {
            self::NEW => "Baru",
            self::REJECTED => "Ditolak",
            self::ASSIGNED => "Ditugaskan",
            self::PROCESS => "Diproses",
            self::DONE => "Selesai",
        };
    }

    public function getIcon(): string|null
    {
        return match ($this) {
            self::NEW      => "heroicon-m-plus-circle",
            self::REJECTED => "heroicon-m-x-circle",
            self::ASSIGNED => "heroicon-m-user-plus",
            self::PROCESS  => "heroicon-m-arrow-path",
            self::DONE      => "heroicon-m-check-circle",
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::NEW => "gray",
            self::REJECTED => "danger",
            self::ASSIGNED => "info",
            self::PROCESS => "warning",
            self::DONE => "success",
        };
    }
}
