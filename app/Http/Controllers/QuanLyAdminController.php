<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\thuvienanh;
use App\Models\danhmucmon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class QuanLyAdminController extends Controller
{
    public function all()
    {
        if (session('name_admin')) {
            $all=  DB::table('admin')->get();
            $id_admin = Session::get('id');
            $email_admin = Session::get('email_admin');
            return view('admin.quanlyadmin',compact('all','id_admin','email_admin'));
      } else {
          return view('admin_login');
      }
       
    }
   
    public function add()
    {
  
        return view('admin.Add.themadmin');
    }
    public function save(Request $request)
    {

        // $file = $request->file('avatar_admin');
        // $filename = time() . '.' . $file->getClientOriginalExtension();

        // Lưu trữ ảnh trong file storage
        // $path = $file->storeAs('public/images', $filename);
        if($request->name_admin==""||$request->email_admin==""||$request->password_admin==""||$request->phone_admin==""){
            Session::put('message','Vui lòng nhập đủ thông tin!');
            return Redirect::to('/themadmin');
        }else{
            // lưu vào db
            $data = array();
            $data['name_admin']= $request->name_admin;
            $data['email_admin']= $request->email_admin;
            $result=  DB::table('admin')->where('email_admin',$request->email_admin)->first();
            $data['password_admin']= bcrypt($request->password_admin);
            // $data['avatar_admin'] = $request->file('avatar_admin')->storeAs('public/images/', $filename);
            if($request ->hasFile('avatar_admin')){
                $file = $request -> file('avatar_admin');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('public/storage/images/',$filename);
                $data['avatar_admin']= 'public/storage/images/' . $filename;
            }
            $data['phone_admin']= $request->phone_admin;
            $data['created_at']= date('Y-m-d H:i:s', strtotime('now'));;
            if($result){
                Session::put('message','Email đã được đăng ký. Vui lòng chọn email khác');
                return Redirect::to('/themadmin');
            }else{
                DB::table('admin')->insert($data);
                Session::put('message','Thêm Admin thành công');
                return Redirect::to('/quanlyadmin');
            }
        }
        
    }
    public function edit($id)
    {
        $all=  DB::table('admin')->where('id',$id)->get();
        return view('admin.Update.suaadmin',compact('all'));

    }
    public function store(Request $request,$id)
    {
       
        // $file = $request->file('avatar_admin');
        // $filename = time() . '.' . $file->getClientOriginalExtension();
        
        // Lưu trữ ảnh trong file storage
        // $path = $file->storeAs('public/images', $filename);

        // lưu vào db
        $data = array();
        $data['name_admin']= $request->name_admin;
        $data['email_admin']= $request->email_admin;
        $data['password_admin']= bcrypt($request->password_admin);
        // $data['avatar_admin'] = $request->file('avatar_admin')->storeAs('public/images/', $filename);
        if($request ->hasFile('avatar_admin')){
            $file = $request -> file('avatar_admin');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('public/storage/images/',$filename);
            $data['avatar_admin']= 'public/storage/images/' . $filename;
        }
        $data['phone_admin']= $request->phone_admin;
        $data['created_at']= date('Y-m-d H:i:s', strtotime($request->created_at));
        DB::table('admin')->where('id',$id)->update($data);
        Session::put('message','Cập nhật Admin thành công !');
    

        return Redirect::to('/quanlyadmin');
    }
    public function del($id)
    {
        DB::table('admin')->where('id',$id)->delete();
        Session::put('message','Xóa Admin thành công !');
    

        return Redirect::to('/quanlyadmin');
    }

    
}
