<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Front-End
Route::get('/',[Controllers\TrangChuController::class,'index']);
Route::get('/trangchu',[Controllers\TrangChuController::class,'index']);
//Test mail


Route::get('/thucdon', [Controllers\ThucDonController::class,'thucdon']);
Route::get('/vanchuyen', [Controllers\VanChuyenController::class,'vanchuyen']);
Route::get('/tintuc', [Controllers\TinTucController::class,'tintuc']);
Route::get('/voucher', [Controllers\VoucherController::class,'voucher']);
Route::get('/chitiettintuc{id}', [Controllers\TinTucController::class,'chitiettintuc']);
Route::get('/thuvienanh', [Controllers\ThuVienAnhController::class,'thuvienanh']);
Route::get('/huongdan', [Controllers\HuongDanController::class,'huongdan']);
Route::get('/lienhe', [Controllers\LienHeController::class,'lienhe']);
Route::get('/sanpham',[Controllers\ThucDonController::class,'detail']);
Route::get('/danhsachmon',[Controllers\ThucDonController::class,'danhsachmon']);
Route::get('/danhsachdouong',[Controllers\ThucDonController::class,'danhsachdouong']);

Route::get('/datban',[Controllers\QuanLyDatBanController::class,'show']);
Route::get('/suadatban{id}', [Controllers\QuanLyDatBanController::class,'suadatban']);
Route::post('/savedatban',[Controllers\QuanLyDatBanController::class,'save_user']);
Route::get('/review',[Controllers\QuanLyDanhGiaController::class,'show']);
Route::post('/luureview',[Controllers\QuanLyDanhGiaController::class,'luureview']);
Route::get('/chitietdatban{id}', [Controllers\QuanLyDatBanController::class,'chitietdatban']);
Route::post('/guituvan',[Controllers\QuanLyTuVanController::class,'guituvan']);

//Admin
Route::get('/admin', [Controllers\QuanLyController::class,'login']);
Route::get('/dashboard', [Controllers\QuanLyController::class,'show']);
Route::get('/admin-dashboard', [Controllers\QuanLyController::class,'dangnhap']);
Route::get('/dangxuat', [Controllers\QuanLyController::class,'dangxuat']); 

//User dang nhap
Route::get('/dangnhap', [Controllers\TaiKhoanController::class,'login_user']);
Route::post('/logintrangchu', [Controllers\TaiKhoanController::class,'logintrangchu']);
Route::get('/dangky', [Controllers\TaiKhoanController::class,'dangky']);  
Route::post('/checkdky', [Controllers\TaiKhoanController::class,'checkdky']);
Route::get('/dangxuatuser', [Controllers\TaiKhoanController::class,'logout']);
Route::get('/doimatkhau', [Controllers\TaiKhoanController::class,'changepass']);
Route::post('/luuthaydoi', [Controllers\TaiKhoanController::class,'savechangepass']);


//Profile
Route::get('/profile', [Controllers\TaiKhoanController::class,'showProfile']);  

//QuanlyThucDon
Route::get('/quanlythucdon', [Controllers\QuanLyThucDonController::class,'all']);  
Route::get('/themthucdon', [Controllers\QuanLyThucDonController::class,'add']);
Route::get('/suathucdon{id}', [Controllers\QuanLyThucDonController::class,'edit']);
Route::get('/xoathucdon{id}', [Controllers\QuanLyThucDonController::class,'del']);
Route::post('/luuthucdon', [Controllers\QuanLyThucDonController::class,'save']); 
Route::post('/luuthucdon{id}', [Controllers\QuanLyThucDonController::class,'store']);  
Route::get('/unactive/{id}', [Controllers\QuanLyThucDonController::class,'unactive']); 
Route::get('/active/{id}', [Controllers\QuanLyThucDonController::class,'active']);

