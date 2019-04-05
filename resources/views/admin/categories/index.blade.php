@extends('admin.layout.master')
@section('content')

    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">دسته بندی ها</h3>
                <div class=" text-left">
                    <a class="btn btn-app" href="{{route('categories.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('error_category'))
                    <div class="alert alert-danger">
                        <div>{{session('error_category')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">عنوان</th>
                            <th class="text-center"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="text-center">{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td class="text-center">
                                <div class="display-inline-block">
                                    <form method="post" action="/administrator/categories/{{$category->id}}">
                                        <a href="{{route('categories.edit',$category->id,compact($categories))}}" class="btn btn-warning" >ویرایش</a>
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"  class="btn btn-danger " >حذف</button>
                                        <a href="{{route('categories.indexSetting',$category->id,compact($categories))}}" class="btn btn-primary" >ویرایش</a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @if(count($category->childrenRecursive)>0)
                            @include('admin.partials.category_list',['categories'=>$category->childrenRecursive,'level'=>1])
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>

@endsection