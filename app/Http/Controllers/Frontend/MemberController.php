<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\country;
use App\Models\User;
use App\Http\Requests\frontend\member\RegisRequest;
use App\Http\Requests\frontend\member\LoginRequest;
use App\Http\Requests\frontend\member\UpdateAccountRequest;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getDataRegisterMember(){
        $getCountry = country::all();
        return view('frontend.member.register', compact('getCountry'));
    }
    public function create(RegisRequest $request)
    {
        $data = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
            $file->move(public_path('upload/member'), $data['avatar']);
        }
        $data['level']=0;
        if(User::create($data))
        {
            return redirect()->back()->with('success', 'Dữ liệu member được thêm thành công');
        }else{
            return redirect()->back()->withErrors('Dữ liệu member bị lỗi');
        }
    }

    public function getDataMember(){
        return view('frontend.member.login');
    }
    public function login(LoginRequest $request){
        $login = [
            'email'=>$request->email,
            'password'=>$request->password,
            'level'=> 0
        ];
        $remember = false;
        if($request->remember_me){
            $remember = true;
        }
        if($this->doLogin($login, $remember)){
            return redirect('/index');
        }else{
            return redirect()->back()->withErrors('Email hoặc mật khẩu không chính xác');
        }
    }

    protected function doLogin($attempt, $remember){
        if(Auth::attempt($attempt, $remember)){
            return true;
        }else{
            return false;
        }
    }
    public function logout(){
       Auth::logout();
       return redirect('/member/login');
    }
    public function account(){
        $member = Auth::user();
        $country = country::all();
        return view('frontend.account.account', compact('member', 'country'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function memberUpdate(UpdateAccountRequest $request){
        $memberId = Auth::id();
        $member = User::findOrFail($memberId);
        $memberData = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $memberData['avatar'] = $file->getClientOriginalName();
            $file->move(public_path('upload/member'), $memberData['avatar']);
        }
        if($memberData['password']){
            $memberData['password'] = bcrypt($memberData['password']);
        }else{
            $memberData['password'] = $member->password;
        }
        if($member->update($memberData)){
            return redirect()->back()->with('success', 'Dữ liệu member được cập nhật thành công');
        }else{
            return redirect()->back()->withErrors('Dữ liệu cập nhật thất bại');
        }
    }
   
}