//QuanlyAdmin
Route::get('/quanlyadmin', [Controllers\QuanLyAdminController::class,'all']); 
Route::get('/themadmin', [Controllers\QuanLyAdminController::class,'add']);
Route::get('/suaadmin{id}', [Controllers\QuanLyAdminController::class,'edit']);
Route::get('/xoaadmin{id}', [Controllers\QuanLyAdminController::class,'del']);
Route::post('/luuadmin', [Controllers\QuanLyAdminController::class,'save']);
Route::post('/luuadmin{id}', [Controllers\QuanLyAdminController::class,'store']);

//Quan ly user
Route::get('/quanlyuser', [Controllers\QuanLyUserController::class,'all']); 
Route::get('/unactiveUser/{id}', [Controllers\QuanLyUserController::class,'unactive']); 
Route::get('/activeUser/{id}', [Controllers\QuanLyUserController::class,'active']);
Route::get('/xoauser{id}', [Controllers\QuanLyUserController::class,'del']);

//QuanLyTinTuc
Route::get('/quanlytintuc', [Controllers\QuanLyTinTucController::class,'all']); 
Route::get('/themtintuc', [Controllers\QuanLyTinTucController::class,'add']); 
Route::get('/unactiveNew/{id}', [Controllers\QuanLyTinTucController::class,'unactiveNew']); 
Route::get('/activeNew/{id}', [Controllers\QuanLyTinTucController::class,'activeNew']);
Route::get('/xoatintuc{id}', [Controllers\QuanLyTinTucController::class,'del']);
Route::get('/suatintuc{id}', [Controllers\QuanLyTinTucController::class,'edit']);
Route::post('/luutintuc', [Controllers\QuanLyTinTucController::class,'save']); 
Route::post('/luutintuc{id}', [Controllers\QuanLyTinTucController::class,'store']);  
//QuanLyDoAn
Route::get('/quanlydoan', [Controllers\QuanLyDoAnController::class,'all']);
Route::get('/themdoan', [Controllers\QuanLyDoAnController::class,'add']);
Route::get('/suadoan{id}', [Controllers\QuanLyDoAnController::class,'edit']);
Route::get('/xoadoan{id}', [Controllers\QuanLyDoAnController::class,'del']);
Route::post('/luudoan', [Controllers\QuanLyDoAnController::class,'save']);
Route::post('/luudoan{id}', [Controllers\QuanLyDoAnController::class,'store']);
Route::get('/unactiveFood/{id}', [Controllers\QuanLyDoAnController::class,'unactiveFood']); 
Route::get('/activeFood/{id}', [Controllers\QuanLyDoAnController::class,'activeFood']); 
  
//QuanLyAnh
Route::get('/quanlythuvienanh', [Controllers\QuanLyThuVienAnhController::class,'all']); 
Route::get('/themanh', [Controllers\QuanLyThuVienAnhController::class,'add']); 
Route::get('/suaanh{id}', [Controllers\QuanLyThuVienAnhController::class,'edit']);
Route::get('/xoaanh{id}', [Controllers\QuanLyThuVienAnhController::class,'del']);
Route::post('/luuanh', [Controllers\QuanLyThuVienAnhController::class,'save']); 
Route::post('/luuanh{id}', [Controllers\QuanLyThuVienAnhController::class,'store']); 
Route::get('/unactiveImages/{id}', [Controllers\QuanLyThuVienAnhController::class,'unactiveImages']); 
Route::get('/activeImages/{id}', [Controllers\QuanLyThuVienAnhController::class,'activeImages']);

//QuanLyVoucher
Route::get('/quanlyvoucher', [Controllers\QuanLyVoucherController::class,'all']); 
Route::get('/themvoucher', [Controllers\QuanLyVoucherController::class,'add']); 
Route::get('/suavoucher{id}', [Controllers\QuanLyVoucherController::class,'edit']);
Route::get('/xoavoucher{id}', [Controllers\QuanLyVoucherController::class,'del']);
Route::post('/luuvoucher', [Controllers\QuanLyVoucherController::class,'save']); 
Route::post('/luuvoucher{id}', [Controllers\QuanLyVoucherController::class,'store']); 
Route::get('/unactiveVoucher/{id}', [Controllers\QuanLyVoucherController::class,'unactiveVoucher']); 
Route::get('/activeVoucher/{id}', [Controllers\QuanLyVoucherController::class,'activeVoucher']);

