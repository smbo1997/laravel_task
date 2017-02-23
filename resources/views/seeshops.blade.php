@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <table id="mydatatable"  class="display table table-striped table-bordered table-hover" cellspacing="0"  width="100%">
                <thead>
                <tr>
                    <th>Shop Owner Name</th>
                    <th>Shop Owner Email</th>
                    <th>Shop Name</th>
                    <th>Shop Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Shop Owner Name</th>
                    <th>Shop Owner Email</th>
                    <th>Shop Name</th>
                    <th>Shop Image</th>
                    <th>Actions</th>
                </tr>
                </tfoot>

                <tbody>
                    @if(!empty($getshops))
                        @foreach($getshops as $key=>$value)
                            <tr>
                                <td>{{$value->name}}</td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->posts_name}}</td>
                                <td><img src="{{URL::asset('/post_images/'.$value->image)}}" width="100px" height="100px" style="border-radius: 8px"></td>
                                <td><a href="/{{$language}}/Deleteshop/{{$value->id}}">Deleteshop</a> |
                                    <a href="/{{$language}}/LoginwithUserId/{{$value->id}}">Login with store</a>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
                </table>
        </div>
    </div>
    <script>
        $('#mydatatable').DataTable();
    </script>
@endsection

