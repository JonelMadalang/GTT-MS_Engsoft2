<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Response;
use Auth;
use PDF;



class AdminController extends Controller
{
    function index(){

        $users = DB::table('users')
        ->where('users.id','=',auth()->user()->id)
        ->get();
        return view('dashboards.admins.index',compact('users'));
    }

    public function assignTaxi(){
        User::updateOrCreate(
            ['id'=>$request->id],$request->all()
        );
        
    }

    public function changePass(){
        return view('dashboards.admins.changepassword');
    }


    public function changePassword(Request $request){
        //Validate form
        $validator = \Validator::make($request->all(),[
            'oldpassword'=>[
                'required', function($attribute, $value, $fail){
                    if( !\Hash::check($value, Auth::user()->password) ){
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
             ],
             'newpassword'=>'required|min:8|max:30',
             'cnewpassword'=>'required|same:newpassword'
         ],[
             'oldpassword.required'=>'Enter your current password',
             'oldpassword.min'=>'Old password must have atleast 8 characters',
             'oldpassword.max'=>'Old password must not be greater than 30 characters',
             'newpassword.required'=>'Enter new password',
             'newpassword.min'=>'New password must have atleast 8 characters',
             'newpassword.max'=>'New password must not be greater than 30 characters',
             'cnewpassword.required'=>'ReEnter your new password',
             'cnewpassword.same'=>'New password and Confirm new password must match'
         ]);

        if( !$validator->passes() ){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
             
         $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

         if( !$update ){
             return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
         }else{
             return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
         }
        }
    }


    public function viewReport(){
        $drivers = DB::table('users')
        ->where('users.role',2)
        ->get(); 

        $boundary = DB::table('transactions')
        ->select(
            DB::raw('transactions.boundary as boundary'))
        ->groupBy(
            DB::raw('transactions.boundary'))
        ->get(); 

        $expenses = DB::table('transactions')
        ->select(
            DB::raw('transactions.expenses')
        )
        ->groupBy('transactions.expenses')
        ->get(); 


        $bonds = DB::table('transactions')
        ->select(
            DB::raw('transactions.bond')
        )
        ->groupBy('transactions.bond')
        ->get(); 


        return view('transactions.admin.reports',compact('drivers','boundary','expenses','bonds'),['tbl' => 0]);

        
    }

    public function generateReport(Request $request){

        switch ($request->input('action')) {
            case 'search':
                $drivers = DB::table('users')
                ->where('users.role',2)
                ->get(); 

                $boundary = DB::table('transactions')
                ->select(
                    DB::raw('transactions.boundary')
                )
                ->groupBy('transactions.boundary')
                ->get(); 


                $expenses = DB::table('transactions')
                ->select(
                    DB::raw('transactions.expenses')
                )
                ->groupBy('transactions.expenses')
                ->get(); 


                $bonds = DB::table('transactions')
                ->select(
                    DB::raw('transactions.bond')
                )
                ->groupBy('transactions.bond')
                ->get(); 

                $values = $request;


                if($request->start_date && $request->end_date && $request->driver && $request->boundary && $request->expenses && $request->bonds){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->where('users.name','=',$request->driver)
                    ->where('transactions.boundary','=',$request->boundary)
                    ->where('transactions.expenses','=',$request->expenses)
                    ->where('transactions.bond','=',$request->bonds)
                    ->get();

                    
                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->start_date && $request->end_date && $request->driver && $request->boundary && $request->expenses){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->where('users.name','=',$request->driver)
                    ->where('transactions.boundary','=',$request->boundary)
                    ->where('transactions.expenses','=',$request->expenses)
                    ->get();

                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->start_date && $request->end_date && $request->driver && $request->boundary){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->where('users.name','=',$request->driver)
                    ->where('transactions.boundary','=',$request->boundary)
                    ->get();

                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->start_date && $request->end_date && $request->driver){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->where('users.name','=',$request->driver)
                    ->get();

                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->start_date && $request->end_date){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->get();
                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);
                }
                elseif($request->start_date){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.date','>=',$request->start_date)
                    ->get();
                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);
                }
                elseif($request->end_date){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereDate('transactions.date', '<=' ,$request->end_date)
                    ->get();
                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->driver){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.user_id', '<=' ,$request->driver)
                    ->get();
                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->boundary){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.boundary','=',$request->boundary)
                    ->get();

                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->expenses){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.expenses','=',$request->expenses)
                    ->get();

                    // $this->toPdf($generate );
                    // $pdf = \App::make('dompdf.wrapper');
                    // $pdf->loadHTML($this->toPdf($generate));
                    // return $pdf->stream();

                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->bonds){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.bond','=',$request->bonds)
                    ->get();


                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->expenses == 0){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.expenses','=',$request->expenses)
                    ->get();



                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }
                elseif($request->bonds == 0){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.bond','=',$request->bonds)
                    ->get();


                    return view('transactions.admin.report_result',compact('generate','drivers','boundary','expenses','bonds','values'),['tbl' => 1]);

                }

                

                $generate = DB::table('transactions')
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->select('users.name', 'transactions.*')
                ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                ->where('users.name','=',$request->driver)
                ->get();

                return view('transactions.admin.reports',compact('generate','drivers'),['tbl' => 1]);
                break;
    // Export
            case 'export':


                if($request->start_date && $request->end_date && $request->driver && $request->boundary && $request->expenses && $request->bonds){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->where('users.name','=',$request->driver)
                    ->where('transactions.boundary','=',$request->boundary)
                    ->where('transactions.expenses','=',$request->expenses)
                    ->where('transactions.bond','=',$request->bonds)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
        
                    
                   
        
                }
                elseif($request->start_date && $request->end_date && $request->driver && $request->boundary && $request->expenses){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->where('users.name','=',$request->driver)
                    ->where('transactions.boundary','=',$request->boundary)
                    ->where('transactions.expenses','=',$request->expenses)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
        
                   
        
                }
                elseif($request->start_date && $request->end_date && $request->driver && $request->boundary){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->where('users.name','=',$request->driver)
                    ->where('transactions.boundary','=',$request->boundary)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
        
                   
        
                }
                elseif($request->start_date && $request->end_date && $request->driver){
                     $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->where('users.name','=',$request->driver)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
        
                   
        
                }
                elseif($request->start_date && $request->end_date){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereBetween('transactions.date',[$request->start_date,$request->end_date])
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
                   
                }
                elseif($request->start_date){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.date','>=',$request->start_date)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
                   
                }
                elseif($request->end_date){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->whereDate('transactions.date', '<=' ,$request->end_date)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
                   
        
                }
                elseif($request->driver){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.user_id', '<=' ,$request->driver)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
                   
        
                }
                elseif($request->boundary){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.boundary','=',$request->boundary)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
        
        
                }
                elseif($request->expenses){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.expenses','=',$request->expenses)
                    ->get();
        
                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
        
                   
        
                }
                elseif($request->bonds){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.bond','=',$request->bonds)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();

        
                }
                elseif($request->expenses == 0){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.expenses','=',$request->expenses)
                    ->get();
        
                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
        
                }
                elseif($request->bonds == 0){
                    $generate = DB::table('transactions')
                    ->join('users', 'users.id', '=', 'transactions.user_id')
                    ->select('users.name', 'transactions.*')
                    ->where('transactions.bond','=',$request->bonds)
                    ->get();

                    $this->toPdf($generate );
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($this->toPdf($generate));
                    return $pdf->stream();
        
                }
                break;
    
        }


       

    }

    