//QuanLyDatban
Route::get('/quanlydatban', [Controllers\QuanLyDatBanController::class,'all']); 
Route::get('/themdatban', [Controllers\QuanLyDatBanController::class,'add']); 
Route::post('/luudatban', [Controllers\QuanLyDatBanController::class,'save']); 
Route::get('/xoadatban{id}', [Controllers\QuanLyDatBanController::class,'xoadatban']);
Route::get('/huydatban{id}', [Controllers\QuanLyDatBanController::class,'huydatban']);
Route::get('/sua-datban-admin{id}', [Controllers\QuanLyDatBanController::class,'sua_datban_admin']);
Route::post('/update-datban-admin{id}', [Controllers\QuanLyDatBanController::class,'update_datban_admin']);
Route::post('/update-datban{id}', [Controllers\QuanLyDatBanController::class,'update_datban']);
Route::get('/unactiveDB/{id}', [Controllers\QuanLyDatBanController::class,'unactiveDB']); 
Route::get('/activeDB/{id}', [Controllers\QuanLyDatBanController::class,'activeDB']);
//QuanLydanhGia
Route::get('/quanlydanhgia', [Controllers\QuanLyDanhGiaController::class,'all']);
Route::get('/unactiveReview/{id}', [Controllers\QuanLyDanhGiaController::class,'unactiveReview']); 
Route::get('/activeReview/{id}', [Controllers\QuanLyDanhGiaController::class,'activeReview']);
Route::get('/xoaReview{id}', [Controllers\QuanLyDanhGiaController::class,'del']);
//QuanLyTuVan
Route::get('/quanlytuvan', [Controllers\QuanLyTuVanController::class,'all']); 
Route::get('/unactiveTuVan/{id}', [Controllers\QuanLyTuVanController::class,'unactiveTuVan']); 
Route::get('/activeTuVan/{id}', [Controllers\QuanLyTuVanController::class,'activeTuVan']);
Route::get('/xoatuvan{id}', [Controllers\QuanLyTuVanController::class,'del']);

// tim kiem
//tim kiem san pham
Route::get('/timkiem', [Controllers\TimkiemController::class,'showSearchForm']); 
Route::post('/timkiemSP',  [Controllers\TimkiemController::class,'search']);
//tim kiem admin
Route::post('/timkiem-admin',  [Controllers\TimkiemController::class,'timkiem_admin']);
Route::post('/timkiem-user',  [Controllers\TimkiemController::class,'timkiem_user']);
//tim kiem theo thuc don
Route::post('/timkiem-thucdon',  [Controllers\TimkiemController::class,'timkiem_thucdon']);
//tim kiem theo do an
Route::post('/timkiem-doan',  [Controllers\TimkiemController::class,'timkiem_doan']);
//tim kiem tin tuc
Route::post('/timkiem-tintuc',  [Controllers\TimkiemController::class,'timkiem_tintuc']);
//tim kiem thu vien anh
Route::post('/timkiem-thuvienanh',  [Controllers\TimkiemController::class,'timkiem_thuvienanh']);
//tim kiem dat ban
Route::post('/timkiem-datban',  [Controllers\TimkiemController::class,'timkiem_datban']);
//tim kiem tu van
Route::post('/timkiem-tuvan',  [Controllers\TimkiemController::class,'timkiem_tuvan']);
//tim kiem danh gia
Route::post('/timkiem-danhgia',  [Controllers\TimkiemController::class,'timkiem_danhgia']);
//tim kiem voucher
Route::post('/timkiem-voucher',  [Controllers\TimkiemController::class,'timkiem_voucher']);





