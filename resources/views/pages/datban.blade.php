<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đặt bàn | VMMS2</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
  <link rel="stylesheet" href="public/front/css/owl.carousel.min.css" />
  <link rel="stylesheet" href="public/front/css/owl.theme.default.min.css" />
  <link rel="stylesheet" href="{{asset('public/front/css/booking-page.css')}}" />

  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

</style>
</head>

<body>
  <div class="wrapper booking-page">
    <header class="header">
      <div class="container">
        <div class="row">
          <div class="header-main col-lg-12">
            <span class="menu-bars">
              <i class="far fa-bars"></i>
            </span>
            <a href="{{URL::to('/trangchu')}}" class="logo">
              <img srcset="public/front/images/logo-vmms.png" alt="logo" />
            </a>
            <h1 class="header-title">ĐẶT BÀN</h1>
            <div class="header-contact">0962.180.180</div>
            <span class="menu-search">
              <i class="fas fa-search icon-search"></i>
              <form action="" class="search-mobile">
                <input type="search" name="" placeholder="Nhập tìm kiếm..." />
                <button type="submit" value="Tìm kiếm" class="search-form__button">
                  <i class="far fa-search"></i>
                </button>
              </form>
            </span>
          </div>
        </div>
      </div>
    </header>
    <main class="main">
      <div class="booking">
        <div class="booking-form" >
          <div class="booking-form-heading">ĐẶT BÀN NHANH CHÓNG TẠI VMMS</div>
          <?php

              use Illuminate\Support\Facades\Session;

              $message = Session::get('message');
              if ($message) {
                  echo '<span style="font-size:15px ; color : red; text-align:center; display:flex;justify-content: center; margin: 16px 0;"> ' . $message . '</span>';
                  Session::put('message', null);
          }
          ?>
          <?php
              $username = Session::get('username');
              $adminname = Session::get('name_admin');
              if ($username) {
                  // Người dùng đã đăng nhập
                  ?>
                    <form action="{{URL::to('/savedatban')}}" method="post" id="form-2">
                      @csrf
                      <div class="booking-form-item form-group">
                        <label>Họ và tên</label>
                        <input id="fullname" type="text" value="{{ old('name') }}" name="name" class="input form-control"  placeholder="Nhập họ tên"/>
                        <!-- <span class="form-message"></span> -->
                        @error('name')
                            <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                        @else
                        @enderror
                        <input type="hidden" name="userid" value="{{$userid}}">
                        <input type="hidden" name="trangthai" value="1">
                      </div>
                      <div class="booking-form-item  form-group">
                        <label>Email</label>
                        <input id="email" type="text" name="email" value="{{ old('email') }}" class="input form-control" placeholder="Nhập email" />
                        <!-- <span class="form-message"></span> -->
                        @error('email')
                            <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="booking-form-item required form-group">
                        <label>Số điện thoại</label>
                          <input id="phone" name="sdt" type="tel" value="{{ old('sdt') }}" class="input form-control" placeholder="+84"  />
                          <!-- <span class="form-message"></span> -->
                          @error('sdt')
                            <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="booking-form-item required form-group">
                        <label>Số khách</label>
                        <input id="number" name="songuoi" type="text" value="{{ old('songuoi') }}" class="input form-control" placeholder="Nhập số người " />
                        <!-- <span class="form-message"></span> -->
                        @error('songuoi')
                            <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="booking-form-item required form-group">
                        <label>Thời gian</label>
                        <input id="time" name="thoigian" type="datetime-local" class="input form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" placeholder="00:00 - dd/mm/yyyy" />
                        <!-- <span class="form-message"></span> -->
                        @error('thoigian')
                            <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="booking-form-item required form-group">
                        <label>Nhà hàng</label>
                        <select id="coso" name="coso" class="form-control">
                          <option value="Cơ sở 1">Cơ sở 1</option>
                          <option value="Cơ sở 2">Cơ sở 2</option>
                          <option value="Cơ sở 3">Cơ sở 3</option>
                        </select>
                        <span class="form-message"></span>
                      </div>
                      <div class="booking-form-item required">
                        <label>Ghi chú</label>
                        <textarea name="ghichu" id="" placeholder="Aa"></textarea>
                      </div>

                      <div class="booking-form-item required">
                        <button type="submit" class="btn btn-primary btn-submit">
                          Đặt bàn ngay
                        </button>
                      </div>
                    </form>
                  <?php
              }
              elseif ($adminname) {
                // Admin đã đăng nhập
                ?>
                  <form action="{{URL::to('/luudatban')}}" method="post" id="form-2">
                    @csrf
                    <div class="booking-form-item form-group">
                      <label>Họ và tên</label>
                      <input id="fullname" type="text" value="{{ old('name') }}" name="name" class="input form-control"  placeholder="Nhập họ tên"/>
                      <!-- <span class="form-message"></span> -->
                      @error('name')
                          <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                      @else
                      @enderror
                      <input type="hidden" name="userid" value="00">
                      <input type="hidden" name="trangthai" value="1">
                    </div>
                    <div class="booking-form-item  form-group">
                      <label>Email</label>
                      <input id="email" type="text" name="email" value="{{ old('email') }}" class="input form-control" placeholder="Nhập email" />
                      <!-- <span class="form-message"></span> -->
                      @error('email')
                          <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="booking-form-item required form-group">
                      <label>Số điện thoại</label>
                        <input id="phone" name="sdt" type="tel" value="{{ old('sdt') }}" class="input form-control" placeholder="+84"  />
                        <!-- <span class="form-message"></span> -->
                        @error('sdt')
                          <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="booking-form-item required form-group">
                      <label>Số khách</label>
                      <input id="number" name="songuoi" type="text" value="{{ old('songuoi') }}" class="input form-control" placeholder="Nhập số người " />
                      <!-- <span class="form-message"></span> -->
                      @error('songuoi')
                          <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="booking-form-item required form-group">
                      <label>Thời gian</label>
                      <input id="time" name="thoigian" type="datetime-local" class="input form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" placeholder="00:00 - dd/mm/yyyy" />
                      <!-- <span class="form-message"></span> -->
                      @error('thoigian')
                          <span style="color:red;" class="form-message error-message">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="booking-form-item required form-group">
                      <label>Nhà hàng</label>
                      <select id="coso" name="coso" class="form-control">
                        <option value="Cơ sở 1">Cơ sở 1</option>
                        <option value="Cơ sở 2">Cơ sở 2</option>
                        <option value="Cơ sở 3">Cơ sở 3</option>
                      </select>
                      <span class="form-message"></span>
                    </div>
                    <div class="booking-form-item required">
                      <label>Ghi chú</label>
                      <textarea name="ghichu" id="" placeholder="Aa"></textarea>
                    </div>

                    <div class="booking-form-item required">
                      <button type="submit" class="btn btn-primary btn-submit">
                        Đặt bàn ngay
                      </button>
                    </div>
                  </form>
                <?php
            }
              
              else {
                  // Người dùng chưa đăng nhập
                  ?>
                    <form action="{{URL::to('/dangnhap')}}" method="get" id="form-2">
                      @csrf
                      <div class="booking-form-item form-group">
                        <label>Họ và tên</label>
                        <input id="fullname" type="text" name="name" class="form-control"  placeholder="Nhập họ tên"/>
                        <input name="notlogin_datban" type="hidden"/>
                        <span class="form-message"></span>
                        <input type="hidden" name="userid" value="{{$userid}}">
                        <input type="hidden" name="trangthai" value="1">
                      </div>
                      <div class="booking-form-item required form-group">
                        <label>Email</label>
                        <input id="email" type="email" name="email" class="form-control" placeholder="Nhập email" />
                        <span class="form-message"></span>
                      </div>
                      <div class="booking-form-item required form-group">
                        <label>Số điện thoại</label>
                          <input id="phone" name="sdt" type="tel" class="form-control" pattern="[0-9]{10,12}" placeholder="+84"  />
                          <span class="form-message"></span>
                      </div>
                      <div class="booking-form-item required form-group">
                        <label>Số khách</label>
                        <input id="number" name="songuoi" type="text" class="form-control" placeholder="Nhập số người " pattern="[0-9]{1,3}" />
                        <span class="form-message"></span>
                      </div>
                      <div class="booking-form-item required form-group">
                        <label>Thời gian</label>
                        <input id="time" name="thoigian" type="datetime-local" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" placeholder="00:00 - dd/mm/yyyy" />
                        <span class="form-message"></span>
                      </div>
                      <div class="booking-form-item required form-group">
                        <label>Nhà hàng</label>
                        <select id="coso" name="coso" class="form-control">
                          <option value="Cơ sở 1">Cơ sở 1</option>
                          <option value="Cơ sở 2">Cơ sở 2</option>
                          <option value="Cơ sở 3">Cơ sở 3</option>
                        </select>
                        
                      </div>
                      <div class="booking-form-item required">
                        <label>Ghi chú</label>
                        <textarea name="ghichu" id="" placeholder="Aa"></textarea>
                      </div>

                      <div class="booking-form-item required">
                        <button type="submit" class="btn btn-primary btn-submit">
                          Đặt bàn ngay
                        </button>
                      </div>
                    </form>
                  <?php
              }
          ?>
        </div>
      </div>
    </main>
    <footer class="footer">
      <div class="container footer--top">
        <div class="row">
          <div class="footer-col footer-col-1 col">
            <div class="footer-col-content footer-info">
              <a href="home-page.html" class="footer-logo"><img src="public/front//images/logo-vmms.png" alt="Logo" /></a>
              <p class="footer-info__address">
                Tầng 3 số 14 Pháo Đài Láng, Đống Đa, Hà Nội
              </p>
              <p class="footer-info__phone">(+84-4) 3562.6296</p>
              <p class="footer-info__email">info@vmms.vn</p>
              <p class="footer-info__time">Mở cửa: 09:30 - 22:00</p>
            </div>
          </div>
          <div class="footer-col footer-col-2 col">
            <div class="footer-col-title">LIÊN KẾT NHANH</div>
            <div class="footer-col-content">
              <ul class="menu-footer">
                <li class="menu-footer__link">
                  <a href="{{URL::to('/trangchu')}}">Trang chủ</a>
                </li>
                <li class="menu-footer__link">
                  <a href="aboutus section-py">Giới thiệu</a>
                </li>
                <li class="menu-footer__link">
                  <a href="{{URL::to('/tintuc')}}">Tin tức</a>
                </li>
                <li class="menu-footer__link">
                  <a href="{{URL::to('/sanpham')}}">Thực đơn</a>
                </li>
                <li class="menu-footer__link">
                  <a href="{{URL::to('/lienhe')}}">Liên hệ</a>
                </li>
                <li class="menu-footer__link">
                  <a href="{{URL::to('/datban')}}">Đặt bàn</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="footer-col footer-col-3 col">
            <div class="footer-col-title">HƯỚNG DẪN</div>
            <div class="footer-col-content">
              <ul class="menu-footer">
                <li class="menu-footer__link">
                  <a href="{{URL::to('/huongdan')}}">Hướng dẫn đặt món online</a>
                </li>
                <li class="menu-footer__link">
                  <a href="{{URL::to('/huongdan')}}">Hướng dẫn đặt bàn</a>
                </li>
                <li class="menu-footer__link">
                  <a href="{{URL::to('/huongdan')}}">Hướng dẫn thanh toán</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="footer-col footer-col-4 col">
            <div class="fanpage-facebook">
              <div class="fanpage-facebook-avatar">
                <img src="public/front/images/facebook.jpg" alt="" />
              </div>
              <div class="fanpage-facebook-content">
                <a href="http://www.facebook.com/" class="fanpage-facebook-name">NHÀ HÀNG VMMS</a>
                <div class="fanpage-facebook-like">
                  <a href="http://www.facebook.com/"><img src="public/front//images/icon-face2.png" /> Like Page</a><span>50K người đã thích</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container footer--bottom">
        <div class="row">
          <div class="col col-sm-12 col-md-7">
            <div class="footer-copyright">COPYRIGHT © 2022 BY VMMS</div>
          </div>
          <div class="col col-sm-12 col-md-5">
            <a href="!#" target="_blank" class="footer-bct"><img src="public/front/images/thongbaobocongthuong.png" alt="Thông báo bộ công thương" /></a>
            <div class="social-network">
              <div class="social-network__title">KẾT NỐI VỚI CHÚNG TÔI</div>
              <ul class="social-network__list">
                <li>
                  <a href="https://www.facebook.com/" rel="nofollow" target="_blank"><img src="public/front/images/icon-face.svg" alt="facebook" /></a>
                </li>
                <li>
                  <a href="https://twitter.com/" rel="nofollow" target="_blank"><img src="public/front/images/icon-instagram.svg" alt="instagram" /></a>
                </li>
                <li>
                  <a href="https://www.youtube.com/" rel="nofollow" target="_blank"><img src="public/front/images/icon-twitter.svg" alt="twitter" /></a>
                </li>
                <li>
                  <a href="https://mail.google.com/" rel="nofollow" target="_blank"><img src="public/front/images/icon-gg.svg" alt="Gmail" /></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <a href="{{URL::to('/datban')}}" class="btn-booking">Đặt bàn</a>
    </footer>
    <div class="mobile-sidebar d-lg-none">
      <div class="mobile-sidebar--top">
        <a href="https://www.facebook.com/" class="mobile-sidebar-logo"><img src="public/front/images/logo-vmms.png" alt="Logo" /></a>
        <i class="mobile-sidebar-close"></i>
      </div>
      <div class="mobile-sidebar--bottom">
        <ul class="menu">
          <li class="menu-item active">
            <a href="{{URL::to('/trangchu')}}" class="menu-link">Trang chủ</a>
          </li>
          <li class="menu-item">
            <a href="{{URL::to('/sanpham')}}" class="menu-link">Sản phẩm</a>
          </li>
          <li class="menu-item">
            <a href="{{URL::to('/tintuc')}}" class="menu-link">Tin tức</a>
          </li>
          <li class="menu-item">
            <a href="{{URL::to('/trangchu')}}" class="menu-link">Khuyến mại</a>
          </li>
          <li class="menu-item">
            <a href="{{URL::to('/huongdan')}}"class="menu-link">Hướng dẫn mua hàng</a>
          </li>
          <li class="menu-item">
            <a href="{{URL::to('/lienhe')}}" class="menu-link">Liên Hệ</a>
          </li>
          <li class="menu-item">
            <a href="{{URL::to('/dangky')}}" class="menu-link">Đăng ký</a>
          </li>
          <li class="menu-item">
            <a href="{{URL::to('/dangnhap')}}" class="menu-link">Đăng nhập</a>
          </li>
        </ul>
        <div class="phone-number d-block">
          <a href="tel:0962180180">0962.180.180</a>
        </div>
      </div>
    </div>
    <div class="menu-bars-close"></div>
  </div>

  <script type="text/javascript" src="public/front/js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="public/front/js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="public/front/js/script.js"></script>
    <script>
        const formGroups = document.querySelectorAll('.form-group');
        console.log('hjhjhjhjhjhjhjhjjjjhj',formGroups) 

        formGroups.forEach((formGroup) => {
            const errorMessage = formGroup.querySelector('.error-message');
            const formControls = formGroup.querySelector('.form-control');
            // const errorSpans = formGroup.querySelectorAll('.error-message');   
            console.log('formGroupformGroupformGroupformGroup',formControls)
            if (errorMessage) {
              // console.log('vao day')
              errorMessage.classList.add('active');
              formControls.classList.add('error');
            } 
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mong muốn của chúng ta
            Validator({
                form: '#form-1',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
                    Validator.isEmail('#email'),
                    Validator.minLength('#password', 6),
                    Validator.isRequired('#password_confirmation'),
                    Validator.isConfirmed('#password_confirmation', function() {
                        return document.querySelector('#form-1 #password').value;
                    }, 'Mật khẩu nhập lại không chính xác')
                ],
                onSubmit: function(data) {
                    // Call API
                    console.log(data);
                }
            });


            Validator({
                form: '#form-2',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                  Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
                    Validator.isEmail('#email'),
                    Validator.minLength('#password', 6),
                    Validator.minLength('#newpassword',6),
                    Validator.minLength('#repassword',6),
                    Validator.minLength('#phone',10,'Số điện thoại không hợp lệ'),
                    Validator.isNumber('#number','Số người không hợp lệ'),
                    Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại'),
                    Validator.isRequired('#number', 'Vui lòng nhập số khách'),
                    Validator.isRequired('#email', 'Vui lòng nhập email'),
                    Validator.isConfirmed('#repassword', function() {
                        return document.querySelector('#form-2 #newpassword').value;
                    }, 'Mật khẩu nhập lại không chính xác'),

                ],
                onSubmit: function(data) {
                    // Call API
                    console.log(data);
                }
            });
        });

        // Đối tượng `Validator`
        function Validator(options) {
            function getParent(element, selector) {
                while (element.parentElement) {
                    if (element.parentElement.matches(selector)) {
                        return element.parentElement;
                    }
                    element = element.parentElement;
                }
            }

            var selectorRules = {};

            // Hàm thực hiện validate
            function validate(inputElement, rule) {
                var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                var errorMessage;

                // Lấy ra các rules của selector
                var rules = selectorRules[rule.selector];

                // Lặp qua từng rule & kiểm tra
                // Nếu có lỗi thì dừng việc kiểm
                for (var i = 0; i < rules.length; ++i) {
                    switch (inputElement.type) {
                        case 'radio':
                        case 'checkbox':
                            errorMessage = rules[i](
                                formElement.querySelector(rule.selector + ':checked')
                            );
                            break;
                        default:
                            errorMessage = rules[i](inputElement.value);
                    }
                    if (errorMessage) break;
                }

                if (errorMessage) {
                    errorElement.innerText = errorMessage;
                    getParent(inputElement, options.formGroupSelector).classList.add('invalid');
                } else {
                    errorElement.innerText = '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                }

                return !errorMessage;
            }

            // Lấy element của form cần validate
            var formElement = document.querySelector(options.form);
            if (formElement) {
                // Khi submit form
                formElement.onsubmit = function(e) {
                    e.preventDefault();

                    var isFormValid = true;

                    // Lặp qua từng rules và validate
                    options.rules.forEach(function(rule) {
                        var inputElement = formElement.querySelector(rule.selector);
                        var isValid = validate(inputElement, rule);
                        if (!isValid) {
                            isFormValid = false;
                        }
                    });

                    if (isFormValid) {
                        // Trường hợp submit với javascript
                        if (typeof options.onSubmit === 'function') {
                            var enableInputs = formElement.querySelectorAll('[name]');
                            var formValues = Array.from(enableInputs).reduce(function(values, input) {

                                switch (input.type) {
                                    case 'radio':
                                        values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                        break;
                                    case 'checkbox':
                                        if (!input.matches(':checked')) {
                                            values[input.name] = '';
                                            return values;
                                        }
                                        if (!Array.isArray(values[input.name])) {
                                            values[input.name] = [];
                                        }
                                        values[input.name].push(input.value);
                                        break;
                                    case 'file':
                                        values[input.name] = input.files;
                                        break;
                                    default:
                                        values[input.name] = input.value;
                                }

                                return values;
                            }, {});
                            options.onSubmit(formValues);
                        }
                        // Trường hợp submit với hành vi mặc định
                        else {
                            formElement.submit();
                        }
                    }
                }

                // Lặp qua mỗi rule và xử lý (lắng nghe sự kiện blur, input, ...)
                options.rules.forEach(function(rule) {

                    // Lưu lại các rules cho mỗi input
                    if (Array.isArray(selectorRules[rule.selector])) {
                        selectorRules[rule.selector].push(rule.test);
                    } else {
                        selectorRules[rule.selector] = [rule.test];
                    }

                    var inputElements = formElement.querySelectorAll(rule.selector);

                    Array.from(inputElements).forEach(function(inputElement) {
                        // Xử lý trường hợp blur khỏi input
                        inputElement.onblur = function() {
                            validate(inputElement, rule);
                        }

                        // Xử lý mỗi khi người dùng nhập vào input
                        inputElement.oninput = function() {
                            var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                            errorElement.innerText = '';
                            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                        }
                    });
                });
            }

        }



        // Định nghĩa rules
        // Nguyên tắc của các rules:
        // 1. Khi có lỗi => Trả ra message lỗi
        // 2. Khi hợp lệ => Không trả ra cái gì cả (undefined)
        Validator.isRequired = function(selector, message) {
            return {
                selector: selector,
                test: function(value) {
                    return value ? undefined : message || 'Vui lòng nhập trường này'
                }
            };
        }

        Validator.isEmail = function(selector, message) {
            return {
                selector: selector,
                test: function(value) {
                    var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    return regex.test(value) ? undefined : message || 'Trường này phải là email';
                }
            };
        }

        Validator.isNumber = function(selector, message) {
            return {
                selector: selector,
                test: function(value) {
                    var regex = /^-?\d+(\.\d+)?$/;
                    return regex.test(value) ? undefined : message || 'Trường này phải là số';
                }
            };
        }
        

        Validator.minLength = function(selector, min, message) {
            return {
                selector: selector,
                test: function(value) {
                    return value.length >= min ? undefined : message || `Vui lòng nhập tối thiểu ${min} kí tự`;
                }
            };
        }

        Validator.isConfirmed = function(selector, getConfirmValue, message) {
            return {
                selector: selector,
                test: function(value) {
                    return value === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác';
                }
            }
        }
    </script>

    <script>
        document.getElementById('form-2').addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của trình duyệt
            this.submit(); // Gửi biểu mẫu bằng phương thức POST
        });
    </script>

        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}

  </body>

</html>