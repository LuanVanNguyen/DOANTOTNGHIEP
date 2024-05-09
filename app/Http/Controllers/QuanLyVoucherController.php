<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;
class QuanLyVoucherController extends Controller
{
    public function all()
    { 
        if (session('name_admin')) {
         
            $all=  DB::table('voucher')->get();
            return view('admin.quanlyvoucher',compact('all'));
      } else {
          return view('admin_login');
      }       
    }
 
    public function add()
    {

      
        return view('admin.Add.themvoucher');
    }
    public function save(Request $request)
    {
        if($request->ma==""||$request->giam==""||$request->toithieusonguoi==""||$request->hsd==""){
            Toastr::error('Vui lòng nhập đầy đủ thông tin', 'Thất bại', ["positionClass" => "toast-top-center toast-margin-top"]);
            return redirect()->back();
        }else{
        $data =array();
        $data['ma']= $request->ma;
        $data['giam']= $request->giam;
        $data['toithieusonguoi']= $request->toithieusonguoi;
        $data['hsd']= $request->hsd;
        $data['trangthai']= $request->trangthai;
        $data['ghichu']= $request->ghichu;
        DB::table('voucher')->insert($data);
        Toastr::success('Thêm voucher thành công!','Thành công');
        return Redirect::to('/quanlyvoucher');
        }   
    }
    public function edit($id)
    {
        $all=  DB::table('voucher')->where('id',$id)->get();
        return view('admin.Update.suavoucher',compact('all'));

    }
    public function store(Request $request,$id)
    {
        if($request->ma==""||$request->giam==""||$request->toithieusonguoi==""||$request->hsd==""){
            Toastr::error('Vui lòng nhập đầy đủ thông tin', 'Thất bại', ["positionClass" => "toast-top-center toast-margin-top"]);
            return redirect()->back();
        }else{
        $data =array();
        $data['ma']= $request->ma;
        $data['giam']= $request->giam;
        $data['toithieusonguoi']= $request->toithieusonguoi;
        $data['hsd']= $request->hsd;
        $data['trangthai']= $request->trangthai;
        $data['ghichu']= $request->ghichu;
        DB::table('voucher')->update($data);
        // Session::put('message','Cập nhật voucher thành công !');
        Toastr::info('Cập nhật voucher thành công!','Thành công');
        return Redirect::to('/quanlyvoucher');
        }
    }
    public function del($id)
    {
        DB::table('voucher')->where('id',$id)->delete();
        // Session::put('message','Xóa voucher thành công !');
        Toastr::success('Xóa voucher thành công!','Thành công');


        return Redirect::to('/quanlyvoucher');
    }
    public function unactiveVoucher($id)
    {
        DB::table('voucher')->where('id',$id)->update(['trangthai'=>1]);
        // Session::put('message','Đã đổi sang trạng thái còn hạn !');
        Toastr::info('Đã đổi sang trạng thái hết hạn!','Thành công');
        return Redirect::to('/quanlyvoucher');
    }
    public function activeVoucher($id)
    {
        DB::table('voucher')->where('id',$id)->update(['trangthai'=>0]);
        // Session::put('message','Đã đổi sang trạng thái hết hạn');
        Toastr::info('Đã đổi sang trạng thái còn hạn!','Thành công');

        return Redirect::to('/quanlyvoucher');
    }

    public function nhan_voucher(Request $request){
        $user_id = $request->user_id;
        $voucher_id = $request->voucher_id;
        $result = DB::table('user_voucher')->where('user_id', $user_id)->where('voucher_id', $voucher_id)->first();
        if($result){
            Toastr::warning('Bạn đã nhận được voucher này rồi!', 'Thông báo');
            return redirect()->back();
        }else{
        $data =array();
        $data['user_id']= $user_id;
        $data['voucher_id']= $voucher_id;
        DB::table('user_voucher')->insert($data);
        Toastr::success('Chúc mừng bạn đã nhận được một voucher!', 'Thành công');
        return redirect()->back();
        }
    }
    
}