    public function toPdf($request){
        $output = '
        <style>
            div.header {
                display: block; text-align: center; 
                position: running(header);
            }
            div.footer {
                display: block; text-align: center;
                position: running(footer);
            }
            @page {
                @top-center { content: element(header) }
            }
            @page { 
                @bottom-center { content: element(footer) }
            }
            </style>
        <div class="header">
            <h3>Ganduyan Taxi Tours</h3>
            <h4>Transactions Data</h4>
            <p></p>
        </div>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
         <tr>
       <th style="border: 1px solid; padding:12px;" width="20%">Date</th>
       <th style="border: 1px solid; padding:12px;" width="30%">Driver</th>
       <th style="border: 1px solid; padding:12px;" width="15%">Boundary</th>
       <th style="border: 1px solid; padding:12px;" width="15%">Bond</th>
       <th style="border: 1px solid; padding:12px;" width="20%">Expenses</th>
      </tr>
        ';  
        foreach($request as $generate)
        {
        $output .= '
        <tr>
        <td style="border: 1px solid; padding:12px;">'.$generate->date.'</td>
        <td style="border: 1px solid; padding:12px;">'.$generate->name.'</td>
        <td style="border: 1px solid; padding:12px;">'.$generate->boundary.'</td>
        <td style="border: 1px solid; padding:12px;">'.$generate->bond.'</td>
        <td style="border: 1px solid; padding:12px;">'.$generate->expenses.'</td>
        </tr>
        ';
        }
        $output .= '</table>';
        return $output;


    }



    // function pdf()
    // {
    //  $pdf = \App::make('dompdf.wrapper');
    //  $pdf->loadHTML($this->toPdf());
    //  return $pdf->stream();
    // }



}
