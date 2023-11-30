<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\frontend\product\product;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use Symfony\Component\Console\Input\Input;

class CartMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
//     session()->has('cart): kiểm tra session có khôh
// session()->get('cart'): lấy session ra
// session()->push('cart', $array) : đưa mảng vào so sánh
// session()->put('cart', $getSession) : thay đổi 1 cái trong session
    
    public function cart(){
        return view('frontend.cart.cart');
    }
    public function remove(Request $request){
        if(isset($_POST['deleteId'])){
            $idDelete = $_POST['deleteId'];
            if($request->session()->has('cart')){
                $cart = $request->session()->get('cart');
                if(isset($cart) && is_array($cart)){
                    foreach($cart as $key=> &$value){
                        if($value['id'] == $idDelete){
                            unset($cart[$key]);
                        }
                    }
                }
                $request->session()->put('cart', $cart);
            }
        }else{
            echo "Không có dữ liệu từ ajax";
        }
    }
    public function increase(Request $request){
        if(isset($_POST['idProduct']) && isset($_POST['qtyNew'])){
            $getId = $_POST['idProduct'];
            $qtyNew = $_POST['qtyNew'];
            if($request->session()->has('cart')){
                $getCart = $request->session()->get('cart');
                foreach($getCart as &$value){
                    if($value['id'] == $getId){
                        $value['qty'] = $qtyNew;
                    }
                }
                $request->session()->put('cart', $getCart);
                echo "Update thành công";
            }
        }else{
            echo "Không có dữ liệu từ ajax";
        }
    }
    public function reduce(Request $request){
        if(isset($_POST['idProduct']) && isset($_POST['qtyNew'])){
            $getId = $_POST['idProduct'];
            $qtyUpdate = $_POST['qtyNew'];
            if($request->session()->has('cart')){
                $getCart = $request->session()->get('cart');
                foreach($getCart as &$value){
                    if($getId == $value['id']){
                        $value['qty'] = $qtyUpdate;
                    }
                }
                $request->session()->put('cart', $getCart);
                echo "Update thành công";
            }
        }else{
            echo "Không có dữ liệu từ ajax";
        }
    }
}
