@extends('admin.layout.master')
@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">انتخاب ویژگی برای دسته {{$category->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="/administrator/categories/{{$category->id}}/settings">
                            @csrf
                            <div class="form-group">
                                <label for="attributesGroup">انتخاب ویژگی</label>
                                <select name="attributesGroup[]" id="" class="form-control" multiple>
                                    @foreach($attributesGroup as $attributeGroup)
                                        <option value="{{$attributeGroup->id}}">{{$attributeGroup->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection