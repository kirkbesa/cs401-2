<div>
    <ul>
        @foreach($list as $item)
            <li>
                {{ $item->id }}
                {{ $item->name }}
            </li>
        @endforeach
    </ul>
</div>