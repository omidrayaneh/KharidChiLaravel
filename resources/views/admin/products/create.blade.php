@extends('admin.layout.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('/admin/dist/css/dropzone.css')}}">
@endsection

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ایجاد محصول جدید</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="/administrator/products" >
                            @csrf
                            <div class="form-group">
                                <label for="title">نام محصول</label>
                                <input type="text" name="title" class="form-control" placeholder="نام محصول ...">
                            </div>
                            <div class="form-group">
                                <label for="slug">نام مستعار محصول</label>
                                <input type="text" name="slug" class="form-control" placeholder="نام مستعار محصول ...">
                            </div>
                            <div class="form-group">
                                <label for="categories">دسته بندی</label>
                                <select name="categories[]" id="" class="form-control" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @if(count($category->childrenRecursive)>0)
                                            @include('admin.partials.category',['categories'=>$category->childrenRecursive,'level'=>1])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand">برند</label>
                                <select name="brand" id="" class="form-control">
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>وضعیت نشر</label>
                                <div>
                                    <input type="radio" name="status" value="0" checked> <span class="margin-l-10">منتشر نشده</span>
                                    <input type="radio" name="status" value="1"> <span>منتشر شده</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price">قیمت محصول</label>
                                <input type="number" name="price" class="form-control" placeholder="قیمت محصول...">
                            </div>
                            <div class="form-group">
                                <label for="discount_price">قیمت ویژه محصول</label>
                                <input type="number" name="discount_price" class="form-control" placeholder="قیمت ویژه محصول...">
                            </div>
                            <div class="form-group">
                                <label for="short_description">توضیحات کوتاه محصول</label>
                                <input type="text" name="short_description" class="form-control" placeholder="توضیحات کوتاه محصول...">
                            </div>
                            <div class="form-group">
                                <label for="long_description">توضیحات کامل محصول</label>
                                <textarea type="text" name="long_description" class="form-control" placeholder="توضیحات کامل محصول..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">تصویر</label>
                                <input type="hidden" name="photo_id" id="brand-photo">
                                <div id="photo" class="dropzone"></div>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">عنوان ...</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="عنوان دسته بندی ...">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">توضیحات ...</label>
                                <textarea type="text" name="meta_desc" class="form-control" placeholder="توضیحات دسته بندی ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">کلمات کلیدی ...</label>
                                <input type="text" name="meta_keywords" class="form-control" placeholder="کلمات کلیدی دسته بندی ...">
                            </div>
                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('/admin/dist/js/dropzone.js')}}"></script>
    <script>
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            url: "{{ route('photos.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                document.getElementById('brand-photo').value = response.photo_id
            }
        });
    </script>
@endsection
