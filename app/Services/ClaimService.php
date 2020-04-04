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
use Illuminate\Support\Str;
use Telegram\Bot\Laravel\Facades\Telegram;

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
            $addressee = $claim->user;
        } else {
            $addressee = User::getManager();
        }

        Mail::to($addressee->email)->send(new NewClaim($claim, $message, $addressee));
    }

    /**
     * Отправка почты при закрытии заявки
     */
    public function sendMailOnCloseClaim(Claim $claim): void
    {
        $addressee = User::getManager();

        Mail::to($addressee->email)->send(new CloseClaim($claim));
    }

    /**
     * Геренация кода, по которому можно перейти к завке по ссылки с автоматической аутентификацией
     */
    public function generateAuthShortcode(Claim $claim): void
    {
        $claim->update(['shortcode' => Str::random(6)]);
    }

    public function sendTelegramMessageOnNewClaim(Claim $claim, Message $message)
    {
        $text = "<strong>{$claim->subject}</strong>\n";
        $text .= $message->text;

        Telegram::sendMessage([
            'chat_id'    => env('TELEGRAM_MANAGER_ID'),
            'text'       => $text,
            'parse_mode' => 'html',
        ]);
    }
}
