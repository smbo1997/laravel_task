@extends('strorelayouts.storeapp')

@section('storecontent')
    <div class="container">
        <div class="row">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Bank Card!</div><br>
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/addcard') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Card No:</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="cardno" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Exp Month:</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="expmonth" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">CVC No:</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="cvc" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="float: right;">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection