@foreach($categories as $sub_category)
    <tr>
        <td class="text-center">{{$sub_category->id}}</td>
        <td >{{str_repeat(' --- ',$level)}}{{$sub_category->name}}</td>
        <td class="text-center">
            <div class="display-inline-block">
                <form method="post" action="/administrator/categories/{{$sub_category->id}}">
                    <a href="{{route('categories.edit',$sub_category->id,compact($categories))}}" class="btn btn-warning" >ویرایش</a>
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit"  class="btn btn-danger " >حذف</button>
                </form>
            </div>
        </td>
    </tr>
    @if(count($sub_category->childrenRecursive)>0)
        @include('admin.partials.category_list',['categories'=>$sub_category->childrenRecursive,'level'=>$level+1])
    @endif
@endforeach