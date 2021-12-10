<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$status = ['For Verification','Verified','For Updating','Resubmitted'];
        $status = ['Verified','For Updating'];
        $transactions = DB::table('transactions')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->select('users.name', 'transactions.*')
            ->orderBy('date','DESC')
            ->get();
            //return view('transactions.admin.transactions',['transactions'=>$transactions]);
            return view('transactions.admin.transactions',compact('transactions','status'));
       
        
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
        Transaction::updateOrCreate(
            ['id'=>$request->id],$request->all()
        );

        return redirect()->route('transactions.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return Response::json($transaction);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function showChart()
    {
        //$transactions = Transaction::all();
        $transactions = DB::table('transactions')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->select(
            DB::raw('Month(transactions.date) as date'),
            DB::raw('SUM(transactions.boundary) as boundary'),
            DB::raw('SUM(transactions.expenses) as expenses'))
            ->where('transactions.status','=','Verified')
            ->groupBy(
                DB::raw('Month(transactions.date)'))
            ->get();

        return view('transactions.admin.chart',['transactions' => $transactions]);


    }
}
