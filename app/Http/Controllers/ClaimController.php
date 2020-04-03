<?php

namespace App\Http\Controllers;

use App\Claim;
use App\Http\Requests\ClaimEdit;
use App\Http\Requests\ClaimRequest;
use App\Http\Requests\MessageRequest;
use App\Repositories\ClaimRepository;
use App\Services\ClaimService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClaimController extends Controller
{
    /**
     * @var ClaimService
     */
    private $service;

    /**
     * @var ClaimRepository
     */
    private $repository;

    /**
     * ClaimController constructor.
     */
    public function __construct(ClaimService $service, ClaimRepository $repository)
    {
        $this->service    = $service;
        $this->repository = $repository;
    }

    /**
     * Страница со списком заявок
     */
    public function index(Request $request): View
    {
        $claims = $this->repository->getClaimList($request);

        return view('claim.'.auth()->user()->getRole().'_list', compact('claims'));
    }

    /**
     * Страница создания заявки
     */
    public function create(): View
    {
        return view('claim.create');
    }

    /**
     * Страница заявки
     */
    public function edit(Claim $claim, ClaimEdit $request): View
    {
        if (auth()->user()->isManager()) {
            $claim->update(['is_viewed' => true]);
        }

        return view('claim.edit', compact('claim'));
    }

    /**
     * Сохранение заявки
     */
    public function store(ClaimRequest $request): RedirectResponse
    {
        $claim = $this->repository->createClaim($request);

        $this->processAddMessage($claim, $request);

        return redirect(route('claim.edit', ['claim' => $claim->id]));
    }

    /**
     * Сохранение нового сообщения в заявке
     */
    public function update(Claim $claim, MessageRequest $request): RedirectResponse
    {
        $this->processAddMessage($claim, $request);

        $this->repository->updateClaim($claim);

        return redirect(route('claim.edit', ['claim' => $claim->id]));
    }

    /**
     * Прием заявки менеджером
     */
    public function accept(Claim $claim): bool
    {
        return $claim->update(['manager_id' => auth()->user()->id]);
    }

    /**
     * Закрытие заявки клиентом
     */
    public function close(Claim $claim): bool
    {
        $this->service->sendMailOnCloseClaim($claim);

        return $claim->update(['is_active' => false]);
    }

    private function processAddMessage(Claim $claim, Request $request): void
    {
        $message = $this->repository->createMessage($claim, $request);

        $this->service->handleUploadedFile($request->file, $message);
        $this->service->sendMailOnNewMessage($claim, $message);
    }
}
