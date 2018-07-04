<?php

namespace App\Http\Controllers;

use App\PostsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    //Posts list
    public function posts_list(Request $request){
        $where = ['userid','=',Auth::user()->userid];
        if($request->cat_id){
            $where[] = ['categories_id', '=', $request->cat_id];
        }
        $posts_list = PostsModel::where($where)
                ->get();
        return ['status' => true, 'data' => $posts_list];
//        return view('content.posts.postsList', compact($posts_list));
    }

    //Post create
    public function post_create(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required | max: 255',
            'content' => 'required',
            'status' => 'required',
            'categories_id' => 'required'
        ],[
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề quá dài',
            'content.required' => 'Nội dung không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'categories_id.required' => 'Vui lòng chọn danh mục'
        ]);
        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->all()];
        }
        $title = $request->title;
        $post_avatar = $request->post_avatar;
        $content = $request->content_field;
        $userid = Auth::user()->userid;
        $status = $request->status;
        $categories_id = $request->cat_id;

        PostsModel::create([
            'title' => $title,
            'post_avatar' => $post_avatar,
            'content' => $content,
            'userid' => $userid,
            'status' => $status,
            'categories_id' => $categories_id
        ]);

        return ['status' => true, 'message' => 'Tạo bài viết thành công!'];
    }

    //Post edit
    public function post_edit($id){
        $data = PostsModel::find($id);
        return view('content.posts.edit', compact($data));
    }

    //Post update
    public function post_update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required | max: 255',
            'content' => 'required',
            'status' => 'required',
            'categories_id' => 'required'
        ],[
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề quá dài',
            'content.required' => 'Nội dung không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'categories_id.required' => 'Vui lòng chọn danh mục'
        ]);
        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->all()];
        }

        $title = $request->title;
        $post_avatar = $request->post_avatar;
        $content = $request->content_field;
        $status = $request->status;
        $categories_id = $request->cat_id;

        PostsModel::where('id',$id)
            ->update([
                'title' => $title,
                'post_avatar' => $post_avatar,
                'content' => $content,
                'status' => $status,
                'categories_id' => $categories_id
            ]);

        return ['status' => true, 'message' => 'Cập nhật bài viết thành công!'];
    }

    //Post delete
    public function post_delete($id){
        $data = PostsModel::find($id);
        if(isset($data)){
            $data->delete();
            return ['status' => true, 'message' => 'Xóa bài viết thành công!'];
        }
        else{
            return ['status' => false, 'message' => ['Bài viết không tồn tại!']];
        }
    }
}
