<?php

namespace App\Http\Controllers;

use App\Collaborator;
use App\Http\Requests\Collaborators\StoreRequest;
use App\Http\Requests\Collaborators\UpdateRequest;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collaborators = Collaborator::with(['city', 'role'])->paginate();

        return response()->view('collaborators.index', compact('collaborators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $collaborator = new Collaborator;

        return response()->view('collaborators.create', compact('collaborator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $collaborator = new Collaborator;
        $collaborator->name = $request->input('name');
        $collaborator->email = $request->input('email');
        $collaborator->city_id = $request->input('city');
        $collaborator->role_id = $request->input('role');

        $collaborator->save();

        return redirect()->route('collaborators.index')->withSuccess(__('Collaborator created successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param Collaborator $collaborator
     * @return \Illuminate\Http\Response
     */
    public function show(Collaborator $collaborator)
    {
        $collaborator->load('city', 'role');

        return response()->view('collaborators.show', compact('collaborator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Collaborator $collaborator
     * @return \Illuminate\Http\Response
     */
    public function edit(Collaborator $collaborator)
    {
        return response()->view('collaborators.edit', compact('collaborator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Collaborator $collaborator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Collaborator $collaborator)
    {
        $collaborator->name = $request->input('name');
        $collaborator->email = $request->input('email');
        $collaborator->city_id = $request->input('city');
        $collaborator->role_id = $request->input('role');

        $collaborator->save();

        return redirect()->route('collaborators.index')->withSuccess(__('Collaborator updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Collaborator $collaborator
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collaborator $collaborator)
    {
        $collaborator->delete();

        return redirect()->route('collaborators.index')->withSuccess(__('Collaborator deleted successfully'));
    }
}
