<?php

namespace App\Http\Controllers;

use App\Models\datban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class QuanLyDatBanController extends Controller
{

    public function all()
    {
        if (session('name_admin')) {
            $all =  DB::table('datban')->get();
            return view('admin.quanlydatban', compact('all'));
      } else {
          return view('admin_login');
      }
      
    }

    public function add()
    {
        return view('admin.Add.themdatban');
    }

    public function show()
    {
        $userid = Session::get('userid');
        return view('pages.datban',compact('userid'));
    }

    public function save(Request $request){
        $errorMessages = [
            'name.required' => 'Vui lòng nhập đầy đủ tên của bạn.',
            'name.regex' => 'Tên không hợp lệ.',
            'email.required' => 'Vui lòng nhập email của bạn.',
            'email.regex' => 'Email không hợp lệ.',
            'sdt.required' => 'Vui lòng nhập mật khẩu.',
            'sdt.digits_between' => 'Số điện thoại phải chứa từ :min đến :max chữ số.',
            'sdt.numeric' => 'Số điện thoại phải là một số.',
            'songuoi.required' => 'Vui lòng nhập số lượng khách.',
            'songuoi.integer' => 'Số lượng khách phải là một số nguyên.',
            'songuoi.min' => 'Số lượng khách phải lớn hơn hoặc bằng :min.',
            'thoigian.required' => 'Vui lòng nhập thời gian.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[\p{L} ]+$/u'],
            'email' => ['required', 'regex:/[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}/'],
            'sdt' => ['required', 'digits_between:10,15', 'numeric'],
            'songuoi' => ['required', 'integer', 'min:1'],
            'thoigian' => ['required', 'min:6'],
        ], $errorMessages);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $data = array();
     
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['sdt'] = $request->sdt;
            $data['songuoi'] = $request->songuoi;
            $data['thoigian'] = $request->thoigian;
            $data['coso'] = $request->coso;
            $data['ghichu'] = $request->ghichu;
            $data['trangthai'] = $request->trangthai;
            $data['users_id'] = $request->userid;
            $data['trangthai']=$request->trangthai;
     
            // hàm lấy ra tổng số bàn đã đặt trong database table đặt bàn
            function soBanDaDat($date, $coso)
            {
                $result = DB::table('datban')
                    ->whereRaw("DATE(thoigian) = ?", [$date])
                    ->where('trangthai', 1)
                    ->where('coso', $coso)
                    ->sum('soban');
                // Echo the sum value
                // echo "so ban da dat : $result";
                return $result;
            }
     
            // hàm lấy tổng số bàn trên đơn vị 
     
            // so nguoi thuc te
            $nguoi = $data['songuoi'];
            // so ban khach dat
            $sobandat = ceil($nguoi / 6);
            $data['soban']=$sobandat;
            // echo "sobanorder : $sobandat";
            // lay ra thoi gian de truuy van du lieu so ban con lai
            $thoigian = $data['thoigian'];
            // lay ra ngay 
            $date = date('Y-m-d', strtotime($thoigian));
            // lay ra thong tin co so
            $cosokhachdat = $data['coso'];
            
            // so ban con lai trang db
            $sobanconlai = soBanDaDat($date, $cosokhachdat);
     
            // lay ra tong so ban cua co so khach dat ban
            function tongsobanthucte($coso)
            {
                $result = DB::table('coso')
                    ->where('tencoso', $coso)
                    ->value('tongsoban');
                // Echo the sum value
                // echo "result :$result";
                return $result;
            }
     
            // tong so ban cua moi co so
            $tongsoban = tongsobanthucte($cosokhachdat);
            // echo "tong so ban : $tongsoban";
     
            $something = $tongsoban - $sobandat;
            // echo "kq : $something số bàn còn lại là : $sobanconlai, kq trừ là $something - $sobandat";
     
            if (($tongsoban - $sobandat) <= $sobanconlai) {
                echo '<script>alert("Rất tiếc số bàn còn lại không đủ để đặt, vui lòng liên hệ nhân viên chăm sóc khách hàng để hỗ trợ đặt bàn theo số đường dây nóng của nhà hàng.");</script>';
                echo '<script>window.location.href = "' . url('/datban') . '";</script>';
            } else {
                // insert db
                DB::table('datban')->insert($data);
             //    Session::put('message', 'Cập nhật thành công!');
                
                // function get id bàn đặt on table datban
                Toastr::info('Thêm thành công!','Thành công');
                return Redirect::to('/quanlydatban');
            }
        }
    }

    public function save_user(Request $request){
        $errorMessages = [
            'name.required' => 'Vui lòng nhập đầy đủ tên của bạn.',
            'name.regex' => 'Tên không hợp lệ.',
            'email.required' => 'Vui lòng nhập email của bạn.',
            'email.regex' => 'Email không hợp lệ.',
            'sdt.required' => 'Vui lòng nhập mật khẩu.',
            'sdt.digits_between' => 'Số điện thoại phải chứa từ :min đến :max chữ số.',
            'sdt.numeric' => 'Số điện thoại phải là một số.',
            'songuoi.required' => 'Vui lòng nhập số lượng khách.',
            'songuoi.integer' => 'Số lượng khách phải là một số nguyên.',
            'songuoi.min' => 'Số lượng khách phải lớn hơn hoặc bằng :min.',
            'thoigian.required' => 'Vui lòng nhập thời gian.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[\p{L} ]+$/u'],
            'email' => ['required', 'regex:/[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}/'],
            'sdt' => ['required', 'digits_between:10,15', 'numeric'],
            'songuoi' => ['required', 'integer', 'min:1'],
            'thoigian' => ['required', 'min:6'],
        ], $errorMessages);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
        $data = array();


        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['sdt'] = $request->sdt;
        $data['songuoi'] = $request->songuoi;
        $data['thoigian'] = $request->thoigian;
        $data['coso'] = $request->coso;
        $data['ghichu'] = $request->ghichu;
        $data['trangthai'] = $request->trangthai;
        $data['users_id'] = $request->userid;
        $data['trangthai']=$request->trangthai;

        // hàm lấy ra tổng số bàn đã đặt trong database table đặt bàn
        function soBanDaDat($date, $coso)
        {
            $result = DB::table('datban')
                ->whereRaw("DATE(thoigian) = ?", [$date])
                ->where('trangthai', 1)
                ->where('coso', $coso)
                ->sum('soban');
            // Echo the sum value
            // echo "so ban da dat : $result";
            return $result;
        }

        // hàm lấy tổng số bàn trên đơn vị 

        // so nguoi thuc te
        $nguoi = $data['songuoi'];
        // so ban khach dat
        $sobandat = ceil($nguoi / 6);
        $data['soban']=$sobandat;
        // echo "sobanorder : $sobandat";
        // lay ra thoi gian de truuy van du lieu so ban con lai
        $thoigian = $data['thoigian'];
        // lay ra ngay 
        $date = date('Y-m-d', strtotime($thoigian));
        // lay ra thong tin co so
        $cosokhachdat = $data['coso'];
        
        // so ban con lai trang db
        $sobanconlai = soBanDaDat($date, $cosokhachdat);

        // lay ra tong so ban cua co so khach dat ban
        function tongsobanthucte($coso)
        {
            $result = DB::table('coso')
                ->where('tencoso', $coso)
                ->value('tongsoban');
            // Echo the sum value
            // echo "result :$result";
            return $result;
        }

        // tong so ban cua moi co so
        $tongsoban = tongsobanthucte($cosokhachdat);
        // echo "tong so ban : $tongsoban";

        $something = $tongsoban - $sobandat;
        // echo "kq : $something số bàn còn lại là : $sobanconlai, kq trừ là $something - $sobandat";

        if (($tongsoban - $sobandat) <= $sobanconlai) {
            echo '<script>alert("Rất tiếc số bàn còn lại không đủ để đặt, vui lòng liên hệ nhân viên chăm sóc khách hàng để hỗ trợ đặt bàn theo số đường dây nóng của nhà hàng.");</script>';
            echo '<script>window.location.href = "' . url('/datban') . '";</script>';
        } else {
            // insert db
            DB::table('datban')->insert($data);
            // Session::put('message', 'Đặt bàn thành công');
            // function get id bàn đặt on table datban
            function getIDTable($coso, $time, $userName, $sdt, $soNguoi, $email )
            {
                $result = DB::table('datban')
                    ->where('coso', $coso)
                    ->Where('thoigian', $time)
                    ->Where('sdt', $sdt)
                    ->Where('songuoi', $soNguoi)
                    ->Where('email', $email)
                    ->value('id');
                // Echo the sum value
                // echo "result :$result";
                return $result;
            }

            $id = getIDTable($request->coso, $thoigian, $request->name, $request->sdt, $request->songuoi, $request->email);
            Toastr::success('Cảm ơn bạn đã đặt bàn tại VMMS!','Thành công');
            return Redirect::to('/chitietdatban' . $id);
        }
    }
    }

    public function chitietdatban($id)
    {
        try {
            $userid = Session::get('userid');
            $result_id = DB::table('datban')
            ->where('users_id',$userid)
            ->where('trangthai',1)
            ->pluck('id');
            // $datban = datban::findOrFail($id_datban);
            $datban = DB::table('datban')->whereIn('id', $result_id)->get();
            //Test hien thi thong tin db
            // echo "<pre>";
            // print_r($datban);
            // echo "</pre>";
            // Toastr::success('Gửi thành công!','Thành công');
            // Toastr::success('Đặt bàn thành công!','Thành công');
            return view('pages.chitietdatban', compact('datban','userid'));
        } catch (ModelNotFoundException $exception) {
            // return view('pages.chitietdatban', compact('datban'));
            // echo '<script>alert("Không tìm thấy thông tin đặt bàn của quý khách. 
            // vui lòng liên hệ nhân viên chăm sóc khách hàng để được hỗ trợ về thông tin bàn đặt");</script>';
            return Redirect::to('datban')->with('message', 'Không tìm thấy thông tin đặt bàn của quý khách. Vui lòng liên hệ nhân viên chăm sóc khách hàng để được hỗ trợ về thông tin bàn đặt');
        }
    }

    public function suadatban($id){
        try {
            $userid = Session::get('userid');
            $datban = datban::findOrFail($id);
            return view('pages.suadatban', compact('datban','userid'));
        } catch (ModelNotFoundException $exception) {
            // return view('pages.chitietdatban', compact('datban'));
            // echo '<script>alert("Không tìm thấy thông tin đặt bàn của quý khách. 
            // vui lòng liên hệ nhân viên chăm sóc khách hàng để được hỗ trợ về thông tin bàn đặt");</script>';
            return Redirect::to('datban')->with('error', 'Không tìm thấy thông tin đặt bàn của quý khách. Vui lòng liên hệ nhân viên chăm sóc khách hàng để được hỗ trợ về thông tin bàn đặt');
        }
    }

    public function sua_datban_admin($id){
        try {
            $adminid = Session::get('id');
            $datban = datban::findOrFail($id);
            return view('pages.suadatban_admin', compact('datban','adminid'));
        } catch (ModelNotFoundException $exception) {
            // return view('pages.chitietdatban', compact('datban'));
            // echo '<script>alert("Không tìm thấy thông tin đặt bàn của quý khách. 
            // vui lòng liên hệ nhân viên chăm sóc khách hàng để được hỗ trợ về thông tin bàn đặt");</script>';
            return Redirect::to('quanlydatban')->with('error', 'Không tìm thấy thông tin đặt bàn.');
        }
    }
    public function unactiveDB($id)
    {
        DB::table('datban')->where('id',$id)->update(['trangthai'=>1]);
        // Session::put('message','Đã đổi sang trạng thái đã ăn ');
        Toastr::info('Đã đổi sang trạng thái đã ăn!','Thành công');

        return Redirect::to('/quanlydatban');
    }
    public function activeDB($id)
    {
        DB::table('datban')->where('id',$id)->update(['trangthai'=>0]);
        // Session::put('message','Đã đổi sang trạng thái chưa ăn');
        Toastr::info('Đã đổi sang trạng thái chưa ăn!','Thành công');

        return Redirect::to('/quanlydatban');
    }
    public function xoadatban($id){
        DB::table('datban')->where('id',$id)->delete();
        Toastr::success('Xóa thành công!','Thành công');

        // Session::put('message','Xóa thành công !');
        return Redirect::to('/quanlydatban');
    }
    public function huydatban($id){
        DB::table('datban')->where('id',$id)->delete();
        // Session::put('message','Hủy đặt bàn thành công');
        Toastr::success('Hủy đặt bàn thành công!','Thành công');
        return Redirect::to('/chitietdatban'.$id);
    }

    public function update_datban(Request $request, $id){
        if($request->name==""||$request->email==""||$request->sdt==""||$request->thoigian==""){
            Toastr::error('Vui lòng nhập đầy đủ thông tin', 'Thất bại', ["positionClass" => "toast-top-center toast-margin-top"]);
            return redirect()->back();
       }else{
       $data = array();

       $data['name'] = $request->name;
       $data['email'] = $request->email;
       $data['sdt'] = $request->sdt;
       $data['songuoi'] = $request->songuoi;
       $data['thoigian'] = $request->thoigian;
       $data['coso'] = $request->coso;
       $data['ghichu'] = $request->ghichu;
       $data['trangthai'] = $request->trangthai;
       $data['users_id'] = $request->userid;
       $data['trangthai']=$request->trangthai;

       // hàm lấy ra tổng số bàn đã đặt trong database table đặt bàn
       function soBanDaDat($date, $coso)
       {
           $result = DB::table('datban')
               ->whereRaw("DATE(thoigian) = ?", [$date])
               ->where('trangthai', 1)
               ->where('coso', $coso)
               ->sum('soban');
           // Echo the sum value
           // echo "so ban da dat : $result";
           return $result;
       }

       // hàm lấy tổng số bàn trên đơn vị 

       // so nguoi thuc te
       $nguoi = $data['songuoi'];
       // so ban khach dat
       $sobandat = ceil($nguoi / 6);
       $data['soban']=$sobandat;
       // echo "sobanorder : $sobandat";
       // lay ra thoi gian de truuy van du lieu so ban con lai
       $thoigian = $data['thoigian'];
       // lay ra ngay 
       $date = date('Y-m-d', strtotime($thoigian));
       // lay ra thong tin co so
       $cosokhachdat = $data['coso'];
       
       // so ban con lai trang db
       $sobanconlai = soBanDaDat($date, $cosokhachdat);

       // lay ra tong so ban cua co so khach dat ban
       function tongsobanthucte($coso)
       {
           $result = DB::table('coso')
               ->where('tencoso', $coso)
               ->value('tongsoban');
           // Echo the sum value
           // echo "result :$result";
           return $result;
       }

       // tong so ban cua moi co so
       $tongsoban = tongsobanthucte($cosokhachdat);
       // echo "tong so ban : $tongsoban";

       $something = $tongsoban - $sobandat;
       // echo "kq : $something số bàn còn lại là : $sobanconlai, kq trừ là $something - $sobandat";

       if (($tongsoban - $sobandat) <= $sobanconlai) {
           echo '<script>alert("Rất tiếc số bàn còn lại không đủ để đặt, vui lòng liên hệ nhân viên chăm sóc khách hàng để hỗ trợ đặt bàn theo số đường dây nóng của nhà hàng.");</script>';
           echo '<script>window.location.href = "' . url('/datban') . '";</script>';
       } else {
           // insert db
           DB::table('datban')
           ->where('id',$id)
           ->update($data);
        //    Session::put('message', 'Cập nhật thành công!');
           Toastr::info('Cập nhật thành công!','Thành công');
           
           // function get id bàn đặt on table datban

           return Redirect::to('/chitietdatban' . $id);
       }
   }
    }

    //sua dat ban admin
    public function update_datban_admin(Request $request, $id){
        if($request->name==""||$request->email==""||$request->sdt==""||$request->thoigian==""){
            Toastr::error('Vui lòng nhập đầy đủ thông tin', 'Thất bại', ["positionClass" => "toast-top-center toast-margin-top"]);
            return redirect()->back();
       }else{
       $data = array();

       $data['name'] = $request->name;
       $data['email'] = $request->email;
       $data['sdt'] = $request->sdt;
       $data['songuoi'] = $request->songuoi;
       $data['thoigian'] = $request->thoigian;
       $data['coso'] = $request->coso;
       $data['ghichu'] = $request->ghichu;
       $data['trangthai'] = $request->trangthai;
       $data['users_id'] = $request->userid;
       $data['trangthai']=$request->trangthai;

       // hàm lấy ra tổng số bàn đã đặt trong database table đặt bàn
       function soBanDaDat($date, $coso)
       {
           $result = DB::table('datban')
               ->whereRaw("DATE(thoigian) = ?", [$date])
               ->where('trangthai', 1)
               ->where('coso', $coso)
               ->sum('soban');
           // Echo the sum value
           // echo "so ban da dat : $result";
           return $result;
       }

       // hàm lấy tổng số bàn trên đơn vị 

       // so nguoi thuc te
       $nguoi = $data['songuoi'];
       // so ban khach dat
       $sobandat = ceil($nguoi / 6);
       $data['soban']=$sobandat;
       // echo "sobanorder : $sobandat";
       // lay ra thoi gian de truuy van du lieu so ban con lai
       $thoigian = $data['thoigian'];
       // lay ra ngay 
       $date = date('Y-m-d', strtotime($thoigian));
       // lay ra thong tin co so
       $cosokhachdat = $data['coso'];
       
       // so ban con lai trang db
       $sobanconlai = soBanDaDat($date, $cosokhachdat);

       // lay ra tong so ban cua co so khach dat ban
       function tongsobanthucte($coso)
       {
           $result = DB::table('coso')
               ->where('tencoso', $coso)
               ->value('tongsoban');
           // Echo the sum value
           // echo "result :$result";
           return $result;
       }

       // tong so ban cua moi co so
       $tongsoban = tongsobanthucte($cosokhachdat);
       // echo "tong so ban : $tongsoban";

       $something = $tongsoban - $sobandat;
       // echo "kq : $something số bàn còn lại là : $sobanconlai, kq trừ là $something - $sobandat";

       if (($tongsoban - $sobandat) <= $sobanconlai) {
           echo '<script>alert("Rất tiếc số bàn còn lại không đủ để đặt, vui lòng liên hệ nhân viên chăm sóc khách hàng để hỗ trợ đặt bàn theo số đường dây nóng của nhà hàng.");</script>';
           echo '<script>window.location.href = "' . url('/sua-datban-admin'.$id) . '";</script>';
       } else {
           // insert db
           DB::table('datban')
           ->where('id',$id)
           ->update($data);
        //    Session::put('message', 'Cập nhật thành công!');
           
           // function get id bàn đặt on table datban
           Toastr::info('Cập nhật thành công!','Thành công');
           return Redirect::to('/quanlydatban');
       }
   }
    }
}
