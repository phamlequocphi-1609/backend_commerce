<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\MemberRequest;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image;
class MemberController extends Controller
{
    //
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


 /**
     * Show login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin(){
        return view('frontend.member.login');
    }
     /**
     * Do login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'success'=>'success',
                'token'=> $token,
                'Auth'=>$user
            ], $this->successStatus);
        }else{
            return response()->json([
                'response'=>'error',
                'errors' => ['errors' => 'invalid email or password'],
            ], $this->successStatus);
        }
    }

     /**
     * Logout
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    
     public function logout(){
        Auth::logout();
        return redirect('/');
     }
  
    /**
     * Do login
     *
     * @param $attempt
     * @param $remember
     * @return bool
     */
    protected function doLogin($attempt, $remember){
        if(Auth::attempt($attempt, $remember)){   
            return true;
        }else{
            return false;
        }
    }
    public function register(MemberRequest $request){
        $data = $request->all();
        $file = $request->file('avatar');
        
        if ($file) {
            $name = time() . '.' . $file->getClientOriginalExtension();
            $data['avatar'] = $name;
        }
        $data['password'] = bcrypt($data['password']);
        if ($getUser = User::create($data)) {
            if ($file) {
                $path = public_path('upload/member/' . $data['avatar']);
                Image::make($file->getRealPath())->save($path);
            }
            return response()->json([
                'message' => 'success',
                'data' => $getUser,
            ], JsonResponse::HTTP_OK);
        } else {
            return response()->json(['errors' => 'error server'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update(UpdateProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();

        $getEmail = User::where('email', $data['email'])
            ->where('id', '<>', $id)
            ->first();

        if ($getEmail) {
            return response()->json([
                'errors' => ['errors' => 'Email đã tồn tại'],
                'email' => $getEmail->email
            ], JsonResponse::HTTP_OK);
        }
        $file = $request->file('avatar');
        if ($file) {
            $name = time() . '.' . $file->getClientOriginalExtension();
            $data['avatar'] = $name;
            Image::make($file->getRealPath())->save(public_path('upload/user/') . $data['avatar']);
        } else {
            $data['avatar'] = $user->avatar;
        }
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {   
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'response' => 'success',
                'token' => $token,
                'Auth' => $data
            ], $this->successStatus);
        } else {
            return response()->json([
                'errors' => 'Lỗi cập nhật',
            ], $this->successStatus);
        }
    }

}