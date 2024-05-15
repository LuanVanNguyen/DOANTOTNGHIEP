<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TimkiemController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('inputSearch');
        if($keyword==""){
            $results = [];
            Session::put('message','Xin lỗi VMMS không tìm thấy kết quả cho từ khoá của bạn');
            return view('pages.ketquatimkiem',compact('results'));
        }else{
            // Truy vấn bảng sanpham để tìm kiếm theo từ khóa
            $results = DB::table('sampham')
                ->where('tensp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('tag', 'LIKE', '%' . $keyword . '%')
                ->orWhere('gia', 'LIKE', '%' . $keyword . '%')
                ->get();
            if($results->count() > 0){
                return view('pages.ketquatimkiem', compact('results'));
            }else{
                Session::put('message','Xin lỗi VMMS không tìm thấy kết quả cho từ khoá của bạn');
                return view('pages.ketquatimkiem', compact('results'));
            }
        }
    }

    //Tim kiem admin
    public function timkiem_admin(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('admin')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('name_admin', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('email_admin', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        $email_admin=null;
        if($all->count() > 0){
            $id_admin = Session::get('id');
            $email_admin = Session::get('email_admin');
            return view('admin.quanlyadmin',compact('all','id_admin','email_admin'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlyadmin', compact('all','email_admin'));
        }
    }

    //Tim kiem user
    public function timkiem_user(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('users')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        if($all->count() > 0){
            return view('admin.quanlyuser',compact('all'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlyuser',compact('all'));
        }
    }

    //Tim kiem thuc don
    public function timkiem_thucdon(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('danhmucmon')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('tendanhmuc', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        if($all->count() > 0){
            return view('admin.quanlythucdon',compact('all'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlythucdon',compact('all'));
        }
    }

    //tim kiem do an
    public function timkiem_doan(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('sampham')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('tensp', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('gia', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('tag', 'LIKE', '%' . $keyword . '%');

            })
            ->get();
        if($all->count() > 0){
            return view('admin.quanlydoan', compact('all'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlydoan', compact('all'));
        }
    }

    //Tim kiem tin tuc
    public function timkiem_tintuc(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('tintuc')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('tieude', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('thoigian', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('noidung', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        if($all->count() > 0){
            return view('admin.quanlytintuc', compact('all'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlytintuc', compact('all'));
        }
    }

    //TIm kiem theo thu vien anh
    public function timkiem_thuvienanh(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('thuvienanh')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('tieude', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        if($all->count() > 0){
            return view('admin.quanlythuvienanh', compact('all'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlythuvienanh', compact('all'));
        }
    }

    //Tim kiem dat ban
    public function timkiem_datban(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('datban')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('coso', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('thoigian', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        if($all->count() > 0){
            return view('admin.quanlydatban', compact('all'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlydatban', compact('all'));
        }
    }

    //Tim kiem tu van 
    public function timkiem_tuvan(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('tuvan')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('hoten', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        if($all->count() > 0){
            return view('admin.quanlytuvan', compact('all'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlytuvan', compact('all'));
        }
    }
    //TIm kiem danh gia
    public function timkiem_danhgia(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('danhgia')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('sdt', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('hoten', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        if($all->count() > 0){
            return view('admin.quanlydanhgia', compact('all'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlydanhgia', compact('all'));
        }
    }

    //Tim kiem voucher
    public function timkiem_voucher(Request $request){
        $keyword = $request->input('inputSearch');
        $all = DB::table('voucher')
            ->where(function($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('hsd', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('ma', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        if($all->count() > 0){
            return view('admin.quanlyvoucher', compact('all'));
        }else{
            Session::put('error','Không có kết quả nào phù hợp với mong muốn của bạn');
            return view('admin.quanlyvoucher', compact('all'));
        }
    }
    public function showSearchForm()
    {
        return view('pages.ketquatimkiem');
    }
}
?>