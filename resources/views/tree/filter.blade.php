<ul id="tree1">
    @foreach($treeItems as $item)
        <li>
            {{ $item->name }}
            @if(count($item->childs))
                @include('tree/manageChild',['childs' => $item->childs])
            @endif
        </li>
    @endforeach
</ul>

