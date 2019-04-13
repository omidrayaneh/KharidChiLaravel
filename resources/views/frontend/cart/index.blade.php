@extends('frontend.layout.master')
@section('content')
    @if(Session::has('error'))
        <div class="alert alert-warning">
            <div>{{session('error')}}</div>
        </div>
    @endif
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="cart.html">سبد خرید</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title">سبد خرید</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td class="text-center" width="10%">تصویر</td>
                            <td class="text-left">نام محصول</td>
                            <td class="text-left">کد محصول</td>
                            <td class="text-left">تعداد</td>
                            <td class="text-right">قیمت واحد</td>
                            <td class="text-right">کل</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart->items as $product)
                            <tr>
                                <td width="10%" class="text-center"><a href="#"><img
                                                src="{{$product['item']->photos[0]->path}}"
                                                class="img-thumbnail"/></a></td>
                                <td class="text-left"><a href="#">{{$product['item']->title}}</a><br/>
                                <td class="text-left">{{$product['item']->sku}}</td>
                                <td class="text-left">
                                    <div class="input-group btn-block quantity text-center" >

                                        <span class="input-group-btn">
                                            <a  class="btn btn-primary" data-toggle="tooltip" title="افزودن" href="{{route('cart.add',['id'=>$product['item']->id])}}"><i class="fa fa-plus"></i></a>
                                            <button type="button" data-toggle="tooltip" title="حذف" class="btn btn-danger"
                                                    onclick="event.preventDefault();document.getElementById('remove-cart-item_{{$product['item']->id}}').submit();">
                                                <i class="fa fa-minus"></i></button>
                                        </span>
                                        <form id="remove-cart-item_{{$product['item']->id}}" action="{{ route('cart.remove',['id' => $product['item']->id]) }}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                        <p>تعداد : <span >{{$product['qty']}}</span></p>
                                    </div>
                                </td>
                                <td class="text-right">{{$product['item']->discount_price ? $product['item']->discount_price : $product['item']->price}}  تومان </td>
                                <td class="text-right">{{$product['price']}} تومان </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h2 class="subtitle">حالا مایلید چه کاری انجام دهید؟</h2>
                <p>در صورتی که کد تخفیف در اختیار دارید میتوانید از آن در اینجا استفاده کنید.</p>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">استفاده از کوپن تخفیف</h4>
                            </div>
                            <div id="collapse-coupon" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <label class="col-sm-4 control-label" for="input-coupon">کد تخفیف خود را در اینجا
                                        وارد کنید</label>
                                    <form action="{{ route('coupon.add') }}" method="post" >
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="code" placeholder="کد تخفیف خود را در اینجا وارد کنید" class="form-control"/>
                                            <span class="input-group-btn">
                                                  <button type="submit" class="btn btn-primary"
                                                         id="button-coupon">اعمال کوپن</button>
                                             </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-right"><strong>جمع کل</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalPurePrice}}
                                    تومان
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>تخفیف</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalDiscountPrice}}
                                    تومان
                                </td>
                            </tr>
                            @if(Auth::check() && Session::get('cart')->coupon)
                                <tr>
                                    <td class="text-right"><strong>{{Session::get('cart')->coupon['coupon']->title}}</strong></td>
                                    <td class="text-right">{{Session::get('cart')->couponDiscount}} تومان </td>
                                </tr>
                            @endif
                            {{-- <tr>
                                 <td class="text-right"><strong>مالیات</strong></td>
                                 <td class="text-right">11880 تومان</td>
                             </tr>--}}
                            <tr>
                                <td class="text-right"><strong>قابل پرداخت</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalPrice}} تومان </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="buttons">
                    <div class="pull-left"><a href="{{url('/')}}" class="btn btn-default">ادامه خرید</a></div>
                    <div class="pull-right"><a href="checkout.html" class="btn btn-primary">تسویه حساب</a></div>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
@endsection