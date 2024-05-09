<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;
class QuanLyThuVienAnhController extends Controller
{
    public function all()
    {        
        if (session('name_admin')) {
       
            $all=  DB::table('thuvienanh')->get();
            return view('admin.quanlythuvienanh',compact('all'));
  } else {
      return view('admin_login');
  }
    }
    

   
    public function add()
    {
  
        return view('admin.Add.themanh');
    }
    public function save(Request $request)
    {
        if($request->tieude==""||$request->anhdaidien==""){
            Toastr::error('Vui lòng nhập đầy đủ thông tin', 'Thất bại', ["positionClass" => "toast-top-center toast-margin-top"]);
            return redirect()->back();
        }else{
        // Sửa
        // $file = $request->file('path');
        // $filename = time() . '.' . $file->getClientOriginalExtension();
        $data =array();
        $data['tieude']= $request->tieude;

        //Sua
        // $data['path']= $request->file('path')->storeAs('public/images/', $filename);
        if($request ->hasFile('anhdaidien')){
            $file = $request -> file('anhdaidien');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('public/storage/thuvienanhs/',$filename);
            $data['path']= $data['path'] = 'public/storage/thuvienanhs/' . $filename;

        }

        $data['trangthai']= $request->trangthai;
        DB::table('thuvienanh')->insert($data);
        // Session::put('message','Thêm danh mục sản phẩm thành công');
        Toastr::success('Thêm mới ảnh thành công!','Thành công');
        return Redirect::to('/quanlythuvienanh');
    }
    }
    public function edit($id)
    {
        $all=  DB::table('thuvienanh')->where('id',$id)->get();
        return view('admin.Update.suaanh',compact('all'));

    }
    public function store(Request $request,$id)
    {
        if($request->tieude==""||$request->path==""){
            Toastr::error('Vui lòng nhập đầy đủ thông tin', 'Thất bại', ["positionClass" => "toast-top-center toast-margin-top"]);
            return redirect()->back();
        }else{
        // $file = $request->file('path');
        // $filename = time() . '.' . $file->getClientOriginalExtension();
        $data =array();
        $data['tieude']= $request->tieude;
        // $data['path']= $request->file('path')->storeAs('public/storage/thuvienanhs', $filename);
        if($request ->hasFile('path')){
            $file = $request -> file('path');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('public/storage/thuvienanhs/',$filename);
            $data['path']= $data['path'] = 'public/storage/thuvienanhs/' . $filename;
        }
        $data['trangthai']= $request->trangthai;
        DB::table('thuvienanh')->where('id',$id)->update($data);
        // Session::put('message','Cập nhật ảnh thành công !');
        Toastr::info('Cập nhật ảnh thành công!','Thành công');
        return Redirect::to('/quanlythuvienanh');
    }
    }
    public function del($id)
    {
        DB::table('thuvienanh')->where('id',$id)->delete();
        // Session::put('message','Xóa ảnh thành công !');
        Toastr::success('Xóa ảnh thành công!','Thành công');
    

        return Redirect::to('/quanlythuvienanh');
    }
    public function unactiveImages($id)
    {
        DB::table('thuvienanh')->where('id',$id)->update(['trangthai'=>1]);
        // Session::put('message','Đã đổi sang trạng thái hiển thị ');
        Toastr::info('Đã đổi sang trạng thái hiển thị','Thành công');
        return Redirect::to('/quanlythuvienanh');
    }
    public function activeImages($id)
    {
        DB::table('thuvienanh')->where('id',$id)->update(['trangthai'=>0]);
        // Session::put('message','Đã đổi sang trạng thái ngừng hiển thị');
        Toastr::info('Đã đổi sang trạng thái hiển thị','Thành công');
        return Redirect::to('/quanlythuvienanh');
    }
}