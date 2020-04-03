<?php

namespace App\Services;

use App\Claim;
use App\Mail\CloseClaim;
use App\Mail\NewClaim;
use App\Message;
use App\Repositories\ClaimRepository;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;

class ClaimService
{
    private $repository;

    /**
     * ClaimService constructor.
     */
    public function __construct(ClaimRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Обработка загрузки файла
     */
    public function handleUploadedFile(?UploadedFile $file, Message $message): void
    {
        if ( ! is_null($file)) {
            $message->update(['file' => $file->store('files')]);
        }
    }

    /**
     * Отпрвка почты при создании нового сообщения
     */
    public function sendMailOnNewMessage(Claim $claim, Message $message): void
    {
        if (auth()->user()->isManager()) {
            $emails = $claim->user->email;
        } else {
            if (is_null($claim->manager_id)) {
                $emails = User::getManagers();
            } else {
                $emails = $claim->manager->email ?? null;
            }
        }

        if (!is_null($emails)) {
            Mail::to($emails)->send(new NewClaim($claim, $message));
        }
    }

    /**
     * Отправка почты при закрытии заявки
     */
    public function sendMailOnCloseClaim(Claim $claim)
    {
        $email = $claim->manager->email ?? null;

        if (!is_null($email)) {
            Mail::to($email)->send(new CloseClaim($claim));
        }
    }
}
