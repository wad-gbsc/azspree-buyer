<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Http\Resources\Reference;
use App\Models\Supplier;
use App\Models\Comment;
use App\Models\User;
use App\Models\OrderHeader;
use App\Models\OrderDetail;
use App\Models\CartHeader;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Session;
use DB;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('user_hash')){

            $srhr_hash = session('user_hash');
            $title = 'MyCart';

            $data['mycart'] = CartDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
            ->where('srln.srhr_hash', $srhr_hash)
            ->where('srln.status', 0)
            ->where('srln.is_deleted', 0)
            ->orderBy('srln.srhr_hash', 'desc')
            ->get();

            $data['supplier'] =  CartDetail::leftJoin('sumr', 'sumr.sumr_hash', '=', 'srln.sumr_hash')
            ->leftJoin('srhr', 'srhr.srhr_hash', '=', 'srln.srhr_hash')
            ->leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
            ->where('srln.srhr_hash', $srhr_hash)
            ->where('srln.status', 0)
            ->where('srln.is_deleted', 0)
            ->groupBy('srln.sumr_hash')
            ->orderBy('sumr.sumr_hash', 'desc')
            ->get();

        return view('pages.mycart')->with('data', $data);
    }else{
        return view('pages.login');
        }
    }

    public function indexcheckout()
    {
        if(Session::has('user_hash')){

            $srhr_hash = session('user_hash');
            $title = 'checkout';

            $data['mycart'] = CartDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
            ->where('srln.srhr_hash', $srhr_hash)
            ->where('srln.is_selected', 1)
            ->where('srln.status', 0)
            ->where('srln.is_deleted', 0)
            ->orderBy('srln.srhr_hash', 'desc')
            ->get();

            $data['supplier'] =  CartDetail::leftJoin('sumr', 'sumr.sumr_hash', '=', 'srln.sumr_hash')
            ->leftJoin('srhr', 'srhr.srhr_hash', '=', 'srln.srhr_hash')
            ->where('srln.srhr_hash', $srhr_hash)
            ->where('srln.is_selected', 1)
            ->where('srln.status', 0)
            ->where('srln.is_deleted', 0)
            ->groupBy('srln.sumr_hash')
            ->orderBy('sumr.sumr_hash', 'desc')
            ->get();

            // $data['address'] = DB::table('addr')->distinct('region')->distinct('province')->distinct('city')->distinct('barangay')->get();
            // $data['region'] =  DB::table('addr')->select('region')->distinct()->where('addr.region', 'Region 3 Central Luzon')->get();
    
            $data['tbl_region'] =  DB::table('regn')->get();
            $data['tbl_province'] =  DB::table('prov')->get();
            $data['tbl_city'] =  DB::table('city')->get();
            $data['tbl_brgy'] =  DB::table('brgy')->get();

        return view('pages.checkout')->with('data', $data);
    }else{
        return view('pages.login');
        }
    }

    public function getProvinceList($regn_hash)
    {
    $province =  DB::table('prov')
    ->leftJoin('regn', 'regn.regn_hash', '=', 'prov.regn_hash')
    ->select('prov_hash','province')
    ->where('prov.regn_hash', $regn_hash )
    ->get();

    return response()->json($province);
    }

    public function getCityList($prov_hash)
    {
    $city =  DB::table('city')
    ->leftJoin('regn', 'regn.regn_hash', '=', 'city.regn_hash')
    ->leftJoin('prov', 'prov.prov_hash', '=', 'city.prov_hash')
    ->select('city_hash','city')
    ->where('city.prov_hash', $prov_hash )
    ->get();

    return response()->json($city);
    }

    public function getBarangayList($city_hash)
    {
    // $barangay =  DB::table('brgy')
    // ->leftJoin('regn', 'regn.regn_hash', '=', 'brgy.regn_hash')
    // ->leftJoin('prov', 'prov.prov_hash', '=', 'brgy.prov_hash')
    // ->leftJoin('city', 'city.city_hash', '=', 'brgy.city_hash')
    // ->select('brgy_hash','barangay')
    // ->where('brgy.city_hash', $city_hash )
    // ->get();
    $ursf = DB::table('ursf')
            ->select('shipping_fee', 'sumr_hash')
            ->where('city_hash', $city_hash)
            ->get();




    return response()->json($ursf);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create(Request $request)
    {
        if(Session::has('user_hash')){
        $srhr_hash = session('user_hash');
        $title = 'MyCart';
        $data['mycart'] =  User::where('is_deleted', 0)->findOrFail($srhr_hash);
          
        $products = Product::where('inmr_hash', $request['inmr_hash'])->firstOrFail();
   
        $qty = $products->available_qty;

        $validator = Validator::make($request->all(),
        [
            'qty' => 'required|numeric|min:1|max:'.$qty
        ]
        );
        // )->validate();

        if($validator->fails()){
            $response['stat']='error';
            $response['msg']='<b>Sorry, Low Available stock you can olny checkout '.$qty.' pieces</b>';
            echo json_encode($response);
        } else {
            $addcart = new CartDetail();
            $addcart->srhr_hash = $srhr_hash;
            $addcart->inmr_hash = $request['inmr_hash'];
            $addcart->sumr_hash = $request['sumr_hash'];
            $addcart->unit_price = $request['cost_amt'];
            $addcart->qty = $request->input('qty');
            $addcart->variant_1 = $request->input('variant_1');
            $addcart->variant_2 = $request->input('variant_2');
            $addcart->dimension = $request['dimension'];
            $addcart->weight = $request['weight'];
            $addcart->create_datetime = Carbon::now();
            $addcart->save();

            $response['stat']='success';
            $response['msg']='<b>Successfully Added To Cart.</b>';
            echo json_encode($response);
        }        
    }
}


        public function createmsg(Request $request)
            {
                if(Session::has('user_hash')){
                    $user_hash = session('user_hash');

                    $validator = Validator::make($request->all(),
                    [
                        'comment' => 'required'
                    ]
                    );
                
                    $addcart = new Comment();
                    $addcart->user_hash = $user_hash;
                    $addcart->inmr_hash = $request['inmr_hash'];
                    $addcart->sumr_hash = $request['sumr_hash'];
                    $addcart->comment = $request->input('comment');
                    $addcart->created_datetime = Carbon::now();
                    $addcart->save();

                    $response['stat']='success';
                    $response['msg']='<b>Your comment has been posted.</b>';
                    echo json_encode($response);
                }        
            }


        public function placeorder(Request $request)
        {
            if(Session::has('user_hash')){
            $srhr_hash = session('user_hash');
            $title = 'MyOrder';
            $data['oder'] =  User::where('is_deleted', 0)->findOrFail($srhr_hash);
            
            $ursf = DB::table('ursf')
            ->select('shipping_fee', 'sumr_hash')
            ->where('city_hash', $request->input('city'))
            // ->where('sumr_sumr', $request->input('city'))
            ->get();
        
            $mycart = CartDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'srln.inmr_hash')
            ->where('srln.srhr_hash', $srhr_hash)
            ->where('srln.is_selected', 1)
            ->where('srln.status', 0)
            ->where('srln.is_deleted', 0)
            ->orderBy('srln.srhr_hash', 'desc')
            ->get();

            $supplier =  CartDetail::leftJoin('sumr', 'sumr.sumr_hash', '=', 'srln.sumr_hash')
            ->leftJoin('srhr', 'srhr.srhr_hash', '=', 'srln.srhr_hash')
            ->where('srln.srhr_hash', $srhr_hash)
            ->where('srln.is_selected', 1)
            ->where('srln.status', 0)
            ->where('srln.is_deleted', 0)
            ->groupBy('srln.sumr_hash')
            ->orderBy('sumr.sumr_hash', 'desc')
            ->get();

            for ($i=0; $i < count($supplier); $i++) { 

                $unit_total = 0; 
                $order_subtotal = 0; 
                $total_qty = 0; 
                $shipping = 0; 
                $shipping_extra = 0;
                $shipping_city = 0; 
                $order_total = 0; 
                $cart_subtotal = 0; 
                $total_shipping = 0; 
                $total_payment = 0;
                $dimension = 0;
                $weight = 0;
                $total_kg = 0;
                $max_kg = 5;
                $sub_1 = 0;
                $sub_2 = 0;


                $order = new OrderHeader();
                $order->order_no = date('Ymd').'-';
                $order->order_date = date("Y-m-d");
                $order->regn_hash = $request->input('region');
                $order->prov_hash = $request->input('province');
                $order->city_hash = $request->input('city');
                $order->brgy_hash = $request->input('barangay');
                $order->address = $request->input('address');
                $order->user_hash = $srhr_hash;
                $order->sumr_hash = $supplier[$i]->sumr_hash;
                $order->payment_method = $request->input('payment_method');
                $order->create_datetime = Carbon::now();
                // $order->expire_cancel_datetime = Carbon::now()->addHours(5);
                $order->save();

                $sohr_hash = $order->sohr_hash;
                

                for ($a=0; $a < count($mycart); $a++) { 
                    if($supplier[$i]->sumr_hash == $mycart[$a]->sumr_hash){

                        $unit_total =$mycart[$a]->unit_price * $mycart[$a]->qty; 
                        $order_subtotal += $unit_total;
                        $total_qty += $mycart[$a]->qty;

                        $city_sumr_hash= $ursf[0]->sumr_hash;
                        $shipping_city= $ursf[0]->shipping_fee;
                        $dimension = $mycart[$a]->dimension;
                        $weight = $mycart[$a]->weight;

                        if ($dimension > $weight){
                            if ($dimension > $max_kg){
                                $sub_1= ($dimension - $max_kg);
                                $sub_2 = ($sub_1 * $max_kg );
                                $total_kg = ($sub_2 * $mycart[$a]->qty );
                            }else{
                                $total_kg = $dimension;

                            }
                        }else if($dimension = $weight){
                            if ($weight > $max_kg){
                                $sub_1= ($weight - $max_kg);
                                $sub_2 = ($sub_1 * $max_kg );
                                $total_kg = ($sub_2 * $mycart[$a]->qty );
                            }else{
                                $total_kg = $weight;

                            }
                        }else{
                            if ($weight > $max_kg){
                                $sub_1= ($weight - $max_kg);
                                $sub_2 = ($sub_1 * $max_kg);
                                $total_kg = ($sub_2 * $mycart[$a ]->qty );
                            }else{
                                $total_kg = $weight;

                            }
                        }
                        $shipping_extra += $total_kg;
                        $shipping = $shipping_extra + $shipping_city;
                        $order_total = $order_subtotal+$shipping; 
                        
                        $orderdetail = new OrderDetail();
                        $orderdetail->sohr_hash = $sohr_hash;
                        $orderdetail->inmr_hash = $mycart[$a]->inmr_hash;
                        $orderdetail->qty = $mycart[$a]->qty;
                        $orderdetail->unit_price = $mycart[$a]->unit_price;
                        $orderdetail->dimension = $mycart[$a]->dimension;
                        $orderdetail->weight = $mycart[$a]->weight;
                        $orderdetail->excess_fee = $sub_2;
                        $orderdetail->excess_kg = $sub_1;
                        $orderdetail->create_datetime = Carbon::now();
                        $orderdetail->save();


                        DB::table('srln')->where('srln_hash', $mycart[$a]->srln_hash)->update(['status' => '1']);   
                        DB::table('inmr')->where('inmr_hash', $mycart[$a]->inmr_hash)->decrement('available_qty',$orderdetail->qty);
           
                    }   

                }
                // sleep(60);

                $order = OrderHeader::findOrFail($sohr_hash);
                $order->order_no = date('Ymd').'-'.$sohr_hash;
                $order->total_qty = $total_qty;
                $order->order_subtotal = $order_subtotal;
                $order->shipping_fee = $shipping;
                $order->city_sumr_hash = $city_sumr_hash;
                $order->disc_amt = 0;
                $order->order_total = $order_total;
                $order->save();
            }
            DB::table('user')->where('user_hash', $sohr_hash)->update(['regn_hash' => $request->input('barangay'), 'prov_hash' => $request->input('province'), 'city_hash' => $request->input('city'), 'brgy_hash' => $request->input('region'), 'address' => $request->input('address')]);  

            $response['stat']='success';
            $response['msg']='<b>ORDER PLACED SUCCESSFULLY.</b>';
            echo json_encode($response);
        }
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $data['products'] = Product::leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
        ->leftJoin('insc', 'insc.insc_hash', '=', 'inmr.insc_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'inmr.sumr_hash')
        ->findOrFail($id);

        $data['products'] = Product::leftJoin('inct', 'inct.inct_hash', '=', 'inmr.inct_hash')
        ->leftJoin('insc', 'insc.insc_hash', '=', 'inmr.insc_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'inmr.sumr_hash')
        ->groupBy('inmr.sumr_hash')
        ->findOrFail($id);

        $data['comment'] = Comment::leftJoin('inmr', 'inmr.inmr_hash', '=', 'cmnt.inmr_hash')
        ->leftJoin('user', 'user.user_hash', '=', 'cmnt.user_hash')
        ->leftJoin('sumr', 'sumr.sumr_hash', '=', 'cmnt.sumr_hash')
        ->where('cmnt.inmr_hash',$id)
        ->orderBy('cmnt.cmnt_hash','desc')
        ->paginate(3);

        $data['order'] = OrderDetail::leftJoin('inmr', 'inmr.inmr_hash', '=', 'soln.inmr_hash')
            ->leftJoin('sohr', 'sohr.sohr_hash', '=', 'soln.sohr_hash')
            ->leftJoin('user', 'user.user_hash', '=', 'sohr.user_hash')
            ->where('soln.status_ratings', 1)
            ->where('soln.inmr_hash',$id)
            // ->where('soln.inmr_hash',$id)
            // ->orderBy('soln.sohr_hash', 'desc')
            ->paginate(5);
        
        return view('pages.productdetails')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
            
        
            $srhr_hash = session('user_hash');
            $title = 'MyCart';
            $data['mycart'] =  User::where('is_deleted', 0)->findOrFail($srhr_hash);

            $addcart = CartDetail::findOrFail($id);
            $addcart->srhr_hash = $srhr_hash;
            $addcart->qty = $request->input('qty');
            $addcart->update_datetime = Carbon::now();
            $addcart->save();

            // return redirect('/mycart')->with('successMsg', ' Successfully updated!');

    }

    public function updatecart(Request $request)
    {       

            $id = $request->srln_hash;
            
            $updatecart = CartDetail::findOrFail($id);
            $updatecart->is_selected = $request->is_selected;
            $updatecart->save();

    }   
    
    
    public function updateqty(Request $request)
    {       

            $products = Product::where('inmr_hash', $request['inmr_hash'])->firstOrFail();
            $qty = $products->available_qty;
            $id = $request->srln_hash;
            
            $updatecart = CartDetail::findOrFail($id);
            $validator = Validator::make($request->all(),
            [
                'qty' => 'required|numeric|min:1|max:'.$qty
            ]
        );
        //  )->validate();

         if($validator->fails()){
            $response['stat']='error';
            $response['msg']='<b style="color:red">Sorry, Low stock available you can olny checkout '.$qty.' pieces</b>';
            $response['qty']=$qty;
        } else {
            $updatecart->qty = $request->qty;
            $updatecart->save();

            $response['stat']='success';
            $response['msg']='<b>Ready to Checkout</b>';
        }   

        echo json_encode($response);
            
    }   

    public function delete($id)
    {   
        $addcart = CartDetail::findOrFail($id);

        $addcart->is_deleted = 1;
        $addcart->update_datetime = Carbon::now();
        $addcart->save();

        // return redirect('/mycart')->with($response['stat']='success', $response['msg']='<b>Successfully Deleted.</b>');
        return redirect('/mycart')->with('successMsg', ' Successfully Deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
