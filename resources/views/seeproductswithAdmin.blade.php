@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="form-group">
                <label for="email" class="col-md-4 control-label">Select shop</label>
                <div class="col-md-6">
                    <select class="form-control adminselectshop">
                        <option value="0"></option>
                        @if(!empty($selectshop))
                            @foreach($selectshop as $key=>$value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div><br><br>

            <div class="form-group">
                <label for="email" class="col-md-4 control-label">Select Type</label>
                <div class="col-md-6">
                    <select class="form-control admintypeselect" disabled="disabled">
                        <option value="noselect"></option>

                    </select>
                </div>
            </div><br><br>


            <table id="mydatatable"  class="display table table-striped table-bordered table-hover mytable" lang="{{$language}}" cellspacing="0"  width="100%">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Content</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Product Name</th>
                    <th>Product Content</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Actions</th>
                </tr>
                </tfoot>

                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <script>
        $('#mydatatable').DataTable();
    </script>
@endsection