<div style="width: 600px;margin:0 auto;">
    <div style="text-align:center;">
        <h2>Xin chào {{$customer->name}}</h2>
        <p>Bạn đã đăng ký tài khoản tại hệ thống của chúng tôi</p>
        <p>Để có thể tiếp tục sử dụng các dịch vụ của nhà hàng bạn vui lòng nhấn vào nút kích hoạt bên dưới để kích hoạt tài khoản</p>
        <p>
            <a href="{{URL::to('/active-account/' . $customer->id . '/' . $customer->token)}}" 
            style="display:inline-block;background:green;color:#fff;padding: 7px 25px;font-weight:bold;">
                Kích hoạt tài khoản
            </a>
        </p>
    </div>
</div>