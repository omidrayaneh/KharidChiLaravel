@extends('frontend.layout.master')

@section('content')
    <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
            <h1 class="title">ثبت نام حساب کاربری</h1>
            <p>اگر قبلا حساب کاربریتان را ایجاد کرد اید جهت ورود به <a href="{{route('login')}}">صفحه لاگین</a> مراجعه کنید.</p>
            <form class="form-horizontal" method="post" action="{{route('user.register')}}">
                @csrf
                <fieldset id="account">
                    <legend>اطلاعات شخصی شما</legend>
                    <div  class="form-group required">
                        <label class="col-sm-2 control-label">گروه مشتری</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" checked="checked" value="1" name="customer_group_id">
                                    پیشفرض</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="name" class="col-sm-2 control-label">نام</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" placeholder="نام" value="" name="name">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="last_name" class="col-sm-2 control-label">نام خانوادگی</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="last_name" placeholder="نام خانوادگی" value="" name="last_name">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="email" class="col-sm-2 control-label">آدرس ایمیل</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="آدرس ایمیل" value="" name="email">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="phone" class="col-sm-2 control-label">شماره تلفن</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="phone" placeholder="شماره تلفن" value="" name="phone">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="mobile" class="col-sm-2 control-label">شماره موبایل</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="mobile" placeholder="شماره موبایل" value="" name="mobile">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>رمز عبور شما</legend>
                    <div class="form-group required">
                        <label for="password" class="col-sm-2 control-label">رمز عبور</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" placeholder="رمز عبور" value="" name="password">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="confirm" class="col-sm-2 control-label">تکرار رمز عبور</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="confirm" placeholder="تکرار رمز عبور" value="" name="confirm">
                        </div>
                    </div>
                </fieldset>

                <div class="buttons">
                    <div class="pull-right">
                        <input type="submit" class="btn btn-primary" value="ثبت نام">

                    </div>
                </div>
            </form>
        </div>
        <!--Middle Part End -->
        <!--Right Part Start -->

        <!--Right Part End -->
    </div>


@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection