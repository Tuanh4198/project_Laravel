<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    // Admin page
    public function authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function discount_code(){
        $this->authlogin();
    	$list_coupon = DB::table('tbl_coupon')->orderby('coupon_id','desc')->get();
    	$manage_coupon = view('admin.discount_code')->with('list_coupon',$list_coupon);
    	return view('admin.discount_code')->with('list_coupon',$list_coupon);
    }

    public function save_code(Request $request){
        $this->authlogin();
    	$data = array();
    	$data['coupon_name'] = $request->coupon_name;
    	$data['coupon_code'] = $request->coupon_code;
        $data['coupon_qty'] = $request->coupon_qty;
    	$data['coupon_func'] = $request->coupon_func;
        $data['coupon_num'] = $request->coupon_num;
    	DB::table('tbl_coupon')->insert($data);
    	Session::put('message','Add new zip code successfull');
    	return Redirect::to('discount-code');
    }

    public function edit_coupon($cp_id){
        $this->authlogin();
        $edit_coupon = DB::table('tbl_coupon')->where('coupon_id',$cp_id)->get();
        $manage_coupon = view('admin.edit_coupon')->with('edit_coupon',$edit_coupon);
        return view('admin_layout')->with('edit_coupon',$manage_coupon);
    }

    public function update_code(Request $request,$cp_id){
        $this->authlogin();
        $data = array();
    	$data['coupon_name'] = $request->coupon_name;
    	$data['coupon_code'] = $request->coupon_code;
        $data['coupon_qty'] = $request->coupon_qty;
    	$data['coupon_func'] = $request->coupon_func;
        $data['coupon_num'] = $request->coupon_num;
        DB::table('tbl_coupon')->where('coupon_id',$cp_id)->update($data);
        Session::put('message','Update zip code successfull');
    	return Redirect::to('discount-code');
    }
    
    public function delete_coupon($cp_id){
        $this->authlogin();
        DB::table('tbl_coupon')->where('coupon_id',$cp_id)->delete();
        Session::put('message','Delete brand successfull');
        return Redirect::to('discount-code');
    }
}
