<?php

namespace App\Jobs;

use App\Domain\Interfaces\EmailRepositoryInterface;
use App\Mail\GenericTransactionalMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendTransactionalEmailJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $tries = 3;

    public $backoff = [
        10,
        60,
        300,
    ];

    public function __construct(
        public int $emailId,
        public string $recipient,
        public string $subject,
        public string $view,
        public array $data = []
    ) {
    }

    public function handle(
        EmailRepositoryInterface $emailRepository
    ): void {
        $email = $emailRepository->find($this->emailId);

        if (!$email) {
            return;
        }

        $emailRepository->markSending($email);

        Mail::to($this->recipient)->send(
            new GenericTransactionalMail(
                $this->subject,
                $this->view,
                $this->data
            )
        );

        $emailRepository->markSent($email);
    }

    public function failed(
        Throwable $exception
    ): void {
        $emailRepository = app(
            EmailRepositoryInterface::class
        );

        $email = $emailRepository->find(
            $this->emailId
        );

        if ($email) {
            $emailRepository->markFailed(
                $email,
                $exception->getMessage()
            );
        }

        \Log::error(
            'Transactional email permanently failed.',
            [
                'email_id' => $this->emailId,
                'recipient' => $this->recipient,
                'subject' => $this->subject,
                'error' => $exception->getMessage(),
            ]
        );
    }
}