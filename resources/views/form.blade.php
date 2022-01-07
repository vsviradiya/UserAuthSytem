<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
         echo Form::open(array('url' => '/home'));
         
            echo Form::label('name', 'Name:');
            echo Form::text('name ','enter your name');
            echo '<br/>';
            echo '<br/>';

            echo Form::label('email', 'Email:');
            echo Form::text('email', 'enter your email address');
            echo '<br/>';
            echo '<br/>';
     
            echo Form::label('password', 'password:');
            echo Form::password('password');
            echo '<br/>';
            echo '<br/>';
            
            echo Form::submit('create');
         echo Form::close();
      ?>
    
</body>
</html>