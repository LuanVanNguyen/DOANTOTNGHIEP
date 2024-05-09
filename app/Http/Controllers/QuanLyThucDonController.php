<?php

namespace App\Http\Controllers;

use App\Models\thuvienanh;
use Illuminate\Http\Request;
use App\Models\danhmucmon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;
class QuanLyThucDonController extends Controller
{
    public function all()
    {
        if (session('name_admin')) {
            $all=  DB::table('danhmucmon')->get();
            return view('admin.quanlythucdon',compact('all'));
      } else {
          return view('admin_login');
      }
        
    }
    public function add()
    {

      
        return view('admin.Add.themthucdon');
    }
    public function save(Request $request)
    {   
        if($request->tendanhmuc==""||$request->path==""){
            Toastr::error('Vui lòng nhập đầy đủ thông tin', 'Thất bại', ["positionClass" => "toast-top-center toast-margin-top"]);
            return redirect()->back();
        }else{
        // $file = $request->file('path');
        // $filename = time() . '.' . $file->getClientOriginalExtension();
        $data = array();
        $data['tendanhmuc']= $request->tendanhmuc;
        if($request ->hasFile('path')){
            $file = $request -> file('path');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('public/storage/thucdons/',$filename);
            $data['path']= 'public/storage/thucdons/' . $filename;
        }
        // $data['path']= $request->file('path')->storeAs('public/images/', $filename);
        $data['trangthai']= $request->trangthai;
        DB::table('danhmucmon')->insert($data);
        Toastr::success('Thêm danh mục sản phẩm thành công','Thành công');
        // Session::put('message','Thêm danh mục sản phẩm thành công');
    

        return Redirect::to('/quanlythucdon');
    }
    }
    public function edit($id)
    {
        $all=  DB::table('danhmucmon')->where('id',$id)->get();
        return view('admin.Update.suathucdon',compact('all'));

    }
    public function store(Request $request,$id)
    {
        if($request->tendanhmuc==""||$request->path==""){
            Toastr::error('Vui lòng nhập đầy đủ thông tin', 'Thất bại', ["positionClass" => "toast-top-center toast-margin-top"]);
            return redirect()->back();
        }else{
        // $file = $request->file('path');
        // $filename = time() . '.' . $file->getClientOriginalExtension();
        $data = array();
        $data['tendanhmuc']= $request->tendanhmuc;
        // $data['path']= $request->file('path')->storeAs('public/images/', $filename);
        if($request ->hasFile('path')){
            $file = $request -> file('path');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('public/storage/thucdons/',$filename);
            $data['path']= 'public/storage/thucdons/' . $filename;
        }
        $data['trangthai']= $request->trangthai;
        DB::table('danhmucmon')->where('id',$id)->update($data);
        // Session::put('message','Cập nhật danh mục món thành công !');
        Toastr::info('Cập nhật danh mục món thành công !','Thành công');

        return Redirect::to('/quanlythucdon');
    }
    }
    public function del($id)
    {
        DB::table('danhmucmon')->where('id',$id)->delete();
        // Session::put('message','Đã xóa danh mục món thành công !');
    
        Toastr::success('Đã xóa danh mục món thành công !','Thành công');
        return Redirect::to('/quanlythucdon');
    }

    public function unactive($id)
    {
        DB::table('danhmucmon')->where('id',$id)->update(['trangthai'=>1]);
        // Session::put('message','Kích hoạt bán danh mục sản phẩm thành công');
        Toastr::info('Kích hoạt bán danh mục sản phẩm thành công','Thành công');
        return Redirect::to('/quanlythucdon');
    }
    public function active($id)
    {
        DB::table('danhmucmon')->where('id',$id)->update(['trangthai'=>0]);
        // Session::put('message','Kích hoạt ngừng bán danh mục sản phẩm thành công');
        Toastr::info('Kích hoạt bán danh mục sản phẩm thành công','Thành công');
        return Redirect::to('/quanlythucdon');
    }
}
