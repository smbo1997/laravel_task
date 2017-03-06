@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
        @if(!$bouthproducts->isEmpty())
        <table id="mydatatable"  class="display table table-striped table-bordered table-hover" cellspacing="0"  width="100%">
        <thead>
        <tr>
            <th>Shopper name</th>
            <th>Product price</th>
            <th>How many</th>
            <th>Bouth date</th>
            <th>Product image</th>
            <th>Actions</th>
        </tr>
        </thead>
            <tfoot>
                <tr>
                    <th>Shopper name</th>
                    <th>Product price</th>
                    <th>How many</th>
                    <th>Bouth date</th>
                    <th>Product image</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        <tbody>
            @foreach($bouthproducts as $key=>$value)
                <tr>
                    <td>{{$value->name}}</td>
                    <td>{{$value->product_price}}$</td>
                    <td>{{$value->count}}</td>
                    <td>{{$value->created_at}}</td>
                    <td><img src="{{URL::asset('/products_images/'.$value->product_image)}}" style="border-radius: 8px" width="150px" height="150px"></td>
                    <td>
                        <a class="btn btn-danger" href="{{url('/'.$language.'/deleteboutproductbystore/'.$value->basket_id)}}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
            @else
            <p style="color: red; font-size: 20px">You havn't bought products</p>
        @endif
    </div>
    </div>
    @if(!$bouthproducts->isEmpty())
    <script>
        $('#mydatatable').DataTable();
    </script>
    @endif
@endsection