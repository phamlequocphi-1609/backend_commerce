<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\frontend\member\blog;
use App\Models\frontend\member\comment;
use App\Models\frontend\member\rate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BlogMemberController extends Controller
{
    public function index()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function bloglist(){
        $blogPaginate = blog::paginate(3);
        return view('frontend.blog.blog', compact('blogPaginate'));
    }
    public function blogdetail(string $id){
        $blogId = blog::find($id);
        $blogNext = blog::where('id', '>', $blogId->id)->min('id');
        $blogPrevious = blog::where('id', '<', $blogId->id)->max('id');
        // $comment = comment::all()->where('id_blog', '=', $id);
        $comment = blog::with(['comment' => function($q) {
            $q->orderBy('id', 'asc');
        }])->find($id)->toArray();
        $rate = rate::all()->where('id_blog', '=', $id)->pluck('rate')->toArray();
        $total = 0;
        $rateAvg = 0;
        foreach($rate as $value){
            $total += $value;
        }
        if(count($rate) > 0){
            $rateAvg = $total/count($rate);
        }
        return view('frontend.blog.blog-detail', compact('blogId','blogNext', 'blogPrevious', 'comment', 'rateAvg'));
    }
    public function blogcomment(Request $request, string $id)
    {
        $userId = Auth::user();
        $data = [
            'comment'=> $request->comment,
            'id_blog'=> $id,
            'id_user' => $userId['id'],
            'name_user'=>$userId['name'],
            'avatar_user'=>$userId['avatar'],
            'level'=> $request->level ? $request->level : 0,
        ];
        if(comment::create($data)){
            return redirect()->back()->with('success', 'Dữ liệu bình luận thành công');
        }else{
            return redirect()->back()->withErrors('Thất bại');
        }
    }
    public function rate(){
        $idblog = $_POST['idBlog'];
        $rate = $_POST['rate'];
        $userId = Auth::user();
        $data = [
            'id_user' => $userId['id'],
            'id_blog' => $idblog,
            'rate' => $rate,
        ];
        if(rate::create($data)){
            return redirect()->back()->with('success', 'Dữ liệu đánh giá thành công');
        }else{
            return redirect()->back()->withErrors('Thất bại');
        }
    }
    
}
