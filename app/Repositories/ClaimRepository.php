<?php

namespace App\Repositories;

use App\Claim;
use App\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ClaimRepository
{
    /**
     * @var Claim
     */
    private $model;

    /**
     * ClaimRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Claim;
    }

    /**
     * Получение списка заявок для текущего пользователя
     */
    public function getClaimList($request): Collection
    {
        return auth()->user()->isManager() ? $this->getManagerList($request) : $this->getClientList();
    }

    /**
     * Получение списка заявок клиента
     */
    private function getClientList(): Collection
    {
        return $this->model::on()->where('user_id', auth()->user()->id)->get();
    }

    /**
     * Получение списка заявок менеджера
     */
    private function getManagerList(Request $request): Collection
    {
        $claims = $this->model::on();

        if (!is_null($request->is_active)) {
           $claims->where('is_active', $request->is_active);
        }

        if (!is_null($request->is_viewed)) {
            $claims->where('is_viewed', $request->is_viewed);
        }

        if (!is_null($request->is_answered)) {
            $claims->where('is_answered', $request->is_answered);
        }

        return $claims->get();
    }

    /**
     * Создание заявки
     */
    public function createClaim(Request $request): Claim
    {
        return Claim::on()->create([
            'subject' => $request->subject,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * Создание сообщения
     */
    public function createMessage(Claim $claim, Request $request): Message
    {
        return $claim->messages()->create([
            'text'    => $request->text,
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * Изменение статуса заявки
     */
    public function updateClaim(Claim $claim): void
    {
        if (auth()->user()->isManager()) {
            $claim->update(['is_answered' => true]);
        } else {
            $claim->update(['is_answered' => false]);
        }
    }

}
