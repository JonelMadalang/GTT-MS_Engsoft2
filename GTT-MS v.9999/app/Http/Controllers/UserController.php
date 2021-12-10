<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class UserController extends Controller
{
    function index(){

        // $users = DB::table('users')->simplepaginate(3); 
        // return view('drivers.drivers', compact('users'));
        $users = DB::table('users')
        ->join('taxi','taxi.id','=','users.taxi_id')
        ->select('users.*','taxi.model','taxi.plate_number')
        ->where('users.id','=',auth()->user()->id)
        ->get();
        return view('dashboards.users.index',compact('users'));
    }

    public function viewTransactions(){
        $transactions = DB::table('transactions')->where('user_id','=',auth()->user()->id)->simplepaginate(5); 
        return view('transactions.user.transactions',compact('transactions'));
    }

    public function edit(User $user)
    {
        return Response::json($user);
    }

    public function store(Request $request)
    {
        User::updateOrCreate(
            ['id'=>$request->id],$request->all()
        );

        return redirect()->route('users.index');
    }

    // public function show(User $user)
    // {
    //     $users = DB::table('users')
    //     ->join('taxi','taxi.id','=','users.taxi_id')
    //     ->select('users.*','taxi.model','taxi.plate_number')
    //     ->where('users.id','=',$user)
    //     ->get();
    //     return view('dashboards.users.index',compact('users'));
    // }


    public function userChangePass(){
        return view('dashboards.users.changepassword');
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


    
}
