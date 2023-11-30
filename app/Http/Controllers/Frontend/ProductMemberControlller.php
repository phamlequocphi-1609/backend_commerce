<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\product\ProductRequest;
use App\Http\Requests\frontend\product\UpdateProductRequest;
use App\Models\frontend\brand\brand;
use App\Models\frontend\category\category;
use App\Models\frontend\product\product;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Intervention\Image\Facades\Image;
use Intervention\Image\Facades\Image;
class ProductMemberControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
        $idUser = $user['id'];
        $getProducts = product::all()->where('id_user', '=', $idUser)->toArray();
        return view('frontend.product.list', compact('getProducts'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function getdata()
    {
        $category = category::all();
        $brand = brand::all();
        return view('frontend.product.add', compact('category', 'brand'));
    }
    public function create(ProductRequest $request)
    {
        $userId = Auth::user();
        $images = [];
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $img = $image->getClientOriginalName();
                $img_85 = "85".$image->getClientOriginalName();
                $img_329 = "329".$image->getClientOriginalName();

                $path = public_path('upload/product/'.$img);
                $path_85 = public_path('upload/product/'.$img_85);
                $path_329 = public_path('upload/product/'.$img_329);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(85,84)->save($path_85);
                Image::make($image->getRealPath())->resize(329,380)->save($path_329);
            
                $images[] = $img;
            }
        }
        $product = new product();
        $product->id_user = $userId['id'];
        $product->name = $request->name;
        $product->price = $request->price;
        $product->id_category = $request->id_category;
        $product->id_brand = $request->id_brand;
        $product->status = $request->status == 1 ? 1 : 0;
        $product->sale = $request->sale;
        $product->company = $request->company;
        $product->detail = $request->detail;
        $product->image = json_encode($images);
        $product->save();
        return redirect('/member/account/my-product')->with('success', 'Your product has been successfully');
    }

    public function getEdit(string $id){
        $productEdit = product::find($id);
        $category = category::all();
        $brand = brand::all();
        return view('frontend.product.edit', compact('productEdit', 'category', 'brand'));
    }

    public function update(UpdateProductRequest $request, string $id){
        $product = product::find($id);

        $imgProduct = json_decode($product->image, true);
        if($request->has('delete_img')){
            $imgCheckbox = $request->delete_img;
            foreach($imgCheckbox as $imgDelete){
                if(in_array($imgDelete, $imgProduct)){
                    $key = array_search($imgDelete, $imgProduct);
                    unset($imgProduct[$key]);
                }
            }
        }
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $img = $image->getClientOriginalName();
                $img_85 = '85'.$image->getClientOriginalName();
                $img_329 = '329'.$image->getClientOriginalName();

                $path = public_path('upload/product/'.$img);
                $path_85 = public_path('upload/product/'.$img_85);
                $path_329 = public_path('upload/product/'.$img_329);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(85,84)->save($path_85);
                Image::make($image->getRealPath())->resize(329, 380)->save($path_329);

                $imgProduct[] = $img;
            }
        }
        $imgProduct = array_values($imgProduct);

        if(count($imgProduct) > 3){
            return redirect()->back()->withErrors('Tổng số hình update phải <= 3');
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->id_category = $request->id_category;
        $product->id_brand = $request->id_brand;
        $product->status = $request->status == 1 ? 1 : 0;
        $product->sale = $request->sale;
        $product->company = $request->company;
        $product->detail = $request->detail;
        $product->image = json_encode($imgProduct);
        $product->update();
        return back()->with('success', 'Your product has been successfully');
    }
    public function delete(string $id){
        $productRemove = product::find($id);
        $productRemove->delete();
        return redirect()->back()->with('success', 'Sản phẩm xoá thành công');
    }
    public function detail(string $id){
        $productDetail = product::find($id)->toArray();
        $brand = brand::all()->toArray();
        $product = product::take(6)->orderBy('created_at', 'desc')->get()->toArray();
        return view('frontend.product.detail', compact('productDetail', 'brand', 'product'));
    }
    public function search(Request $request)
    {
        $searchProduct = $request->search;
        $product = product::where('name', 'like', '%'. $searchProduct .'%')->get();    
        return view('frontend.product.search', compact('product')); 
    }
    public function searchAdvanced(Request $request){
        $category = category::all();
        $brand = brand::all();
        $product = product::query();
        if(!empty($request->name)){
            $product->where('name', 'like', '%' . $request->name . '%');
        }
        if(!empty($request->price)){
            $prices = $request->price;
            $price = explode('-', $prices);
            $product->whereBetween('price', $price);
        }
        if(!empty($request->id_category))
        {
            $product->where('id_category', '=', $request->id_category);
        }
        if(!empty($request->id_brand)){
            $product->where('id_brand', '=', $request->id_brand);
        }
        if(!empty($request->status)){
            $product->where('status', '=', $request->status);
        }
        $product = $product->get();
        return view('frontend.product.searchAdvanced', compact('category', 'brand', 'product'));
    }
    public function priceSelect(Request $request){
        $getPrice = $_POST['priceSelected'];
        $price = explode(':', $getPrice);
        $productPrice = product::whereBetween('price', $price)->get()->toArray();
        return response()->json([
            'products' => $productPrice,
        ]);
    }
    
}
