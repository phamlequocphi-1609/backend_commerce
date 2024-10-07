<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogRateRequest;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Requests\Api\RateBlogRequest;
use App\Models\Api\BlogRate;
use App\Models\frontend\member\blog;
use App\Models\frontend\member\comment;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $successStatus = 200;
    public function list(){
       $getBlog = blog::with('comment')->paginate(config('admin.paginate'));
       
       return response()->json([
        'blog'=> $getBlog
       ]);
    }
    public function show(string $id){
        $getBlogDetail = blog::with(['comment' => function($q) {
            $q->orderBy('id', 'desc');
        }])->find($id);

        return response()->json([
            'status' => 200,
            'data' => $getBlogDetail
        ]);
    }
    public function paginationBlogDetail(string $id){
        $blogId = blog::find($id);
        $blogNext = blog::where('id', '>', $blogId->id)->min('id');
        $blogPrevious = blog::where('id', '<', $blogId->id)->max('id');
        if($blogId){
            return response()->json([
                'status'=>200,
                'data'=> $blogId,
                'previous'=> $blogPrevious,
                'next'=> $blogNext
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'error'=> 'error',
            ]);
        }
    }
    public function getrate($id){
        $getRate = BlogRate::all()->where('id_blog', $id)->toArray();
        return response()->json([     
            'response' => 'success',
            'data' => $getRate
        ],$this->successStatus);
    }
    public function comment(CommentRequest $request, $id){
        $data = $request->all();
        if($id){
            $getListComment = comment::create($data);
            if($getListComment){
                return response()->json([
                    'status'=>200,
                    'data'=>$getListComment
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'error'=> 'error'
                ]);
            }
        }else{
            return response()->json([
                'status'=>200,
                'error'=>'id not found',
            ]);
        }
    }
    // public function postRate(Request $request ){
    //     $rule = [
    //         'id_blog'=>'required',
    //         'id_user'=>'required',
    //         'rate'=>'required',
    //     ];
    //     $validator = Validator::make($request->all(), $rule);
        
    //     if($validator->fails()){
    //         return response()->json([
    //             'message'=>'Validation Failed',
    //             'status' => 422,
    //             'error'=>$validator->errors()
    //         ]);
    //     }
    //     $rate = BlogRate::create($request->all());
    //     return response()->json([
    //         'message'=>'Success',
    //         'status'=>200,
    //         'rateBlog'=> $rate
    //     ]);
    //     // $input = $request->all();
    //     // if(!empty($input['id_user'])){
    //     //     if(rate::create($input)){
    //     //         return response()->json([
    //     //             'status'=>200,
    //     //             'message'=>'Bạn đã đánh giá thành công',
    //     //         ]);
    //     //     }else{
    //     //         return response()->json([
    //     //             'status'=> 200,
    //     //             'message'=> 'Lỗi server, bạn đã đánh giá thất bại'
    //     //         ]);
    //     //     }
    //     // }
    // }
    public function rateBlog(RateBlogRequest $request){
        $data = $request->all();
        if(!empty($data['id_user'])){
            if(BlogRate::create($data)){
                return response()->json([
                    'status'=>200,
                    'message'=>'Bạn đã đánh giá thành công',
                ]);
            }else{
                return response()->json([
                    'status'=>200,
                    'message'=>'Lỗi server'
                ]);
            }
        }
    }
    public function index()
    {
        //
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}