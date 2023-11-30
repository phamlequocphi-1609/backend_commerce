<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\country;
use App\Models\User;
use App\Http\Requests\admin\user\RegisterRequest;
use App\Http\Requests\admin\user\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
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
    public function index(){

    }
    /**
     * Show the form for creating a new resource.
     */
    public function getData(){
        $countries = country::all();
        return view('admin.user.add', compact('countries'));
    }
    public function create(RegisterRequest $request)
    {
        $data = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
            $file->move(public_path('upload/user'), $data['avatar']);
        }
        if(User::create($data)){
            return redirect()->back()->with('success', 'Dữ liệu user được thêm vào thành công');
        }else{
            return redirect()->back()->withErrors('Dữ liệu thêm bị lỗi');
        }
    }
    public function userProfile()
    {
        $getCountry = country::all();
        $user = Auth::user();
        return view('admin.user.profile', compact('user', 'getCountry'));
    }
    public function updateUser(UpdateProfileRequest $request){
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $data = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        if($data['password']){
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }
        if($user->update($data)){
            if(!empty($file)){
                $file->move(public_path('upload/user'), $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', 'Dữ liệu user được cập nhập thành công');
        }else{
            return redirect()->back()->withErrors('Dữ liệu cập nhập bị lỗi');
        }
    }

}
