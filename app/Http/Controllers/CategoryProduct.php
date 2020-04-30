<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
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

    public function add_category(){
        $this->authlogin();
    	return view('admin.add_category');
    }

    public function list_category(){
        $this->authlogin();
    	$list_category = DB::table('tbl_category_product')->paginate(5);
    	$manage_category = view('admin.list_category')->with('list_category',$list_category);
    	return view('admin_layout')->with('admin.list_category',$manage_category);
    }
    
    public function save_category(Request $request){
        $this->authlogin();
    	$data = array();
    	$data['category_name'] = $request->category_name;
    	$data['category_desc'] = $request->category_describe;
    	$data['category_status'] = $request->category_status;

    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message','Add new category successfull');
    	return Redirect::to('add-category');
    }

    public function active_category($cat_id){
        $this->authlogin();
    	DB::table('tbl_category_product')->where('category_id',$cat_id)->update(['category_status'=>1]);
    	Session::put('message','Active successfull');
    	return Redirect::to('list-category');
    }

    public function unactive_category($cat_id){
        $this->authlogin();
    	DB::table('tbl_category_product')->where('category_id',$cat_id)->update(['category_status'=>0]);
    	Session::put('message','Unactive successfull');
    	return Redirect::to('list-category');
    }

    public function edit_category($cat_id){
        $this->authlogin();
        $edit_category = DB::table('tbl_category_product')->where('category_id',$cat_id)->get();
        $manage_category = view('admin.edit_category')->with('edit_category',$edit_category);
        return view('admin_layout')->with('admin.edit_category',$manage_category);
    }

     public function update_category(Request $request,$cat_id){
        $this->authlogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_describe;
        DB::table('tbl_category_product')->where('category_id',$cat_id)->update($data);
        Session::put('message','Update category successfull');
        return Redirect::to('list-category');
    }
    
     public function delete_category($cat_id){
        $this->authlogin();
        DB::table('tbl_category_product')->where('category_id',$cat_id)->delete();
        Session::put('message','Delete category successfull');
        return Redirect::to('list-category');
    }
    // end function admin page
    
    // Home page 
    public function show_category_product(Request $request, $cat_id){
        $category_id = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();       
        $brand_id = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $list_product_category_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_product.category_id',$cat_id)->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$cat_id)->limit(1)->get();
        foreach($category_name as $key => $cate ){
            $meta_desc = $cate->category_desc;
            $meta_keywords = $cate->category_name;
            $url_canonical = $request->url();
            $meta_title = "Shiseido | Category | ".$cate->category_name;
        }
        return View('pages.category.show_category')->with('category',$category_id)->with('brand',$brand_id)->with('list_product_category_id',$list_product_category_id)->with('category_name',$category_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }
    // end function home page
}
