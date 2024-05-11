<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            if($result->status===0){
                Session::put('error', 'Tài khoản của bạn chưa được kích hoạt, vui lòng click vào <a href="'.url('/get-active').'">đây để tiến hành kích hoạt</a>');
                return Redirect::to('/dangnhap');
            }else{
                Session::put('username', $result->name);
                Session::put('userid', $result->id);
                return Redirect::to('/trangchu');
            }
        }
        else {
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
        $token =strtoupper(Str::random(10));
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'trangthai'=>$request->trangthai,
            'token'=> $token,
        ];
        $result=  DB::table('users')->where('email',$request->email)->first();
        if($result){
            return back()->with('error', 'Email đã được đăng ký. Vui lòng chọn email khác!');
        }else{
            $customerId = DB::table('users')->insertGetId($data);
            $customer = DB::table('users')->find($customerId);
            Mail::send('emails.active_account',compact('customer'),function($email) use($customer){
                $email->subject('Nhà hàng VMMS - Xác nhận tài khoản');
                $email->to($customer->email,$customer->name);
            });
            Session::put('message', 'Đăng ký thành công vui lòng xác nhận tài khoản qua email của bạn!');
            return Redirect::to('/dangnhap');
        }

    }
    public function active_account($user_id, $token){
        $result = DB::table('users')->where('id',$user_id)->first();
        if($result->token === $token){
            DB::table('users')
            ->where('id',$user_id)
            ->update(['status' => 1,'token'=>'null']);
            return Redirect::to('/dangnhap')->with('message','Xác nhận tài khoản thành công, bạn có thể đăng nhập');
        }else{
            return Redirect::to('/dangnhap')->with('error','Mã xác nhận bạn gửi không hợp lệ! Vui lòng thử lại!');
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

    public function test_mail(){
        $name = 'Nguyen Van Luan';
        Mail::send('emails.test',compact('name'),function($email) use($name){
            $email->subject('Demo mail');
            $email->to('nguyenluan200502@gmail.com',$name);
        });
    }

    //Quen mat khau
    public function quen_matkhau(){
        return view('pages.quenmatkhau');
    }

    public function post_quen_matkhau(Request $request){
        $email = $request->email;
        $user = DB::table('users')->where('email',$email)->first();
        if($user){
            $token =strtoupper(Str::random(10));
            $user->token = $token;
            DB::table('users')->where('email',$email)
            ->update(['token'=>$token]);
            Mail::send('emails.check_email_forget',compact('user'),function($email) use($user){
                $email->subject('Nhà hàng VMMS - Lấy lại mật khẩu của tài khoản');
                $email->to($user->email,$user->name);
            });
            return Redirect::to('/dangnhap')->with('message','Vui lòng check email để thực hiện thay đổi mật khẩu');
        }else{
            return Redirect::to('/quen-matkhau')->with('error','Email này không tồn tại trong hệ thống!');
        }
    }

    public function lay_matkhau($user_id, $token){
        $user = DB::table('users')->where('id',$user_id)->first();
        if($user->token === $token){
            return view('pages.getpass',compact('user'));
        }
        return abort(404);

    }

    public function post_lay_matkhau(Request $request, $user_id, $token){
        $newpassword = bcrypt($request->new_password);
        $result = DB::table('users')->where('id',$user_id)->first();
        if($result->token === $token){
            DB::table('users')
            ->where('id',$user_id)
            ->update(['password'=>$newpassword,'token'=>'null']);
            return Redirect::to('/dangnhap')->with('message','Đặt lại mật khẩu thành công, bạn có thể đăng nhập');
        }else{
            return Redirect::to('/dangnhap')->with('error','Mã xác nhận bạn gửi không hợp lệ! Vui lòng thử lại!');
        }
    }

    public function get_active(){
        return view('pages.getactive');
    }

    public function post_active(Request $request){
        $email = $request->email;
        $customer = DB::table('users')->where('email',$email)->first();
        if($customer){
            $token =strtoupper(Str::random(10));
            $customer->token = $token;
            DB::table('users')->where('email',$email)
            ->update(['token'=>$token]);
            Mail::send('emails.active_account',compact('customer'),function($email) use($customer){
                $email->subject('Nhà hàng VMMS - Xác nhận tài khoản');
                $email->to($customer->email,$customer->name);
            });
            return Redirect::to('/dangnhap')->with('message','Vui lòng check email để kích hoạt tài khoản!');
        }else{
            return Redirect::to('/quen-matkhau')->with('error','Email này không tồn tại trong hệ thống!');
        }
    }
}