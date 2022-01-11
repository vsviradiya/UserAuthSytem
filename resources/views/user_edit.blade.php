<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <title>Edit User</title>
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
                        <h3>Edit User</h3>
                    </div>
                    <div class="float-right" style="margin-left:520px">
                        <a href="{{ url('home')}}"style="font-weight: 900;" class="create btn btn-info btn-sm" >Back</a>
                    </div>
                </div>
                
                {!! Form::model($user, ['method' => 'post','route' => ['edit_user', ['id' => $user->id]], 'class'=>'form']) !!}

                @include('user_form')
                
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".form").validate({
                rules: {
                    name: "required",
                    email: "required",
                    password: "required",
                    cpassword: "required",
                },
                messages: {
                    name: "*Name is required",
                    email: "*Email is required",
                    password: "*Password is required",
                    cpassword: "*Confirm password is required",
                }
            })
        });
    </script>
    
</body>
</html>