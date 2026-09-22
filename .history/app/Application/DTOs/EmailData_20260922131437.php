<?php

namespace App\Application\DTOs;

final readonly class EmailData
{
    public function __construct(
        public string $recipient,
        public string $subject,
        public ?string $name = null,
        public array $data = [],
    ) {
    }
}