<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BlogController extends Controller
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

    public function add_blog(){
        $this->authlogin();
    	return view('admin.add_blog');
    }

    public function list_blog(){
        $this->authlogin();
    	$list_blog = DB::table('tbl_blog')->paginate(5);
    	$manage_blog = view('admin.list_blog')->with('list_blog',$list_blog);
    	return view('admin_layout')->with('admin.list_blog',$manage_blog);
    }
    
    public function save_blog(Request $request){
        $this->authlogin();
    	$data = array();
    	$data['blog_name'] = $request->blog_name;
    	$data['blog_content'] = $request->blog_content;
    	$data['blog_status'] = $request->blog_status;

    	$get_img = $request->file('blog_image');
    	if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/blog',$new_img);
            $data['blog_image'] = $new_img;
            DB::table('tbl_blog')->insert($data);
            Session::put('message','Add new blog successfull');
            return Redirect::to('add-blog');
    	}
        $data['blog_image'] = '';

    	DB::table('tbl_blog')->insert($data);
    	Session::put('message','Add new blog successfull');
    	return Redirect::to('add-blog');
    }

    public function active_blog($bl_id){
        $this->authlogin();
    	DB::table('tbl_blog')->where('blog_id',$bl_id)->update(['blog_status'=>1]);
    	Session::put('message','Active successfull');
    	return Redirect::to('list-blog');
    }

    public function unactive_blog($bl_id){
        $this->authlogin();
    	DB::table('tbl_blog')->where('blog_id',$bl_id)->update(['blog_status'=>0]);
    	Session::put('message','Unactive successfull');
    	return Redirect::to('list-blog');
    }

    public function edit_blog($bl_id){
        $this->authlogin();
        $edit_blog = DB::table('tbl_blog')->where('blog_id',$bl_id)->get();
        $manage_blog = view('admin.edit_blog')->with('edit_blog',$edit_blog);
        return view('admin_layout')->with('admin.edit_blog',$manage_blog);
    }

    public function update_blog(Request $request,$bl_id){
        $this->authlogin();
        $data = array();
        $data['blog_name'] = $request->blog_name;
        $data['blog_content'] = $request->blog_content;

        $get_img = $request->file('blog_image');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/blog',$new_img);
            $data['blog_image'] = $new_img;
            DB::table('tbl_blog')->where('blog_id',$bl_id)->update($data);
            Session::put('message','Edit blog successfull');
            return Redirect::to('list-blog');
        }

        DB::table('tbl_blog')->where('blog_id',$bl_id)->update($data);
        Session::put('message','Update blog successfull');
        return Redirect::to('list-blog');
    }
    
    public function delete_blog($bl_id){
        $this->authlogin();
        DB::table('tbl_blog')->where('blog_id',$bl_id)->delete();
        Session::put('message','Delete blog successfull');
        return Redirect::to('list-blog');
    }
    // end function admin page
    
    // Home page 

    public function blog_content(Request $request, $bl_id){
        $category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
        $blog_content = DB::table('tbl_blog')->where('blog_id',$bl_id)->get();

        foreach ($blog_content as $key => $value) {
            $meta_desc = $value->blog_name;
            $meta_keywords = $value->blog_name;
            $url_canonical = $request->url();
            $meta_title = "Shiseido | Beauty Blog | ".$value->blog_name;
        }

        return View('pages.blog.blog_content')->with('category',$category_name)->with('brand',$brand_name)->with('blog',$blog_content)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }
    public function show_blog(Request $request){
    	$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
        $all_blog = DB::table('tbl_blog')->where('blog_status','1')->orderby('blog_id','desc')->paginate(3);

        $meta_desc = "Beauty from our world to yours Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "Shiseido | Beauty Blog";

    	return view('pages.blog.show_blog')->with('category',$category_name)->with('brand',$brand_name)->with('blog',$all_blog)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }
    // end function home page
}
