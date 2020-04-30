<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Cart;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout(Request $request){
    	$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
		$brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | Login";
    	return view('pages.login-checkout.login')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }

    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }
    
    public function checkout(Request $request, $ct_id){
    	$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
		$brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
		$customer = DB::table('tbl_customer')->where('customer_id',$ct_id)->get();
		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | Checkout";
    	return view('pages.login-checkout.checkout')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title)->with('customer', $customer);
    }

    public function add_customer(Request $request){
        $data = array();
    	$data['customer_name'] = $request->c_name;
    	$data['customer_pass'] = md5($request->c_pass);
    	$data['customer_phone'] = $request->c_phone;
		$data['customer_email'] = $request->c_email;
		$data['customer_address'] = $request->c_address;
		
    	$customer_id =  DB::table('tbl_customer')->insertGetId($data);
    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->c_name);
 
    	return Redirect::to('/show-cart');
    }

    public function save_checkout(Request $request){
        $data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_address'] = $request->shipping_address;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_note'] = $request->shipping_note;

    	$shipping_id =  DB::table('tbl_shipping')->insertGetId($data);
    	Session::put('shipping_id',$shipping_id);
 
    	return Redirect::to('/payment');
    }
    
    public function payment(Request $request){
    	$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
		$brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | Payment method";
    	return view('pages.cart.payment')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }

    public function login_customer(Request $request){
    	$email = $request->email_ac;
    	$password = md5($request->password_ac);
    	$result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_pass',$password)->first();

    	if($result){
    		Session::put('customer_id',$result->customer_id);
    		Session::put('customer_name',$result->customer_name);
    		return Redirect::to('/homepage');
    	}else{
    		return Redirect::to('/login-checkout');
    	}
    }
    
    public function order_place(Request $request){
		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
		$url_canonical = $request->url();
        $meta_title = "SHISEIDO | Order place";

		$patment_data = array();
		$patment_data['payment_method'] = $request->payment_option;
		$discount = $request->discount;
		$code = $request->coupon_code;
		$patment_data['payment_status'] = 'Pending';

		if($patment_data['payment_method'] != ''){
			$payment_id = DB::table('tbl_payment')->insertGetId($patment_data);
			$order_data = array();
			// $update_qty_data = array();
			$order_data['customer_id'] = Session::get('customer_id');
			$order_data['shipping_id'] = Session::get('shipping_id');
			$order_data['payment_id'] = $payment_id;
			$order_data['order_total'] = (Cart::total()-$discount);
			$order_data['order_status'] = 'Pending';
			$order_id = DB::table('tbl_order')->insertGetId($order_data);
			$content = Cart::content();
			foreach ($content as $value) {
				$order_detail_data = array();
				$order_d['order_id'] = $order_id;
				$order_d['product_id'] = $value->id;
				$order_d['product_name'] = $value->name;
				$order_d['product_price'] = $value->price;
				$order_d['product_sale_qty'] = $value->qty;
				DB::table('tbl_order_detail')->insert($order_d);
				DB::table('tbl_product')->where('product_id',$value->id)->decrement('product_qty', $value->qty);
			}
			Session::forget('coupon');
			DB::table('tbl_coupon')->where('coupon_code',$code)->decrement('coupon_qty', 1);
			if($patment_data['payment_method'] == 'ATM'){
				echo 'ATM';
			}elseif($patment_data['payment_method'] == 'money'){
				Cart::destroy();
				$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
				$brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
				return view('pages.login-checkout.handcash')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
			}elseif($patment_data['payment_method'] == 'credit'){
				echo 'Credit';
			}
		}else{
			Session::put('message','Choose your payment method!');
			return Redirect::to('/payment');
		}
    }

    public function authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send(); 
        }
    }

    public function manage_order(Request $request){
        $this->authlogin();
        $list_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
		->orderby('tbl_order.order_id','desc')->paginate(10);
		
		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | Manager order";

        $manage_order = view('admin.manage_order')->with('list_order',$list_order);
        return view('admin_layout')->with('admin.manage_order',$manage_order)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }

    public function view_order(Request $request, $order_id){
        $this->authlogin();

        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_detail.*')
        ->where('tbl_order.order_id',$order_id)
        ->orderby('tbl_order.order_id','desc')->get();
        $customer_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_detail.*')
        ->where('tbl_order.order_id',$order_id)
        ->orderby('tbl_order.order_id','desc')->first();
		$manage_order_byid = view('admin.view_order')->with('order_by_id',$order_by_id)->with('customer_by_id',$customer_by_id);
		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
		$meta_title = "SHISEIDO | View order";
        return view('admin_layout')->with('admin.view_order',$manage_order_byid)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
	}
	
	public function customer_infor(Request $request, $ct_id){
		$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
		$customer = DB::table('tbl_customer')->where('customer_id',$ct_id)->get();
		$order = DB::table('tbl_order')->where('customer_id',$ct_id)->get();

		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
		$meta_title = "SHISEIDO | Customer information";
		
    	return view('pages.login-checkout.customer-infor')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title)->with('customer', $customer)->with('order', $order);
	}

	public function new_customer(Request $request){
		$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
		$brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
		
		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
		$meta_title = "SHISEIDO | Create new account";
		
    	return view('pages.login-checkout.newacc')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
	}
	
	public function ship_order(Request $request, $or_id){
    	DB::table('tbl_order')->where('order_id',$or_id)->update(['order_status'=>'Finish']);
    	Session::put('message','Shipping successfull');
    	return Redirect::to('manage-order');
	}
}
