<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Totourial;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Models\Totourial  $totourial
     * @return \Illuminate\Http\Response
     */
    public function store(Totourial $totourial, Request $request)
    {
        request()->validate([
            'body' => 'required',
        ]);

        /*if (auth()->user()->isNot($totourial->user)) {
            abort(403);
        }*/

        $totourial->addTask(request()->all());

        return redirect()->route('totourial.show',$totourial->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Totourial  $totourial
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Totourial $totourial, Task $task)
    {
        $task->update([
            'body' => request()->body ?? 'changed',
            'complete' => true
        ]);

        return redirect()->route('totourial.show',$totourial->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
