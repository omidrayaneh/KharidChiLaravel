@extends('admin.layout.master')
@section('content')

    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right"> محصولات </h3>
                <div class=" text-left">
                    <a class="btn btn-app" href="{{route('products.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <div>{{session('success')}}</div>
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <div>{{session('error')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">کد محصول</th>
                            <th class="text-center">عنوان</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="text-center">{{$product->id}}</td>
                                <td class="text-center">{{$product->sku}}</td>
                                <td class="text-center">{{$product->title}}</td>
                                <td class="text-center">
                                    <div class="display-inline-block">
                                        <form method="post" action="/administrator/products/{{$product->id}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="{{route('products.edit',$product->id)}}"
                                               class="btn btn-warning">ویرایش</a>
                                            <button type="submit" class="btn btn-danger ">حذف</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12" style="text-align: center">{{$products->links()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>

@endsection