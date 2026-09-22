<?php

namespace App\Application\DTOs;

class EmailData
{
    public string $recipient;
    public string $subject;
    public ?string $name;
    public array $data;

    public function __construct(
        string $recipient,
        string $subject,
        ?string $name = null,
        array $data = [],
    ) {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->name = $name;
        $this->data = $data;
    }
}