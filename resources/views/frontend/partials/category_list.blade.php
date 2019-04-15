@foreach($categories as $sub_category)
        <div class="dropdown-menu">
            <ul>
                <li><a href="category.html"><span>&rsaquo;</span></a>
                    <div class="dropdown-menu">
                        <ul>
                            <li><a href="category.html"></a> </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    @if(count($sub_category->childrenRecursive)>0)
        @include('frontend.partials.category_list',['categories'=>$sub_category->childrenRecursive,'level'=>$level+1])
    @endif
@endforeach