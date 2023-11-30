<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\country;
use App\Http\Requests\admin\country\CountryRequest;


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = country::all();
        return view('admin.country.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getdata(){
        return view('admin.country.add');
    }
    public function create(CountryRequest $request)
    {
        $data = $request->all();
        if(country::create($data)){
            return redirect('/country/list')->with('success', 'Dữ liệu được thêm thành công');
        }else{
            return redirect()->back()->withErrors('Dữ liệu thêm bị lỗi');
        }
    }
    public function delete(string $id){
        $countryId = country::find($id);
        $countryId->delete();
        return redirect()->back()->with('success', 'Quốc gia đã được xoá thành công');
    }
}
