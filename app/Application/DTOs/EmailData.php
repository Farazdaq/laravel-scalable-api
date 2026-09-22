<?php

namespace App\Application\DTOs;

class EmailData
{
    public string $recipient;

    public string $subject;

    public string $type;

    public ?int $userId;

    public string $view;

    public array $data;

    public function __construct(
        string $recipient,
        string $subject,
        string $type,
        string $view,
        array $data = [],
        ?int $userId = null
    ) {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->type = $type;
        $this->view = $view;
        $this->data = $data;
        $this->userId = $userId;
    }
}