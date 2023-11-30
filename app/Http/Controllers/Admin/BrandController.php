<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\brand\BrandRequest;
use App\Models\admin\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $data = brand::all();
        return view('admin.brand.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getdata()
    {
        return view('admin.brand.add');
    }
    public function create(BrandRequest $request)
    {
        $data = $request->all();
        if(brand::create($data)){
            return redirect('/brand')->with('success', 'Dữ liệu thêm thành công');
        }else{
            return redirect()->back()->withErrors('Dữ liệu thêm thất bại');
        }
    }
    public function delete(string $id){
        $brandId = brand::find($id);
        $brandId->delete();
        return redirect()->back()->with('success', 'Dữ liệu đã xoá thành công');
    }
}
