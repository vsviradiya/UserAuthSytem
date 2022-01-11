<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <title>Add User</title>
    <style>
        label.error {
             color: #dc3545;
             font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container mt-3"style="display:flex">
                    <div class="float-left">
                        <h3>Add User</h3>
                    </div>
                    <div class="float-right" style="margin-left:520px">
                        <a href="{{ url('home')}}"style="font-weight: 900;" class="create btn btn-info btn-sm" >Back</a>
                    </div>
                </div>
                
                {!! Form::open(['route' => 'insert_user', 'id'=>'usercreateform']  ) !!}
                @include('user_form')
                <input type="hidden" name="subscriptionday">
                <div class="form-group">
                    {!! Form::label('password', 'Confirm Password:', ['class' => 'control-label']) !!}
                    <input type="password" name="password_confirmation" class="form-control" id="cpassword">
                </div>
                
                {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#usercreateform").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required:true,
                        email:true,
                    },

                    password: {
                        required:true,
                        minlength:8,
                    },
                    password_confirmation: {
                        required:true,
                        equalTo: '#password',
                    },
                },
                messages: {
                    name:{
                        required: "Name is required",
                    },
                    email:{
                        required: "Email is required",
                        email: "Please enter vaild email"
                    },
                    password:{
                        required: "Password is required",
                        minlength:"please enter password more than 8 characters",
                    },
                    password_confirmation: {
                        required: "Confirm Password is required",
                        equalTo:"The password and confirmation password do not match"
                    }
                }
            })
        });
    </script>
</body>
</html>