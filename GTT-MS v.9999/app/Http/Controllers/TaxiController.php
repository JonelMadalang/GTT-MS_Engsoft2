<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Taxi;
use Illuminate\Http\Request;
use Response;

class TaxiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $taxis = DB::table('taxi')
        // ->join('users','users.taxi_id','=','taxi.id')
        // ->select('users.name','taxi.*')
        // ->get();
        // return view('taxi.taxi',compact('taxis'));
        $taxis = DB::table('taxi')
        ->get();
        return view('taxi.taxi',compact('taxis'));
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
        Taxi::updateOrCreate(
            ['id'=>$request->id],$request->all()
        );

        return redirect()->route('taxi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function show(Taxi $taxi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxi $taxi)
    {
        return Response::json($taxi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taxi $taxi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxi $taxi)
    {
        $taxi->delete();
        
        
    }


}
