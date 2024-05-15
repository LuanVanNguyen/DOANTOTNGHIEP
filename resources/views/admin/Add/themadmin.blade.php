@extends('admin_layout')
@section('title','Thêm mới tài khoản')
@section('menu-name','Thêm admin')
@section('body')
<main class="main">
        <div class="container_body">
          <div class="content">
            <?php

            use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
            if ($message) {
              echo '<span style="font-size:20px ; color : red;display:flex;justify-content:center;margin-top:20px;"> ' . $message . '</span>';
              Session::put('message', null);
            }
            ?>
            <form action="{{URL::to('/luuadmin')}}" method="post" id="form-2" class="form__add form" enctype="multipart/form-data">
              @csrf
              <div class=" form-group form_add__name first_add_item ">
              <label class="form_text" for="name">Tên tài khoản</label> <br>
              <input style="height : 50px;" class="form_add__input" type="text" id="name_admin" name="name_admin" placeholder="Nhập tên tài khoản">
              <span class="form-message"></span>
              </div>
              <div class="form_add__name first_add_item form-group" >
              <label class="form_text" for="name">Email</label> <br>
              <input style="height : 50px;" id="email_admin" class="form_add__input form-control" type="text" name="email_admin" placeholder="Nhập email">
              <span class="form-message"></span>
              </div>
      
              <div class="form_add__name form-group">
                <label class="form_text" for="pass">Mật Khẩu</label> <br>
                <input style="height : 50px;" id="password_admin" class="form_add__input" type="password" name="password_admin" placeholder="Nhập mật khẩu">
                <span class="form-message"></span>
              </div>
              <div class="form_add__name pb_3rem form-group">
                <label class="form_text" for="type">Số điện thoại</label> <br>
                <input  style="height : 50px;" id="phone_admin" class="form_add__input"  type="text" name="phone_admin" placeholder="Nhập số điện thoại">
                <span class="form-message"></span>
              </div>
      
              <div class="form_add__name padding_y form-group">
                <label class="form_text" for="img">Ảnh</label> <br>
                <!-- lấy dữ liệu ảnh của input này -->
                <input class="form_add__input" type="text" name="image"> <br>
                <!-- cái này chỉ để hiện ảnh lên thôi -->
                <div class="img_input">
                  <input style="height : 50px;"  type="file" name="avatar_admin" placeholder="Aa" onchange="getImg(this)" class="file_input"> <br>
                </div>
              </div>
      
              <!-- <div class="form_add__name">
                <br><label class="form_text" for="date">Ngày tạo tài khoản</label> <br>
                <input class="form_add__input" type="text" name="created_at" placeholder="Ngày tạo tài khoản">
              </div>     -->
              <div class="form_add__name input_btn">
                <button type="submit" name="btn-sub" class="custom-btn btn-12"><span>Xác nhận</span><span>Thêm</span></button>
              </div>
            </form>
          </div>
        </div>
</main>
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
                  Validator.isRequired('#name_admin', 'Vui lòng nhập tên đầy đủ của bạn'),
                    Validator.isEmail('#email_admin'),
                    Validator.minLength('#password_admin', 6),
                    Validator.minLength('#phone_admin',10,"Số điện thoại không hợp lệ"),
                    Validator.minLength('#repassword',6),
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
@endsection