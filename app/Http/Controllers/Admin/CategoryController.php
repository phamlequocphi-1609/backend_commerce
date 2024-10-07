<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\category\CategoryRequest;
use App\Models\admin\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = category::all();
        return view('admin.category.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getData()
    {
        return view('admin.category.add');
    }
    public function create(CategoryRequest $request)
    {
        $data = $request->all();
        if(category::create($data)){
            return redirect('/category')->with('success', 'Dữ liệu thêm vào giỏ hàng thành công');
        }else{
            return redirect()->back()->withErrors('Dữ liệu thêm thất bại');
        }
    }
    public function delete(string $id){
        $categoryId = category::find($id);
        $categoryId->delete();
        return redirect()->back()->with('success', 'Dữ liệu đã xoá thành công');
    }
}