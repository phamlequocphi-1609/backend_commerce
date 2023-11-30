<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use Exception;
use Faker\Extension\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
       public function check(){
        $user = Auth::user();
        return view('frontend.checkOut.checkout', compact('user'));
    }
    public function information(){
        $user = Auth::user();
        if(session()->has('cart')){
            $carts = session()->get('cart');
            $data = [
                'subject'=>'User and product information',
                'body'=> [
                    'username'=>$user->name,
                    'email'=>$user->email,
                    'phone'=>$user->phone,
                    'address'=>$user->address,
                    'product' => $carts,
                ],
            ];
        
            try{
                Mail::to('phamlequocphi16092001@gmail.com')->send(new MailNotify($data));
                return response()->json(['Great check your mail box']);
                
            }catch(Extension $th){
                return response()->json(['sorry']);
            }
        }
    }
  
    
}
