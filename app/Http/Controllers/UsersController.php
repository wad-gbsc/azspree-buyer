<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CartHeader;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Hash;
use Mail;
use Session;
use DB;


class UsersController extends Controller
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
    public function create(Request $request)
    {
        $otp = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);

        $validator= Validator::make($request->all(),
            [
                'fullname' => 'required|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email:rfc,dns|unique:user,email',
                'contact_no' => 'required|regex:/(09)[0-9]{9}$/',
                'password' => 'required'
            ]
            // ,
            // $message = [
            //     'email.email' => 'The Email format must be ******@gmail.com .',
            //     'email.unique' => 'The Email is already been used.',
            //     'contact_no.regex' => 'The Contact Number format is invalid must be (09XXXXXXXXX).',
            // ]
        );
        // )->validate();

        if($validator->fails()){
            $response['stat']='error';
            $response['msg'] =$validator->errors();
            echo json_encode($response);
        } else {
            
        $user = new User();
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('contact_no');
        $user->password = Hash::make($request['password']);
        $user->type = 'US';
        $user->status = 'A';
        $user->create_datetime = Carbon::now();
        $user->otp = $otp;
        $user->save();

        //For SRHR
        $addcart = new CartHeader();
        $addcart->user_hash = $user->user_hash;
        $addcart->create_datetime = Carbon::now();
        $addcart->save();

        $user = User::findOrFail($user->user_hash);
        $user_hash = $user->user_hash;


        $data = array(
            'user_hash' => $user->user_hash,
            'email' => $request->input('email'),
            'otp' => $otp,
            'fullname' => $request->input('fullname')
            );

            Mail::send([], [], function ($message) use ($data) {
                $message->to($data['email'])
                    ->subject('Verify Email Address')
                    ->setBody('Hi, ' .$data['fullname']. ' Welcome to Azspree! Please verify your account. Verification Code: '.$data['otp'] , 'text/html'); // for HTML rich messages
              });
                
        $response['stat']='success';
        $response['msg']='<b>Successfully Signup.</b> Please check Your Registered Email for Verification Code to login.';
        echo json_encode($response);
        }        

    }

}
