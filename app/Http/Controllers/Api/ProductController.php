<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductAddRequest;
use App\Http\Requests\Api\ProductEditRequest;
use App\Models\Api\Brand;
use App\Models\Api\Category;
use App\Models\Api\Country;
use App\Models\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $successStatus = 200;

    public function index()
    {
        //
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function productHome(){
        $getProductHome = Product::orderBy('id')->limit(6)->get()->toArray();
        return response()->json([
            'response'=>'success',
            'data'=>$getProductHome
        ], $this->successStatus);
    }
    public function productList(){
        $getProductAll = Product::all()->toArray();
        return response()->json([
            'response'=>'success',
            'data'=>$getProductAll,
        ], $this->successStatus);
    }
    public function listCategoryBrand(){
        $category = Category::all()->toArray();
        $brand = Brand::all()->toArray();
        return response()->json([
            'response'=>'success',
            'category'=>$category,
            'brand'=>$brand,
        ], $this->successStatus);
    }
    public function productDetail(string $id){
        $productDetail = Product::find($id)->toArray();
        return response()->json([
            'response'=>'success',
            'data'=>$productDetail,
        ], $this->successStatus);

    }
    public function productCart(Request $request){
        $data = $request->json()->all();
        $getProduct = [];
        foreach($data as $key => $value){
            $get = Product::findOrFail($key)->toArray();
            $get['qty'] = $value;
            $getProduct[] = $get;
        }
        return response()->json([
            'response' => 'success',
            'data'=>$getProduct
        ], $this->successStatus);
    }
    public function myproduct(){
        $getProduct = Product::all()->where('id_user', Auth::user()->id)->toArray();
        return response()->json([
            'response'=>'success',
            'data'=>$getProduct,
        ]);
    }
    public function productWishlist(){
        $getAllProduct = Product::all()->toArray();
        return response()->json([
            'response'=>'success',
            'data'=>$getAllProduct
        ], $this->successStatus);
    }
    public function show($id){
        $data = Product::findOrFail($id);
        $data['image'] = json_decode($data['image']);
        return response()->json([
            'response'=>'success',
            'data'=>$data
        ], $this->successStatus);
    }

    public function store(ProductAddRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('file')){
            $imageUpload = $this->uploadImageToDirectory($request->file('file'));
            $data['image'] = json_encode($imageUpload);
        }
        $data['id_category'] = $data['category'];
        $data['id_brand'] = $data['brand'];
        $data['id_user'] = Auth::user()->id;
        if($product = Product::create($data)){
            return response()->json([
                'response'=>'success',
                'data'=>$product,
            ], $this->successStatus);
        }
    }   
    public function uploadImageToDirectory($arrImage)
    {
        $ImageUpload = [];
        foreach($arrImage as $image){
            $nameImg = strtotime(date('Y-m-d H:i:s')).'_'.$image->getClientOriginalName();
            if (!file_exists('upload/product/'.Auth::user()->id)) {
                mkdir('upload/product/'.Auth::user()->id);
            }
            $path = public_path('upload/product/'.Auth::user()->id.'/'. $nameImg);
            $pathSmall = public_path('upload/product/'.Auth::user()->id.'/small_'.$nameImg);
            $pathLarger = public_path('upload/product/'.Auth::user()->id.'/larger_'.$nameImg);

            Image::make($image->getRealPath())->save($path);
            Image::make($image->getRealPath())->resize(84, 84)->save($pathSmall);
            Image::make($image->getRealPath())->resize(330, 380)->save($pathLarger);

            $ImageUpload[] = $nameImg;
        }
        return $ImageUpload;
    }
    public function deleteProduct($id){
        $getProduct = Product::find($id)->toArray();
        $arrImage = json_decode($getProduct['image'], true);

        if(Product::find($id)->delete()){
            foreach($arrImage as $value){
                if(file_exists('upload/product/' .Auth::user()->id.'/'.$value)){
                    unlink('upload/product/'.Auth::user()->id.'/'.$value);
                    unlink('upload/product/'.Auth::user()->id.'/small_'.$value);
                    unlink('upload/product/'.Auth::user()->id.'/larger_'.$value);
                }
            }

            $getAllProductUser = Product::all()->where('id_user', Auth::user()->id)->toArray();
            return response()->json([
                'response'=>'success',
                'data'=>$getAllProductUser
            ], $this->successStatus);
        }
    }
    public function update(ProductEditRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->all();
        $imageProduct = json_decode($product['image'], true);
        if(!empty($data['avatarCheckBox'])) {
            foreach($imageProduct as $key => $value) {
                if (in_array($value, $data['avatarCheckBox'])) {
                    if (file_exists('upload/product/'.Auth::user()->id.'/'.$value)) {

                        unlink('upload/product/'.Auth::user()->id.'/'.$value);
                        unlink('upload/product/'.Auth::user()->id.'/small_'.$value);
                        unlink('upload/product/'.Auth::user()->id.'/larger_'.$value);
                    }

                    unset($imageProduct[$key]);
                }
            } 
            $imageProduct = array_values($imageProduct);
        }
        $imageMerge = !empty($imageProduct) ? $imageProduct : '';
       
        
        if($request->hasfile('file')){
            $imageUpload = $this->uploadImageToDirectory($request->file('file'));  
            $imageMerge = array_merge($imageUpload, $imageProduct);
        } 
        if(count($imageMerge) > 5) {
            return response()->json([
                'message' => 'avatar only upload maximun 5 file',
            ], $this->successStatus);
        }    
        $data = $request->all();
        $data['image'] = json_encode($imageMerge);
        $data['id_category'] = $data['category'];
        $data['id_brand'] = $data['brand'];
        $data['id_user'] = Auth::User()->id;
        if ($product->update($data)) {
            if($request->hasfile('file')){
                $imageUpload = $this->uploadImageToDirectory($request->file('file'));  
            }
            return response()->json([
                'response' => 'success',
                'data' => $product
            ], $this->successStatus);
        }
    }
    public function searchAdvanced(Request $request){
        $product = Product::with('Brand', 'Category');
        if(!empty($request->name)){
            $product->where('name', 'like', '%'.$request->name.'%');
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
        return response()->json([
            'response'=>'success',
            'data'=> $product
        ], $this->successStatus);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
