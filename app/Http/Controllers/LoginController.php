<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use DB;

class LoginController extends Controller
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
    public function login(Request $request)
    {
        Validator::make($request->all(),
            [
                'email' => 'required',
                'password' => 'required'
            ]
        )->validate();
        
        $email = $request->input('email');
        $password = $request->input('password');

        $result = User::select('*')
                    ->where('email', $email)
                    ->where('type', 'US')
                    ->where('status', 'A')
                    ->get();
        

        if(count($result) > 0){
            
            if(Hash::check($password, $result[0]->password)){
                if($result[0]->is_verified == 1){
                    session()->put('user_hash', $result[0]->user_hash);
                    session()->put('fullname', $result[0]->fullname);
                    session()->save();        
                    $response['stat']='success';
                    $response['msg']='Login Successfully.';
                }else{

                    session()->put('verify_user_hash', $result[0]->user_hash);
                    session()->save();                       
                    $response['stat']='verify';
                    $response['msg']='Please Verify your account.';
                }
            }else{
                $response['stat']='error';
                $response['msg']='Password is incorrect. Please try again. <br>';
            }

        }else{
            $response['stat']='error';
            // $response['msg']='Invalid email or password.'.count($result);
            $response['msg']='Invalid email or password.';
        }

        echo json_encode($response);
    }

    public function updateverification(Request $request)
    {
        Validator::make($request->all(),
            [
                'otp' => 'required'
            ]
        )->validate();
        
        $otp = $request->input('otp');
        $verify_user_hash = Session('verify_user_hash');

        $result = User::select('*')
                    ->where('user_hash', $verify_user_hash)
                    ->where('type', 'US')
                    ->where('status', 'A')
                    ->where('otp', $otp)
                    ->get();
                 
        if(count($result) > 0){

            session()->put('user_hash', $result[0]->user_hash);
            session()->put('fullname', $result[0]->fullname);
            session()->save();

            DB::table('user')->where('user_hash', $result[0]->user_hash)->update(['is_verified' => '1']); 

            $response['stat']='success';
            $response['msg']='Login Successfully.';
            echo json_encode($response);
        }else{
            $response['stat']='error';
            $response['msg']='Verification Code does not match. Please check code on Your email and try again.';
            echo json_encode($response);
        }
    }

    
    public function logout()
    {
        Session::forget('user_hash');
        return view('pages.login');
    }

    
    // protected function respondWithToken($token)
    // {
    //     $user = auth()->user();
    //     session()->save();
        
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => 6,
    //         'user' => $user
    //         // 'rights' => $rights
    //     ]);
    // }
}
