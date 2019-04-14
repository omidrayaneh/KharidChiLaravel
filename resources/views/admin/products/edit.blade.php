@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('/admin/dist/css/dropzone.css')}}">
@endsection
@section('content')
    <section class="content" id="app">
        <div class="box box-info" >
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ویرایش  محصول {{ $product->title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="/administrator/products/{{$product->id}}">
                            @csrf
                            <input type="hidden"  name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">نام محصول</label>
                                <input type="text" name="title" value="{{$product->title}}" class="form-control" placeholder="نام محصول ...">
                            </div>
                            <div class="form-group">
                                <label for="slug">نام مستعار محصول</label>
                                <input type="text" name="slug" value="{{$product->slug}}" class="form-control" placeholder="نام مستعار محصول ...">
                            </div>
                            <attribute-component :brands="{{ $brands }}" :product="{{$product}}"></attribute-component>
                            <div class="form-group">
                                <label>وضعیت نشر</label>
                                <div>
                                    <input type="radio" name="status" value="0" @if($product->status==0) checked @endif> <span class="margin-l-10">منتشر نشده</span>
                                    <input type="radio" name="status" value="1" @if($product->status==1) checked @endif> <span>منتشر شده</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>قیمت محصول</label>
                                <input type="number" name="price" value="{{$product->price}}" class="form-control" placeholder="قیمت محصول...">
                            </div>
                            <div class="form-group">
                                <label>قیمت ویژه محصول</label>
                                <input type="number" name="discount_price" value="{{$product->discount_price}}" class="form-control" placeholder="قیمت ویژه محصول...">
                            </div>
                            <div class="form-group">
                                <label>توضیحات کوتاه محصول</label>
                                <input type="text" name="short_description" value="{{$product->short_description}}" class="form-control" placeholder="توضیحات کوتاه محصول...">
                            </div>
                            <div class="form-group">
                                <label>توضیحات کامل محصول</label>
                                <textarea id="tetxareaDescription" type="text"   name="long_description" class="ckeditor form-control" placeholder="توضیحات کامل محصول...">{{$product->long_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">گالری تصاویر</label>
                                <input type="hidden" name="photo_id[]" id="product-photo">
                                <div id="photo" class="dropzone"></div>
                            </div>
                            <div class="row">
                                @foreach($product->photos as $photo)
                                    <div class="col-sm-3" id="updated_photo_{{$photo->id}}">
                                        <img class="img-responsive" src="{{$photo->path}}">
                                        <button type="button" class="btn btn-danger" onclick="removeImages({{$photo->id}})">حذف</button>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>عنوان ...</label>
                                <input type="text" name="meta_title" value="{{$product->meta_title}}" class="form-control" placeholder="عنوان دسته بندی ...">
                            </div>
                            <div class="form-group">
                                <label>توضیحات ...</label>
                                <textarea  id="tetxareaDescription" type="text" name="meta_desc" class="ckeditor form-control" placeholder="توضیحات دسته بندی ...">{{$product->meta_title}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>کلمات کلیدی ...</label>
                                <input type="text" name="meta_keywords" value="{{$product->meta_keywords}}" class="form-control" placeholder="کلمات کلیدی دسته بندی ...">
                            </div>
                            <button type="submit" onclick="productGallery()" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('/admin/dist/js/dropzone.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        Dropzone.autoDiscover=false;
        var photosGallery = []
        var photos=[].concat({{$product->photos->pluck('id')}})
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            url: "{{ route('photos.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                photosGallery.push(response.photo_id)
            }
        });
        productGallery =function () {
            document.getElementById('product-photo').value = photosGallery.concat(photos)
        }
        CKEDITOR.replace('tetxareaDescription',{
            customConfig:'config.js',
            toolbar:'simple',
            language: 'fa',
            removePlugins: 'cloudservices, easyimage'
        })
        removeImages = function (id) {
            var index=photos.indexOf(id);
            photos.splice(index,1);
            document.getElementById('updated_photo_' + id ).remove();
        }
    </script>

@endsection

