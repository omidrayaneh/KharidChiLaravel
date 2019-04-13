@extends('admin.layout.master')
@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right"> ویرایش برند {{$coupon->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="/administrator/coupons/{{$coupon->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">عنوان کد تخفیف</label>
                                <input type="text" name="title" class="form-control" value="{{$coupon->title}}"
                                       placeholder="عنوان برند ...">
                            </div>
                            <div class="form-group">
                                <label for="code">کد تخفیف</label>
                                <input type="text" name="code" value="{{$coupon->code}}" class="form-control"
                                       placeholder="کد تخفیف...">
                            </div>
                            <div class="form-group">
                                <label for="price">قیمت تخفیف</label>
                                <input type="text" name="price" value="{{$coupon->price}}" class="form-control"
                                       placeholder="قیمت تخفیف...">
                            </div>
                            <div class="form-group">
                                <label>وضعیت</label>
                                <div>
                                    <input type="radio" name="status" value="0" @if($coupon->status==0) checked @endif>
                                    <span class="margin-l-10">منتشر نشده</span>
                                    <input type="radio" name="status" value="1" @if($coupon->status==1) checked @endif>
                                    <span>منتشر شده</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection