<?php

namespace App\Application\Services;

use App\Application\DTOs\EmailData;
use App\Domain\Interfaces\EmailRepositoryInterface;
use App\Jobs\SendTransactionalEmailJob;
use App\Mail\GenericTransactionalMail;

class EmailService
{
    public function __construct(
        protected EmailRepositoryInterface $emailRepository
    ) {
    }

    /**
     * Send immediately.
     */
    public function send(EmailData $data): void
    {
        $email = $this->emailRepository->create([
            'user_id' => $data->userId,
            'recipient' => $data->recipient,
            'subject' => $data->subject,
            'type' => $data->type,
            'status' => 'pending',
            'provider' => config('mail.default'),
            'metadata' => $data->data,
        ]);

        try {
            $this->emailRepository->markSending($email);

            \Mail::to($data->recipient)->send(
                new GenericTransactionalMail(
                    $data->subject,
                    $data->view,
                    $data->data
                )
            );

            $this->emailRepository->markSent($email);
        } catch (\Throwable $exception) {
            $this->emailRepository->markFailed(
                $email,
                $exception->getMessage()
            );

            throw $exception;
        }
    }

    /**
     * Queue email.
     */
    public function queue(EmailData $data): int
    {
        $email = $this->emailRepository->create([
            'user_id' => $data->userId,
            'recipient' => $data->recipient,
            'subject' => $data->subject,
            'type' => $data->type,
            'status' => 'pending',
            'provider' => config('mail.default'),
            'metadata' => $data->data,
        ]);

        $this->emailRepository->markQueued($email);

        SendTransactionalEmailJob::dispatch(
            $email->id,
            $data->recipient,
            $data->subject,
            $data->view,
            $data->data
        );

        return $email->id;
    }
}