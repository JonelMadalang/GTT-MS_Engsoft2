<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Programmer;
use App\Models\User;
use Illuminate\Http\Request;

class ProgrammerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
        ->where('users.role',2)
        ->get(); 
        return view('dashboards.programmers.index',compact('users'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('users')
        ->where('id',$request->id)
        ->update(['role' => $request->role]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programmer  $programmer
     * @return \Illuminate\Http\Response
     */
    public function show(Programmer $programmer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programmer  $programmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Programmer $programmer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programmer  $programmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programmer $programmer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programmer  $programmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programmer $programmer)
    {
        //
    }
}
