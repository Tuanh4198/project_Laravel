<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class SlideController extends Controller
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

    public function view_slide(){
        $this->authlogin();
        $list_slide = DB::table('tbl_slide')->orderby('slide_id','desc')->paginate(3);
    	$manage_slide = view('admin.add_slide')->with('list_slide',$list_slide);
    	return view('admin_layout')->with('admin.add_slide',$manage_slide);
    }

    public function save_slide(Request $request){
        $this->authlogin();
    	$data = array();
    	$data['slide_name'] = $request->slide_name;
    	$data['slide_status'] = $request->slide_status;
    	$get_img = $request->file('slide_img');
    	if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/slide',$new_img);
            $data['slide_img'] = $new_img;
            DB::table('tbl_slide')->insert($data);
            Session::put('message','Add new slide successfull');
            return Redirect::to('view-slide');
    	}
        $data['slide_img'] = '';

    	DB::table('tbl_slide')->insert($data);
    	Session::put('message','Add new slide successfull');
    	return Redirect::to('view-slide');
    }

    public function active_slide($bl_id){
        $this->authlogin();
    	DB::table('tbl_slide')->where('slide_id',$bl_id)->update(['slide_status'=>1]);
    	Session::put('message','Active successfull');
    	return Redirect::to('view-slide');
    }

    public function unactive_slide($bl_id){
        $this->authlogin();
    	DB::table('tbl_slide')->where('slide_id',$bl_id)->update(['slide_status'=>0]);
    	Session::put('message','Unactive successfull');
    	return Redirect::to('view-slide');
    }

    public function delete_slide($bl_id){
        $this->authlogin();
        DB::table('tbl_slide')->where('slide_id',$bl_id)->delete();
        Session::put('message','Delete slide successfull');
        return Redirect::to('view-slide');
    }
    // end function admin page
    
    // Home page 
    public function show_slide(Request $request){
    	$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
        $all_slide = DB::table('tbl_slide')->where('slide_status','1')->orderby('slide_id','desc')->paginate(3);

        $meta_desc = "Beauty from our world to yours Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "Shiseido | Beauty slide";

    	return view('pages.slide.show_slide')->with('category',$category_name)->with('brand',$brand_name)->with('slide',$all_slide)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }
    // end function home page
}