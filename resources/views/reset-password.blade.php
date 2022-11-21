<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <title>{{ $data['title'] }}</title>
</head>
<body>
    <h1>{{ $data['title'] }}</h1>
    <div class="container">
        <div class="card">
            <h3 class="text-center">UTM password reset</h3><br>
            <p>
                We heard that you lost your UTM password. Sorry about that!
            </p>
            <p>
                But don`t worry! You can use the following button to reset your password:
            </p>
            <a href="{{ $data['url'] }}"><button type="button" class="btn btn-success">Reset your password</button></a><br>
            <p>
                if you don`t use this link, it will expire. To get a new password reset link, visit: 
                <a href="/forgot_password">forgot password</a>  
            </p>
            <p>Thanks,</p>
            <p>The UTM Team</p>
        </div>
    </div>
    {{-- <p>Your ID {{ $data['id'] }}.</p> --}}
</body>
</html>