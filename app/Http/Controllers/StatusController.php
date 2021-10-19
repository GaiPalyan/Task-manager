<?php

namespace App\Http\Controllers;

use App\Domain\StatusManager;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StatusController extends Controller
{
    public function __construct(StatusManager $manager)
    {
        $this->manager = $manager;
    }

    public function index()
    {
        $statuses = $this->manager->getStatusList();
        return view('app.statuses.show', $statuses);
    }

    public function create()
    {

        return Auth::user()
            ? view('app.statuses.create')
            : redirect()->route('task_statuses');
    }

    public function store(StoreStatusRequest $request)
    {
        $creatorId = auth()->id();
        $this->manager->saveStatus($request->input(), $creatorId);
        flash(__('Статус создан'))->success();

        return redirect()->route('task_statuses');
    }

    public function edit(int $id)
    {
        $status = $this->manager->getStatus($id);
        return view('app.statuses.edit', $status);
    }

    public function update(UpdateStatusRequest $request, int $id)
    {
        $this->manager->updateStatus($request->input(), $id);
        flash(__('Статус обновлен'))->success();

        return redirect()->route('task_statuses');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(int $id)
    {
        $status = $this->manager->getStatus($id);

        $response = Gate::inspect('status-delete', $status['status']);

        if ($response->denied()) {
            flash($response->message())->error();
            return redirect()->route('task_statuses');
        }

        $this->manager->deleteStatus($id);
        flash($response->message())->success();

        return redirect()->route('task_statuses');
    }
}
