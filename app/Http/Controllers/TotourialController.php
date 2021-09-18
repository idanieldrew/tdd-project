<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Task;
use App\Models\Totourial;
use App\Models\User;
use App\Notifications\TestNotif;
use Illuminate\Http\Request;

class TotourialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totourials = Totourial::paginate(9);

        return view('Totourial.Totourials', compact('totourials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Totourial.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        auth()->user()->totourials()->create($attributes);

        return response([
            'messages' => 'totourials'
        ],201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $toturial
     * @return \Illuminate\Http\Response
     */
    public function show(Totourial $totourial)
    {
        $totourial->load(['tasks', 'activities', 'inviteUsers'])->get();

        $tasks = $totourial->tasks;

        $activities_Totourial = $totourial->activities;

        $task = Task::where('totourial_id', $totourial->id)->with('activities')->first();

        $activities_Task = $task->activities;

        $invite = $totourial->inviteUsers;

        return view('Totourial.Totourial', compact('totourial', 'tasks', 'activities_Totourial', 'activities_Task', 'invite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Totourial  $totourial
     * @return \Illuminate\Http\Response
     */
    public function edit(Totourial $totourial)
    {
        return view('Totourial.Edit', compact('totourial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Totourial  $totourial
     * @return \Illuminate\Http\Response
     */
    public function update(Totourial $totourial)
    {
        $x = request()->validate([
            'title' => 'sometimes|required',
            'body' => 'sometimes|required',
            'tips' => 'nullable'
        ]);

        $totourial->update($x);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  obj  $totourial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Totourial $totourial)
    {
        $this->authorize('delete', $totourial);
        $totourial->delete();

        return redirect()->route('totourial.index');
    }

    public function notif()
    {
        // $user = User::first();

        // $user->notify((new TestNotif())->delay(now()->addMinutes(5)));
    }

    public function inviteFriends(Totourial $totourial)
    {
        $email = request()->all('mail');

        $friend = User::whereEmail($email)->firstOrFail();

        $totourial->invite($friend);

        $delay = now()->addMinutes(5);
        $friend->notify((new TestNotif($friend->name))->delay($delay));

        return redirect()->route('totourial.show', $totourial->id);
    }
}
