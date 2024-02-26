<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class CategoriesController extends Controller
{
    //
    public function __construct(){
        echo 'welcome ff';
    }
    //hien thi  list chuyen muc - get
    public function index(Request $request){
        // $allData = $request->all();
        // dd($allData);
        // $url =$request->fullUrl();
        // echo $url;
        // $ip =$request->ip();
        // echo 'ip la'.$ip;
        // $method =$request->method();
        // echo $method;
        // $id = $request->query('id');
        // dd($id);
        $query = $request->query();
        dd($query);
        return view('clients/categories/list');  
    }
    //Lays ra mot chuyen muc theo id - get
    public function getCategory($id){
        return view('clients/categories/edit');  
    }
    //Cap nhat mot nchuyen muc-post
    public function updateCategory($id){
        return 'submit category:'.$id;
    }
    //show  form them du lieu -GET
    public function addCategory(Request $request){
        // $path = $request->path();
        // echo $path;
        $cateName = $request->old('category');
        echo $cateName;
        return view('clients/categories/add');  
    }
    //them du lieu vao chuyen muc- POst
    public function handleAddCategory(Request $request ){
        // $cateName = $request->query();
        if($request->has('category_name')){
            $cateName = $request->category_name;
            // dd($cateName);
            $request->flash();
            return redirect(route('categories.add'));
        }else{
            return 'kh coa category';
        }
        
        // return redirect(route('categories.add'));
        // return 'submit them category:';
    }
    //xoa du lieu - delete
    public function deleteCategory($id){
        return 'submit xoas category:'.$id;
    }
    public function getFile(){
    return view('clients/categories/file');
    }
    //xu ly lay thong tuin file
    public function handleFile(Request $request){
        if($request->hasFile('photo')){
            if($request->photo->isValid()){
                $file = $request->photo;
                $path = $file->path();
                $ext = $file->extension();
                dd($path);
            }
            // $file = $request->file('photo');
            // dd($file);
        }else{
            return 'vui long chon file';
        }
    }
}