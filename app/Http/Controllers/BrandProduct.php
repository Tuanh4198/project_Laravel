<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
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
    
    public function add_brand(){
        $this->authlogin();
    	return view('admin.add_brand');
    }

    public function list_brand(){
        $this->authlogin();
    	$list_brand = DB::table('tbl_brand_product')->paginate(5);
    	$manage_brand = view('admin.list_brand')->with('list_brand',$list_brand);
        $product = DB::table('tbl_product')->count();
        $brand = DB::table('tbl_brand_product')->count();
        $category = DB::table('tbl_category_product')->count();
    	return view('admin_layout')->with('admin.list_brand',$manage_brand)->with('product',$product);
    }
    
    public function save_brand(Request $request){
        $this->authlogin();
    	$data = array();
    	$data['brand_name'] = $request->brand_name;
    	$data['brand_desc'] = $request->brand_describe;
    	$data['brand_status'] = $request->brand_status;

        $get_img = $request->file('brand_image');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/brand',$new_img);
            $data['brand_img'] = $new_img;
            DB::table('tbl_brand_product')->insert($data);
            Session::put('message','Add new brand successfull');
            return Redirect::to('add-brand');
        }
        $data['brand_img'] = '';

    	DB::table('tbl_brand_product')->insert($data);
    	Session::put('message','Add new brand successfull');
    	return Redirect::to('add-brand');
    }

    public function active_brand($bra_id){
        $this->authlogin();
    	DB::table('tbl_brand_product')->where('brand_id',$bra_id)->update(['brand_status'=>1]);
    	Session::put('message','Active successfull');
    	return Redirect::to('list-brand');
    }

    public function unactive_brand($bra_id){
        $this->authlogin();
    	DB::table('tbl_brand_product')->where('brand_id',$bra_id)->update(['brand_status'=>0]);
    	Session::put('message','Unactive successfull');
    	return Redirect::to('list-brand');
    }

    public function edit_brand($bra_id){
        $this->authlogin();
        $edit_brand = DB::table('tbl_brand_product')->where('brand_id',$bra_id)->get();
        $manage_brand = view('admin.edit_brand')->with('edit_brand',$edit_brand);
        return view('admin_layout')->with('admin.edit_brand',$manage_brand);
    }

    public function update_brand(Request $request,$bra_id){
        $this->authlogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_describe;
        $get_img = $request->file('brand_img');

        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/brand',$new_img);
            $data['brand_img'] = $new_img;
            DB::table('tbl_brand_product')->where('brand_id',$bra_id)->update($data);
            Session::put('message','Edit brand successfull');
            return Redirect::to('list-brand');
        }
        DB::table('tbl_brand_product')->where('brand_id',$bra_id)->update($data);
        Session::put('message','Update brand successfull');
        return Redirect::to('list-brand');
    }
    
    public function delete_brand($bra_id){
        $this->authlogin();
        DB::table('tbl_brand_product')->where('brand_id',$bra_id)->delete();
        Session::put('message','Delete brand successfull');
        return Redirect::to('list-brand');
    }
    // end function admin page

    // Home page
    public function show_brands_products(Request $request, $bra_id){
        $category_id = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();       
        $brand_id = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $list_product_brand_id = DB::table('tbl_product')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.brand_id',$bra_id)->get();
        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id',$bra_id)->limit(1)->get();
        foreach($brand_name as $key => $bra ){
            $meta_desc = $bra->brand_desc;
            $meta_keywords = $bra->brand_name;
            $url_canonical = $request->url();
            $meta_title = "Shiseido | Shop Brand | ".$bra->brand_name;
        }
        return View('pages.brand.show_brand')->with('category',$category_id)->with('brand',$brand_id)->with('list_product_brand_id',$list_product_brand_id)->with('brand_name',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }
    // end function home page
}