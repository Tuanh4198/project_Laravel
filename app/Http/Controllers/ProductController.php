<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    // admin function
    public function authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_product(){
        $this->authlogin();
    	$category_name = DB::table('tbl_category_product')->orderby('category_name')->get();
    	$brand_name = DB::table('tbl_brand_product')->orderby('brand_name')->get();
    	return view('admin.add_product')->with('category_name',$category_name)->with('brand_name',$brand_name);
    }

    public function list_product(){
        $this->authlogin();
    	$list_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
    	$manage_product = view('admin.list_product')->with('list_product',$list_product);
    	return view('admin_layout')->with('admin.list_product',$manage_product);
    }
    
    public function save_product(Request $request){
        $this->authlogin();
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_desc'] = $request->product_describe;
    	$data['product_status'] = $request->product_status;
    	$data['product_price'] = $request->product_price;
    	$data['product_content'] = $request->product_content;
    	$data['brand_id'] = $request->brand_id;
        $data['category_id'] = $request->category_id;
        $data['product_qty'] = $request->product_qty;
    	$get_img = $request->file('product_image'); 
    	if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/product',$new_img);
            $data['product_image'] = $new_img;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Add new product successfull');
            return Redirect::to('add-product');
    	}
        $data['product_image'] = '';

    	DB::table('tbl_product')->insert($data);
    	Session::put('message','Add new product successfull');
    	return Redirect::to('add-product');
    }

    public function active_product($pro_id){
        $this->authlogin();
    	DB::table('tbl_product')->where('product_id',$pro_id)->update(['product_status'=>1]);
    	Session::put('message','Active successfull');
    	return Redirect::to('list-product');
    }

    public function unactive_product($pro_id){
        $this->authlogin();
    	DB::table('tbl_product')->where('product_id',$pro_id)->update(['product_status'=>0]);
    	Session::put('message','Unactive successfull');
    	return Redirect::to('list-product');
    }

    public function edit_product($pro_id){
        $this->authlogin();
        $category_name = DB::table('tbl_category_product')->orderby('category_name')->get();
        $brand_name = DB::table('tbl_brand_product')->orderby('brand_name')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$pro_id)->get();
        $manage_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('category_name',$category_name)->with('brand_name',$brand_name);
        return view('admin_layout')->with('admin.edit_product',$manage_product);
    }

    public function update_product(Request $request,$pro_id){
        $this->authlogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_describe;
        $data['product_price'] = $request->product_price;
        $data['product_content'] = $request->product_content;
        $data['brand_id'] = $request->brand_id;
        $data['category_id'] = $request->category_id; 
        $data['product_qty'] = $request->product_qty;
        $get_img = $request->file('product_img');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/product',$new_img);
            $data['product_image'] = $new_img;
            DB::table('tbl_product')->where('product_id',$pro_id)->update($data);
            Session::put('message','Edit product successfull');
            return Redirect::to('list-product');
        }
        DB::table('tbl_product')->where('product_id',$pro_id)->update($data);
        Session::put('message','Edit product successfull');
        return Redirect::to('list-product');
    }
    
    public function delete_product($pro_id){
        $this->authlogin();
        DB::table('tbl_product')->where('product_id',$pro_id)->delete();
        Session::put('message','Delete product successfull');
        return Redirect::to('list-product');
    }
    // and admin function

    // user
    public function product_detail(Request $request, $pro_id){
        $category_id = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_id = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $product_detail = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$pro_id)->get();
        foreach ($product_detail as $key => $value) {
            $category_pro_id = $value->category_id;
            $meta_desc = $value->product_content;
            $meta_keywords = $value->product_name;
            $url_canonical = $request->url();
            $meta_title = "Shiseido | Product Detail | ".$value->product_name;
        }
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_pro_id)->whereNotIn('tbl_product.product_id',[$pro_id])
        ->limit(4)->get();
        $comment = DB::table('tbl_comment_product')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_comment_product.customer_id')
        ->where('tbl_comment_product.product_id',$pro_id)->get();
        return view('pages.product.product_detail')->with('category', $category_id)->with('brand', $brand_id)->with('product_detail', $product_detail)->with('related_product', $related_product)->with('comment', $comment)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }

    // comment
    public function save_comment(Request $request){
        $userId = $request->customer_id;
        if($userId != ''){
            $data = array();
            $data['customer_id'] = $request->customer_id;
            $data['product_id'] = $request->product_id;
            $data['comment_content'] = $request->comment;
            DB::table('tbl_comment_product')->insert($data);
            Session::put('message','Comment successfull!');
            return back()->withInput();
        } else {
            return Redirect::to('login-checkout');
        }
    }

}
