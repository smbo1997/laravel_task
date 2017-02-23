
<ul>
    @if(!empty($stores))
        @foreach($stores as $key=>$value)
            <li class="licontents">
                <div>
                    <img src="{{URL::asset('post_images/'.$value->image)}}" width="100px" height="100px" style="border-radius: 10px; float:left;">
                    <p style="color:#01A4E0 ; float: right">{{$value->name}}</p>
                </div>
            </li>
        @endforeach
    @endif
</ul>
<div style="margin-left: 145px">
    {{ $stores->links() }}
</div>