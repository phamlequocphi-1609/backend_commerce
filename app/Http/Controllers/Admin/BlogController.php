<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\blog;
use App\Http\Requests\admin\blog\BlogRequest;
class BlogController extends Controller
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
        $data = blog::all();
        return view('admin.blog.list', compact('data'));
    }

    public function getdata(){
        return view('admin.blog.add');
    }
    public function create(BlogRequest $request)
    {
        $data = $request->all();
        $file = $request->image;
        if(!empty($file)){
            $data['image'] = $file->getClientOriginalName();
            $file->move(public_path('upload/blog'), $data['image']);
        }
        if(blog::create($data)){
            return redirect('/blog/list')->with('success', 'Dữ liệu được thêm thành công');
        }else{
            return redirect()->back()->withErrors('Dữ liệu thêm thất bại');
        }
    }
    public function delete(string $id){
        $blogId = blog::find($id);
        $blogId->delete();
        return redirect()->back()->with('success', 'Dữ liệu đã xoá thành công');
    }
    public function edit(string $id){
        $blogEdit = blog::find($id);
        return view('admin.blog.edit', compact('blogEdit'));
    }
    public function update(BlogRequest $request, string $id)
    {
        $blog = blog::find($id);
        $data = $request->all();
        $file = $request->image;
        if(!empty($file)){
            $data['image'] = $file->getClientOriginalName();
            $file->move(public_path('upload/blog'), $data['image']);
        }
        if($blog->update($data)){
            return redirect()->back()->with('success', 'Dữ liệu cập nhật thành công');
        }else{
            return redirect()->back()->withErrors('Dữ liệu cập nhật thất bại');
        }

    }
}