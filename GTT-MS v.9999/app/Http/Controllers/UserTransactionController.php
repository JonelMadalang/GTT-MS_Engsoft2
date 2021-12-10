<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\userTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = DB::table('transactions')
        ->where('user_id','=',auth()->user()->id)
        ->orderBy('date','DESC')
        ->get(); 

        $bonds = DB::table('transactions')
        ->select(
        DB::raw('SUM(transactions.bond) as bond'))
        ->where('user_id','=',auth()->user()->id)
        ->groupBy('user_id')
        ->get();

        return view('transactions.user.transactions',compact('transactions','bonds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transactions = DB::table('users')
        ->join('taxi','taxi.id','=','users.taxi_id')
        ->select('taxi.id','taxi.boundary','users.taxi_id')
        ->where('users.id','=',auth()->user()->id)
        ->get();
    
        return view('transactions.user.create',compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date_check = DB::table('transactions')
        ->where('user_id','=',auth()->user()->id)
        ->where('transactions.date','=',$request->date)
        ->select('transactions.date')
        ->get();
        

        $todayDate = date('d/m/y');
        $request->validate([
            'date' => 'before:tomorrow'
        ]);


        // userTransaction::create($request->all());
        // return redirect()->route('userTransactions.index')->with('Success','Transaction has been added');


        $transactions = new Transaction();
        $transactions->user_id = $request->user_id;
        $transactions->date = $request->date;
        $transactions->bond = $request->bond;
        $transactions->expenses = $request->expenses;
        $transactions->expenses_details = $request->expenses_details;
        $transactions->status = $request->status;
        $transactions->remarks = $request->remarks;
        

        if(count($date_check) >=1){
            $transactions->boundary = null;
        }
        else{
            $transactions->boundary = $request->boundary;
        }

        if( $transactions->save() ){

            return redirect()->route('userTransactions.index')->with('Success','Transaction has been added');
         }else{
             return redirect()->back()->with('error','Failed to add transaction');
         }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userTransaction  $userTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(userTransaction $userTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userTransaction  $userTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(userTransaction $userTransaction)
    {
        return view('transactions.user.edit',compact('userTransaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userTransaction  $userTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, userTransaction $userTransaction)
    {
        $userTransaction->update($request->all());
        return redirect()->route('userTransactions.index')->with('Updated','Transaction Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userTransaction  $userTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(userTransaction $userTransaction)
    {
        //
    }

    public function viewBonds(){
        $bondTransactions = DB::table('transactions')
        ->where('user_id','=',auth()->user()->id)
        ->get();

        $total = DB::table('transactions')
        ->select(
        DB::raw('SUM(transactions.bond) as bond'))
        ->where('user_id','=',auth()->user()->id)
        ->groupBy('user_id')
        ->get();

        return view('transactions.user.bonds',compact('bondTransactions','total'));
    }

}
