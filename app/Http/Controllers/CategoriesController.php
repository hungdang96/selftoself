<?php

namespace App\Http\Controllers;

use App\CategoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    //Categories List
    public function categories_list(Request $request){
        $type_id = $request->type_id;
        $data = CategoriesModel::select('id','category_name','category_parent')
                ->whereRaw('id <> 0')
                ->where('type_id', $type_id)
                ->get();
        return ['status' => true, 'data' => $data];
    }

    //Category create
    public function category_create(Request $request){
        $validator = Validator::make($request->all(),[
            'category_name' => 'required | unique:categories',
            'type_id' => 'required'
        ],[
            'category_name.required' => 'Tên danh mục không được để trống!',
            'category_name.unique' => 'Tên danh mục đã tồn tại!',
            'type_id.required' => 'Chưa chọn loại danh mục!'
        ]);
        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->all()];
        }
        $category_name = $request->category_name;
        $category_parent = $request->category_parent;
        $type_id = $request->type_id;

        CategoriesModel::create([
            'category_name' => $category_name,
            'category_parent' => $category_parent,
            'type_id' => $type_id
        ]);
        return ['status' => true, 'message' => 'Tạo danh mục thành công!'];
    }

    //Category edit
    public function category_edit($category_id){
        $data = CategoriesModel::find($category_id);
        return view('admin.categories.edit', compact($data));
    }

    //Category update
    public function category_update($category_id, Request $request){
        $validator = Validator::make($request->all(),[
            'category_name' => 'required | unique:categories',
            'type_id' => 'required'
        ],[
            'category_name.required' => 'Tên danh mục không được để trống!',
            'category_name.unique' => 'Tên danh mục đã tồn tại!',
            'type_id.required' => 'Chưa chọn loại danh mục!'
        ]);
        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->all()];
        }
        $category_name = $request->category_name;
        $category_parent = $request->category_parent;
        $type_id = $request->type_id;

        CategoriesModel::where('category_id', $category_id)
            ->update([
                'category_name' => $category_name,
                'category_parent' => $category_parent,
                'type_id' => $type_id
            ]);
        return ['status' => true, 'message' => 'Cập nhật danh mục thành công!'];
    }

    //Category delete
    public function category_delete($category_id){
        $data = CategoriesModel::find($category_id);
        if(isset($data)){
            $data->delete();
            return ['status' => true, 'message' => "Đã xóa danh mục '".$data->category_name."'"];
        }
        else{
            return ['status' => false, 'message' => ['Danh mục không tồn tại!']];
        }
    }
}
