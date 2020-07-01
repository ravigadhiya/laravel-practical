@extends('layouts.app')


@section('content')
    <div class="row">
        <!-- form start -->
        <!-- left column -->
        <div class="col-md-12">
            @if(Session::has('message'))
                <div class="alert {{ Session::get('class') }} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>{!! Session::get('message') !!}</h4>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- general form elements -->
            <div class="box box-primary col-md-9">
                <form role="form" action="" method="post" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">

                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">User name</label>
                            <input class="form-control" name="name" id="inputTitle" data-validation="required" value="" placeholder="Enter name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="intro-text">First Name</label>
                            <input class="form-control" name="first_name" id="first_name" value="" placeholder="Enter Firstname" type="text">
                        </div>
						
						 <div class="form-group">
                            <label for="intro-text">Last Name</label>
                            <input class="form-control" name="last_name" id="last_name" value="" placeholder="Enter Lastname" type="text">
                        </div>
						
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input name="image" type="file" />
                        </div>
                        <div class="form-group">
                            <label>User Email id</label>
                            <input class="form-control" name="email" data-validation="email" value="" placeholder="Enter email id" type="text">
                        </div>
                        <div class="form-group">
                            <label>User Password</label>
                            <input class="form-control" name="password_confirmation" value=""  data-validation="strength" data-validation-strength="2" placeholder="Enter password" type="password">
                            <input class="form-control" name="role_id" value="1" type="hidden">
                        </div>
                        <div class="form-group">
                            <label>Password Confirm</label>
                            <input class="form-control" name="password"  data-validation="confirmation" placeholder="Enter confirm password" type="password">
                        </div>



                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Publish</button>
                </div>
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
        <!--/.col (left) -->

    </div>
@stop
