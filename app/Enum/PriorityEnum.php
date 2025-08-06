<?php

namespace App\Enum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;


enum PriorityEnum :string implements HasLabel, HasColor, HasIcon
{
    case LOW = "low";
    case MEDIUM = "medium";
    case HIGH = "high";

    public function getLabel(): string|null
    {
        return match ($this) {
            self::LOW => "Rendah",
            self::MEDIUM => "Sedang",
            self::HIGH => "Tnggi"
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::LOW => "success",
            self::MEDIUM => "danger",
            self::HIGH => "warning",
        };
    }

    public function getIcon(): string|null
    {
        return match ($this) {
            self::LOW => "heroicon-o-chevron-down",
            self::MEDIUM => "heroicon-o-clock",
            self::HIGH => "heroicon-o-bolt",
        };
    }
}
