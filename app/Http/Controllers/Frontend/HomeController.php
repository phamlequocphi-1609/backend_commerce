<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\frontend\brand\brand;
use App\Models\frontend\category\category;
use App\Models\frontend\product\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
    public function index()
    {
        $product = product::take(6)->orderBy('created_at', 'desc')->get()->toArray();
        $productAll = product::all();
        $brand = brand::all();
        $category = category::all()->toArray();
        return view('frontend.home', compact('product', 'brand', 'category', 'productAll'));
    }

    public function addCart(Request $request)
    {
        if(isset($_POST['idProduct'])){
          $idProduct = $_POST['idProduct'];
          $productData = product::find($idProduct);
          if($productData){
            $array = array(
                'img'=>$productData['image'],
                'name'=>$productData['name'],
                'price'=>$productData['price'],
                'id'=>$productData['id'],
                'qty'=> 1,
            );
            $checkProduct = false;
            if($request->session()->has('cart')){
                $getCart = $request->session()->get('cart');
                foreach($getCart as $key=>$value){
                    if($value['id'] == $array['id']){
                        $getCart[$key]['qty'] += 1;
                        $checkProduct = true;
                    }
                }
                $request->session()->put('cart', $getCart);
            }
            if($checkProduct == false){
                $cart = $request->session()->get('cart', function(){
                    return [];
                });
                $cart[] = $array;
                $request->session()->put('cart', $cart);
            }
            echo 'Dữ liệu thêm vào session thành công';
          }
        }else{
            echo 'Dữ liệu thêm vào session thất bại';
        }
    }

    
}
