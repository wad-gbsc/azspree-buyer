<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Session;
use DB;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Azspree';
        $categories =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();
        $content =  DB::table('inmr')->where('is_deleted', 0)->orderBy('inmr_hash')->paginate(18);
        
        return view('welcome', compact('categories','content'));
    }
    public function login(){
        if(Session::has('user_hash')){
            return view('pages/profile');
        }else{
            return view('pages/login');
        }
    }
    

    public function success(){
        if(Session::has('user_hash')){
            return view('success');
        }else{
            return view('pages/login');
        }
    } 

    public function signup(){
        if(Session::has('user_hash')){
            return view('pages/profile');
        }else{
            return view('pages/signup');
        }
    }

    public function trackorder()
    {
        return view ('pages.trackorder');
    }

    public function checkout(){
        if(Session::has('user_hash')){
            return view('pages/checkout');
        }else{
            return view('pages/login');
        }
    }

    public function payment(){
        if(Session::has('user_hash')){
            return view('pages/payment');
        }else{
            return view('pages/login');
        }
    }

    

    public function mycart()
    {
        $data['products'] = Product::where('is_deleted', 0)->get();
        return view('pages.mycart')->with('data', $data);
    }

    public function verify()
    {
        return view('pages.verify');
    }

    public function search(Request $request)
    {

        $search = $request->product_details;

        $categories =  DB::table('inct')->where('is_deleted', 0)->get();

        $content=  DB::table('inmr')
        ->where('inmr.is_deleted', 0)
        ->where('product_details','like',"%".$search."%")
        ->paginate(18);

        return view ('welcome',compact('categories','content'));
    }

    public function sortbyprice(Request $request)
    {
        $sortbyprice = $request->sortbyprice;

        $categories =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();

         if ($sortbyprice == 'asc'){
            $content = DB::table('inmr')->where('inmr.is_deleted', 0)->orderBy('cost_amt','asc')->paginate(18);
            } else {
            $content = DB::table('inmr')->where('inmr.is_deleted', 0)->orderBy('cost_amt','desc')->paginate(18);
            }

        return view ('welcome',compact('categories','content'));
    }

    public function sortbypricebycat(Request $request)
    {
        $sortbypricebycat = $request->sortbypricebycat;
        $id = $request->srln_hash;

        $cat =  DB::table('inct')
        ->where('is_deleted', 0)
        ->where('inct_hash', $id)
        ->groupBy('cat_name')
        ->get();

        $category =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();

         if ($sortbypricebycat == 'asc'){
            $content = DB::table('inmr')->where('inmr.is_deleted', 0)->orderBy('cost_amt','asc')->paginate(18);
            } else {
            $content = DB::table('inmr')->where('inmr.is_deleted', 0)->orderBy('cost_amt','desc')->paginate(18);
            }

       return view ('pages.categories',compact('category','content','cat'));
    }
    public function show($id)
    {
        $content =  DB::table('inmr')
        ->leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
        ->where('inmr.is_deleted', 0)
        ->where('inmr.inct_hash', $id)
        ->paginate(18);

        $cat =  DB::table('inct')
        ->where('is_deleted', 0)
        ->where('inct_hash', $id)
        ->groupBy('cat_name')
        ->get();
    
        $category =  DB::table('inct')->where('is_deleted', 0)->orderBy('cat_name','asc')->get();

        return view ('pages.categories',compact('category','content','cat'));
    }
  

    public function profile()
    {
        return view ('pages.profile');
    }

    public function waybill()
    {
        return view ('pages.waybill');
    }

    public function welcomeseller()
    {
        return view ('pages.welcomeseller');
    }

}