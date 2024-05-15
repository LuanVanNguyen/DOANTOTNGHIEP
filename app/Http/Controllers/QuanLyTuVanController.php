<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\tuvan;
use Brian2694\Toastr\Facades\Toastr;


class QuanLyTuVanController extends Controller
{
    public function all()
    {
        if (session('name_admin')) {
            $all = tuvan::orderBy('id','desc')->get();
            return view('admin.quanlytuvan', compact('all'));
  } else {
      return view('admin_login');
  }
      
    }
    public function guituvan(Request $request)
    {
        if($request->hoten==""||$request->sdt==""||$request->diachi==""||$request->noidung==""){
            Session::put('error','Bạn cần điền đầy đủ thông tin trước khi gửi!');
            return Redirect::to('/thucdon#dangkytuvan');
        }else{
            $data =array();
            $data['hoten']= $request->hoten;
            $data['users_id']= $request->users_id;
            $data['sdt']= $request->sdt;
            $data['diachi']= $request->diachi;
            $data['noidung']= $request->noidung;  
            $data['trangthai']="1"; 
            DB::table('tuvan')->insert($data);
            // return Redirect::to('/trangchu');
            Toastr::success('Chúng tôi sẽ liên hệ bạn sớm nhất có thể!','Gửi thành công!');
            return redirect()->back();
        }

    }
    public function del($id)
    {
        DB::table('tuvan')->where('id',$id)->delete();
        // Session::put('message','Đã xóa tư vấn thành công !');
    
        Toastr::success('Xóa tư vấn thành công!','Thành công');

        return Redirect::to('/quanlytuvan');
    }

    public function unactiveTuVan($id)
    {
        DB::table('tuvan')->where('id',$id)->update(['trangthai'=>1]);
        // Session::put('message','Chuyển sang trạng thái chưa xử lý!');
        Toastr::info('Chuyển sang trạng thái chưa xử lý!','Thành công');
        return Redirect::to('/quanlytuvan');
    }
    public function activeTuVan($id)
    {
        DB::table('tuvan')->where('id',$id)->update(['trangthai'=>0]);
        // Session::put('message','Chuyển sang trạng thái đã duyệt!');
        Toastr::info('Chuyển sang trạng thái đã duyệt!','Thành công');

        return Redirect::to('/quanlytuvan');
    }

    
}







