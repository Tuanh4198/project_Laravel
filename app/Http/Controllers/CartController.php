<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Cart;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request){
		$productid = $request->productid_hidden;
		$quantity = $request->qty;
		$product_info = DB::table('tbl_product')->where('product_id',$productid)->first();
		$quantity_product = DB::table('tbl_product')->select('product_qty')->where('product_id',$productid)->get();
		foreach($quantity_product as $pro){
			$qty =  $pro->product_qty;
		}

		if($qty < 0){
			Session::put('quantity_product',$quantity_product);
			Session::put('quantity',$quantity);
			Session::put('message','This product is currently not available!');
			return Redirect::to('/our-stock');
		}
		elseif($qty < $quantity){
			Session::put('quantity_product',$quantity_product);
			Session::put('quantity',$quantity);
			Session::put('message','The quantity of product in stock is not enough, Sorry for the inconvenience!');
			return Redirect::to('/our-stock');
		}
		else {
			$data['id'] = $product_info->product_id;
			$data['qty'] = $quantity;
			$data['name'] = $product_info->product_name;
			$data['price'] = $product_info->product_price;
			$data['options']['image'] = $product_info->product_image;
			$data['weight'] = $product_info->product_price;
			Cart::add($data);
			Session::put('quantity_product',$quantity_product);
			Session::put('quantity',$quantity);
			return Redirect::to('/show-cart');
		}
	}

	public function qty_cart(Request $request){
    	$quantity = $request->quantity;
    	$rowid = $request->rowId_cart;
    	$productid = $request->rowId_product;
		$quantity_product = DB::table('tbl_product')->select('product_qty')->where('product_id',$productid)->get();
		foreach($quantity_product as $pro){
			$qty =  $pro->product_qty;
		}
    	if($qty < $quantity){
			Session::put('quantity_product',$quantity_product);
			Session::put('quantity',$quantity);
			Session::put('message','The quantity of product in stock is not enough, Sorry for the inconvenience!');
			return Redirect::to('/our-stock');
		}
		elseif($qty < 0){
			Session::put('quantity_product',$quantity_product);
			Session::put('quantity',$quantity);
			Session::put('message','This product is currently not available!');
			return Redirect::to('/our-stock');
		}else{
			Cart::update($rowid,$quantity);
    		return Redirect::to('/show-cart');
		}
    }

	public function our_stock(Request $request){
		$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
		$brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | Product our stock";
		return view('pages.other-page.our_stock')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
	}

    public function show_cart(Request $request){
    	$category_name = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','desc')->get();
		$brand_name = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_name','desc')->get();
		$meta_desc = "Shiseido offers the highest quality products in brightening and anti-aging skincare, makeup and fragrance with 145 years of technology. Free samples everyday, every order. Shiseido";
        $meta_keywords = "Shiseido";
        $url_canonical = $request->url();
        $meta_title = "SHISEIDO | My cart";
    	return view('pages.cart.show_cart')->with('category',$category_name)->with('brand',$brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical)->with('meta_title', $meta_title);
    }

    public function delete_cart($rowId){
    	Cart::update($rowId, 0);
    	return Redirect::to('/show-cart');
    }
}