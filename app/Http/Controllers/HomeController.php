<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class HomeController extends Controller
{
    public function index(Request $request){
    	$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(8)->get();

        $all_slide = DB::table('tbl_slide')->where('slide_status','1')->orderby('slide_id','desc')->get();

        $tab1 = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id','19')->limit(4)->get();

        $tab2 = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id','25')->limit(4)->get();

        $tab3 = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id','28')->limit(4)->get();

        $tab4 = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id','18')->limit(4)->get();
        
        $meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | Skincare, Makeup & Fragrance";

    	return view('pages.home')->with('category',$category_name)->with('brand',$brand_name)->with('product',$all_product)->with('tab1', $tab1)->with('tab2', $tab2)->with('tab3', $tab3)->with('tab4', $tab4)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title)->with('all_slide', $all_slide); 
    }

    public function seaarch(Request $request){
    	$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
        $keywords = $request->keywords_submit;
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        $tab1 = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id','19')->limit(4)->get();

        $tab2 = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id','25')->limit(4)->get();

        $tab3 = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id','28')->limit(4)->get();

        $tab4 = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id','18')->limit(4)->get();

        $meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | Rsuilt for ".$keywords;

    	return view('pages.product.search')->with('category',$category_name)->with('brand',$brand_name)->with('search_product',$search_product)->with('tab1', $tab1)->with('tab2', $tab2)->with('tab3', $tab3)->with('tab4', $tab4)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title)->with('keywords', $keywords);
    }

    public function contact_un(Request $request){
        $category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();

        $meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | Contact Us";

        return view('pages.other-page.contact-us')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }

    public function contact_us(Request $request, $ct_id){
        $category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();

        $meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | Contact Us";

        $customer = DB::table('tbl_customer')->where('customer_id',$ct_id)->get();

        return view('pages.other-page.contact-us2')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title)->with('customer', $customer);
    }

    public function about_us(Request $request){
        $category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
        $staffs = DB::table('tbl_admins')->get();

        $meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | About Us ";

        return view('pages.other-page.about-us')->with('category',$category_name)->with('brand',$brand_name)->with('staff',$staffs)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }

    public function send_mess(Request $request){
        $data = array();
    	$data['messenger_name'] = $request->name;
    	$data['messenger_email'] = $request->email;
    	$data['messenger_decs'] = $request->type;
    	$data['messenger_content'] = $request->messenger;

    	DB::table('tbl_messenger')->insert($data);
    	Session::put('message','Send your message usefull');
    	return Redirect::to('homepage');
    }
    
}