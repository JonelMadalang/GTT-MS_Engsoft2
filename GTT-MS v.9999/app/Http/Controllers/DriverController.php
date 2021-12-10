<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Response;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxis = DB::table('taxi')
        ->where('taxi.status','=',0)
        ->get();
        $users = DB::table('users')
        ->join('taxi','users.taxi_id','=', 'taxi.id')
        ->select('users.*','taxi.model','taxi.plate_number')
        ->where('users.role',2)
        ->get(); 
        return view('drivers.drivers', compact('users','taxis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::updateOrCreate(
            ['id'=>$request->id],$request->all()
        );
        DB::table('taxi')
        ->where('id',$request->input('taxi_id'))
        ->update(['status' => $request->input('status')]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return Response::json($user);
        $where = array('id' => $id);
		$user = User::where($where)->first();
		return Response::json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $driver->update($request->all());
        return redirect()->route('drivers.index')->with('Update','Driver is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        // $driver->delete();
        // return redirect()->route('drivers.index')->with('Delete','Driver is deleted');
    }

    public function uDrivers(){
        $taxis = DB::table('taxi')
        ->where('taxi.status','=',0)
        ->get();
        $users = DB::table('users')
        ->where('users.role',2)
        ->where('users.taxi_id')
        ->get(); 
        return view('drivers.unasignedDrivers', compact('users','taxis'));

    }

    public function unassignTaxi(Request $request){

        //print_r($request);

        DB::table('taxi')
        ->join('users','users.taxi_id','=','taxi.id')
        ->select('users.id','users.taxi_id','taxi.id','taxi.status')
        ->where('users.id',$request->id)
        ->update(['taxi.status' => $request->status]);

        DB::table('users')
        ->where('id',$request->id)
        ->update(['users.taxi_id' => null]);

       

    }
}
