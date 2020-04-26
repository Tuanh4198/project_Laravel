<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function index(){
    	return view('admin_login');
    }

    public function authlogin(){        
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function show_dashboard(){
        $this->authlogin();
    	return view('admin.dashboard');
    }

    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);    	
    	$result = DB::table('tbl_admins')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();

        $product = DB::table('tbl_product')->count();
        $brand = DB::table('tbl_brand_product')->count();
        $category = DB::table('tbl_category_product')->count();
        $order = DB::table('tbl_order')->where('order_status','Pending')->count();
        $mesage = DB::table('tbl_messenger')->count();

    	if ($result) {
    		Session::put('admin_name',$result->admin_name);
            Session::put('admin_polici',$result->admin_polici);
            Session::put('admin_email',$result->admin_email);
            Session::put('admin_phone',$result->admin_phone);
            Session::put('staff_img',$result->staff_img);
            Session::put('staff_address',$result->staff_address);
    		Session::put('admin_id',$result->admin_id);

            Session::put('product',$product);
            Session::put('brand',$brand);
            Session::put('category',$category);
            Session::put('order',$order);
            Session::put('mesage',$mesage);

    		return Redirect::to('/dashboard');
    	}
    	else{
    		Session::put('message','Please check your EMAIL or PASSWORD');
    		return Redirect::to('/admin');
    	}   	
    }
    
    public function logout(){
        $this->authlogin();
    	Session::put('admin_name',null);
    	Session::put('admin_id',null);
    	return Redirect::to('/admin');
    }
    
    // staff acc
    public function add_staff(){
        $this->authlogin();
        return view('admin.add_staff');
    }

    public function list_staff(){
        $this->authlogin();
        $list_staff = DB::table('tbl_admins')->get();
        $manage_staff = view('admin.list_staff')->with('list_staff',$list_staff);
        return view('admin_layout')->with('admin.list_staff',$manage_staff);
    }
    
    public function save_staff(Request $request){
        $this->authlogin();
        $data = array();
        $data['admin_name'] = $request->admin_name;
        $data['admin_phone'] = $request->admin_phone;
        $data['admin_email'] = $request->admin_email;
        $data['admin_password'] = md5($request->admin_password);
        $data['staff_address'] = $request->staff_address;
        $data['admin_polici'] = $request->admin_polici;

        $get_img = $request->file('staff_img');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/admin',$new_img);
            $data['staff_img'] = $new_img;
            DB::table('tbl_admins')->insert($data);
            Session::put('message','Add new staff successfull');
            return Redirect::to('add-staff');
        }
        $data['staff_img'] = '';

        DB::table('tbl_admins')->insert($data);
        Session::put('message','Add new staff successfull');
        return Redirect::to('add-staff');
    }

    public function active_staff($sta_id){
        $this->authlogin();
        DB::table('tbl_admins')->where('admin_id',$sta_id)->update(['admin_polici'=>1]);
        Session::put('message','Active successfull');
        return Redirect::to('list-staff');
    }

    public function unactive_staff($sta_id){
        $this->authlogin();
        DB::table('tbl_admins')->where('admin_id',$sta_id)->update(['admin_polici'=>0]);
        Session::put('message','Unactive successfull');
        return Redirect::to('list-staff');
    }

    public function edit_staff($sta_id){
        $this->authlogin();
        $edit_staff = DB::table('tbl_admins')->where('admin_id',$sta_id)->get();
        $manage_staff = view('admin.edit_staff')->with('edit_staff',$edit_staff);
        return view('admin_layout')->with('admin.edit_staff',$manage_staff);
    }

    public function pass_staff($sta_id){
        $this->authlogin();
        $edit_staff = DB::table('tbl_admins')->where('admin_id',$sta_id)->get();
        $manage_staff = view('admin.pass_staff')->with('edit_staff',$edit_staff);
        return view('admin_layout')->with('admin.edit_staff',$manage_staff);
    }

    public function updatepass_staff(Request $request,$sta_id){
        $this->authlogin();
        $data = array();
        $data['admin_password'] = md5($request->admin_password);
        DB::table('tbl_admins')->where('admin_id',$sta_id)->update($data);
        Session::put('message','Update password successfull');
        return Redirect::to('dashboard');
    }

    public function update_staff(Request $request,$sta_id){
        $this->authlogin();
        $data = array();
        $data['admin_name'] = $request->admin_name;
        $data['admin_phone'] = $request->admin_phone;
        $data['admin_email'] = $request->admin_email;
        $data['staff_address'] = $request->staff_address;
        $get_img = $request->file('staff_img');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/staff',$new_img);
            $data['staff_img'] = $new_img;
            DB::table('tbl_admins')->where('admin_id',$sta_id)->update($data);
            Session::put('message','Edit staff successfull');
            return Redirect::to('list-staff');
        }
        DB::table('tbl_admins')->where('admin_id',$sta_id)->update($data);
        Session::put('message','Update staff successfull');
        return Redirect::to('list-staff');
    }
    
    public function delete_staff($sta_id){
        $this->authlogin();
        DB::table('tbl_admins')->where('admin_id',$sta_id)->delete();
        Session::put('message','Delete staff successfull');
        return Redirect::to('list-staff');
    }

    public function mesage_customer(){
        $this->authlogin();
        $mesage = DB::table('tbl_messenger')->get();
        $manage_staff = view('admin.mesage-customer')->with('mesage',$mesage);
        return view('admin_layout')->with('admin.mesage-customer',$manage_staff);
    }

}
