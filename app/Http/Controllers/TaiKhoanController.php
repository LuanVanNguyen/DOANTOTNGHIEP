<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class TaiKhoanController extends Controller
{
    public function login_user(Request $request)
    {
        if ($request->has('notlogin')) {
            // Xử lý khi không đăng nhập
            Session::put('notlogin','Bạn cần đăng nhập trước khi gửi đăng ký tư vấn!');
            return view('user_login');
        } elseif(($request->has('notlogin_datban'))){
            Session::put('notlogin_datban','Bạn cần đăng nhập trước khi đặt bàn!');
            return view('user_login');
        }else{
            // Xử lý khi đã đăng nhập
            return view('user_login');
        }

    }
    public function logintrangchu(Request $request)
    {

        $email = $request->email;
        $password = $request->password;
        $result = DB::table('users')->where('email', $email)->first();
        if ($result && password_verify($password,$result->password)) {
            Session::put('username', $result->name);
            Session::put('userid', $result->id);
            return Redirect::to('/trangchu');
        } else {
            Session::put('error', 'Mật khẩu hoặc tài khoản của bạn không đúng. Nhập lại !');
            return Redirect::to('/dangnhap');
        }
    }

    public function dangky()
    {
        return view('dangky');
    }


    public function checkdky(Request $request)
    {
        if($request->name==""||$request->email==""||$request->password==""){
            return back()->with('error', 'Bạn cần điền đầy đủ thông tin trước khi đăng ký!');
        }
        elseif($request->password != $request->password_confirmation) {
            return back()->with('error', 'Mật khẩu nhập lại không trùng khớp !');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'trangthai'=>$request->trangthai,
        ];
        $result=  DB::table('users')->where('email',$request->email)->first();
        if($result){
            return back()->with('error', 'Email đã được đăng ký. Vui lòng chọn email khác!');
        }else{
            DB::table('users')->insert($data);
            Session::put('message', 'Tạo tài khoản thành công');
            return Redirect::to('/dangnhap');
        }

    }

    public function showProfile()
    {

        $userid = Session::get('userid');
        $result = DB::table('users')
        ->join("datban","users.id","=","datban.users_id")
        ->where("users.id",$userid)
        ->get();
        return view('pages.profile',compact('userid','result'));
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng hiện tại

        $request->session()->invalidate(); // Vô hiệu hóa phiên hiện tại
        $request->session()->regenerateToken(); // Tạo lại mã thông báo phiên mới
        Session::forget('username', 'userid');

        return redirect('/dangnhap'); // Chuyển hướng người dùng đến trang đăng nhập
    }


    //đổi mật khẩu
    public function changepass()
    {
        return view('doimatkhau');
    }
    public function savechangepass(Request $request)

    {  
        $password = $request->old_password;
        $newpassword= $request->new_password;

        // Xác định người dùng hiện tại, ví dụ: từ session hoặc bất kỳ phương thức tùy chỉnh nào
        $userid = Session::get('userid'); // Đây chỉ là ví dụ, bạn cần xác định ID người dùng thực tế
         // Lấy thông tin người dùng từ CSDL
         $user = User::findOrFail($userid);


         if ($password == $user->password) {
             $user->password =$newpassword;
             $data = array();
             $data['name']= $request->fullname;
             $data['email']= $request->email;
             $data['password']= $newpassword;

             DB::table('users')->where('id',$userid)->update($data);
            
           
             return redirect('/profile'); 
           
         } else {
            Session::put('message', 'Mật khẩu hiện tại không chính xác !');
            return redirect('/doimatkhau'); 
         }


    }
}