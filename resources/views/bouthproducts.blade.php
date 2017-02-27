@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
        <table id="mydatatable"  class="display table table-striped table-bordered table-hover" cellspacing="0"  width="100%">
        <thead>
        <tr>
            <th>Shopper name</th>
            <th>Product price</th>
            <th>How many</th>
            <th>Bouth date</th>
            <th>Product image</th>
        </tr>
        </thead>
            <tfoot>
                <tr>
                    <th>Shopper name</th>
                    <th>Product price</th>
                    <th>How many</th>
                    <th>Bouth date</th>
                    <th>Product image</th>
                </tr>
            </tfoot>
        <tbody>
        @if(!empty($bouthproducts))
            @foreach($bouthproducts as $key=>$value)
                <tr>
                    <td>{{$value->name}}</td>
                    <td>{{$value->product_price}}$</td>
                    <td>{{$value->count}}</td>
                    <td>{{$value->created_at}}</td>
                    <td><img src="{{URL::asset('/products_images/'.$value->product_image)}}" style="border-radius: 8px" width="150px" height="150px"></td>
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