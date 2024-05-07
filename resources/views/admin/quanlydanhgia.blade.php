@extends('admin_layout')
@section('title','Quản lý đánh giá')
@section('menu-name','Quản lý đánh giá')
@section('body')
<main class="main">
    <div class="container_body">

        <div class="content">
            <div class="admin">
                <div class="admin__control__search">
                    <form action="{{URL::to('/timkiem-danhgia')}}" method="POST" class="form-search">
                        @csrf
                        <input type="search" name="inputSearch" placeholder="Nhập gì đó để tìm kiếm ..." />
                        <button type="submit">Tìm kiếm</button>
                    </form>
                </div>
            </div>
            <div class="admin__control">
                <div class="admin__control__text">
                    <span>
                        <a href="{{URL::to('/quanlydanhgia')}}" class="link_add">Tất cả </a>
                    </span>

                </div>
                <?php

                  use Illuminate\Support\Facades\Session;

                  $message = Session::get('message');
                  $error = Session::get('error');
                  if($error){
                      echo '<span style="font-size:25px ; color : red;"> '.$error.'</span>';
                      Session::put('error', null);
                  }elseif($message){
                    echo '<span style="font-size:25px ; color : green;"> '.$message.'</span>';
                    Session::put('message', null);
                  }
                ?>
                <div class="admin__data">
                    <table>
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>tên</td>
                                <td>sdt</td>
                                <td>Ghi chú</td>
                                <td>nội dung</td>
                                <td>trạng thái</td>
                                <td colspan="2">chức năng</td>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($all as $dg)
                            <tr>
                                <td>{{$dg->id}}</td>
                                <td>{{$dg->hoten }}</td>
                                <td>{{$dg->sdt}}</td>
                                <td>{{$dg->ghichu}}</td>
                                <td>{{$dg->noidung}}</td>
                                <td>
                                    <?php
                           if($dg->trangthai == 0)
                              {
                          ?>
                                    <a href="{{URL::to('/unactiveReview/'.$dg->id)}}">Ẩn</a>
                                    <?php
                              }else{
                                
                             

                          ?>
                                    <a href="{{URL::to('/activeReview/'.$dg->id)}}">Hiển thị</a>

                                    <?php

                              }
                          ?>

                                </td>
                                <td>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này khỏi danh sách?')"
                                        href="{{URL::to('/xoaReview'.$dg->id)}}">
                                        <button class="btn-6 custom-btn">Xóa</button>
                                </td>
                                </a>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection