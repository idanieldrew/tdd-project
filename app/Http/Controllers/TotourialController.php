<?php

namespace App\Http\Controllers;

use App\Models\Totourial;
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
        $totourials = Totourial::all();

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
            'user_id' => 'required'
        ]);
        $attributes['user_id'] = auth()->user()->id;
        // $attributes = $request->all();

        // Post::create($attributes);
        auth()->user()->totourials()->create($attributes);

        return redirect()->route('totourial.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $toturial
     * @return \Illuminate\Http\Response
     */
    public function show(Totourial $totourial)
    {
        return view('Totourial.Totourial', compact('totourial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
