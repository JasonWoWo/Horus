@foreach($items as $item)
    <li @lm-attrs($item) @if($item->hasChildren()) class="treeview" @endif  @lm-endattrs>
        <a href="{!! $item->url() !!}">{!! $item->title !!} </a>
        @if($item->hasChildren())
            <ul class="treeview-menu">
                @include('widget.subMenu', array('items' => $item->children()))
            </ul>
        @endif
    </li>
@endforeach