<?php

namespace App\Http\Controllers;

use App\Domain\StatusManager;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('app.statuses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required'], ['required' => 'Поле не может быть пустым']);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $this->manager->saveStatus($request->input());
        flash('Статус создан')->success();

        return redirect()->route('task_statuses');
    }

    public function edit(int $id)
    {
        $status = $this->manager->getStatus($id);
        return view('app.statuses.edit', $status);
    }
}
