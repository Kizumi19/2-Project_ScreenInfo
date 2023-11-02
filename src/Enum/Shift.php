<?php
namespace App\Enum;

enum Shift: string {
    case MORNING = 'morning';
    case AFTERNOON = 'afternoon';
    case BOTH = 'morning and afternoon';


    public function getValue(): string {
        return $this->value;
    }
}
