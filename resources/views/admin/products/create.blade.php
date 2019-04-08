@extends('admin.layout.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('/admin/dist/css/dropzone.css')}}">
@endsection

@section('content')
    <section class="content" id="app">
        <div class="box box-info" >
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ایجاد محصول جدید</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form id="myForm" method="post" action="/administrator/products" >
                            @csrf
                            <div class="form-group">
                                <label for="title">نام محصول</label>
                                <input type="text" name="title" class="form-control" placeholder="نام محصول ...">
                            </div>
                            <div class="form-group">
                                <label for="slug">نام مستعار محصول</label>
                                <input type="text" name="slug" class="form-control" placeholder="نام مستعار محصول ...">
                            </div>
                            <option>انتخاب کنید...</option>
                            <attribute-component :brands="{{ $brands }}"></attribute-component>
                            <div class="form-group">
                                <label>وضعیت نشر</label>
                                <div>
                                    <input type="radio" name="status" value="0" checked> <span class="margin-l-10">منتشر نشده</span>
                                    <input type="radio" name="status" value="1"> <span>منتشر شده</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>قیمت محصول</label>
                                <input type="number" name="price" class="form-control" placeholder="قیمت محصول...">
                            </div>
                            <div class="form-group">
                                <label>قیمت ویژه محصول</label>
                                <input type="number" name="discount_price" class="form-control" placeholder="قیمت ویژه محصول...">
                            </div>
                            <div class="form-group">
                                <label>توضیحات کوتاه محصول</label>
                                <input type="text" name="short_description" class="form-control" placeholder="توضیحات کوتاه محصول...">
                            </div>
                            <div class="form-group">
                                <label>توضیحات کامل محصول</label>
                                <textarea id="tetxareaDescription" type="text" name="long_description" class="ckeditor form-control" placeholder="توضیحات کامل محصول..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">گالری تصاویر</label>
                                <input type="hidden" name="photo_id[]" id="product-photo">
                                <div id="photo" class="dropzone"></div>
                            </div>
                            <div class="form-group">
                                <label>عنوان ...</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="عنوان دسته بندی ...">
                            </div>
                            <div class="form-group">
                                <label>توضیحات ...</label>
                                <textarea  id="tetxareaDescription" type="text" name="meta_desc" class="ckeditor form-control" placeholder="توضیحات دسته بندی ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>کلمات کلیدی ...</label>
                                <input type="text" name="meta_keywords" class="form-control" placeholder="کلمات کلیدی دسته بندی ...">
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
            document.getElementById('product-photo').value = photosGallery
        }
        CKEDITOR.replace('tetxareaDescription',{
            customConfig:'config.js',
            toolbar:'simple',
            language: 'fa',
            removePlugins: 'cloudservices, easyimage'
        })
    </script>

@endsection
