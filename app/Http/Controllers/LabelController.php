<?php

namespace App\Http\Controllers;

use App\Domain\LabelsManager;
use App\Http\Requests\LabelRequests\StoreRequest;
use App\Http\Requests\LabelRequests\UpdateRequest;
use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LabelController extends Controller
{
    private LabelsManager $labelsManager;

    public function __construct(LabelsManager $labelsManager)
    {
        $this->labelsManager = $labelsManager;
        $this->authorizeResource(Label::class, 'label');
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $labels = $this->labelsManager->getLabels();
        return view('app.labels.show', $labels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('app.labels.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->labelsManager->saveLabel($request->all());
        flash(__('Метка успешно создана '))->success();
        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Label $label
     * @return View
     */
    public function edit(Label $label): View
    {
        return view('app.labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Label $label
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Label $label): RedirectResponse
    {
        $this->labelsManager->updateLabel($request->all(), $label);
        flash(__('Метка успешно изменена'))->success();
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Label $label
     * @return RedirectResponse
     */
    public function destroy(Label $label): RedirectResponse
    {
        if ($this->labelsManager->isAttached($label)) {
            flash(__('Не удалось удалить метку'))->error();
            return redirect()->route('labels.index');
        }

        $this->labelsManager->deleteLabel($label);
        flash(__(' Метка успешно удалена'))->success();
        return redirect()->route('labels.index');
    }
}
