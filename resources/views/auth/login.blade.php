<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login Page | Amaze UI Example</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/png" href="/amaze/i/favicon.png">
    <link rel="stylesheet" href="/amaze/css/amazeui.min.css"/>
    <style>
        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }

        .header p {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="am-g">
        <h1>Web ide</h1>
        <p>Integrated Development Environment<br/>代码编辑，代码生成，界面设计，调试，编译</p>
    </div>
    <hr/>
</div>
<div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">

        <h3>管理员登录</h3>
        <hr>


        @include('Admin.layouts._flash')

        <form class="am-form" role="form" method="POST" action="{{ url('/admin/login') }}">

            {!! csrf_field() !!}
            <label for="email">邮箱:</label>

            <input type="email" class="form-control" name="email" value="{{ old('email') }}">


            <br>
            <label for="password">密码:</label>
            <input type="password" class="form-control" name="password" value="{{ old('password') }}">

            <br>
            <label for="remember-me">
                <input id="remember-me" type="checkbox" name="remember">
                记住密码
            </label>
            <br/>
            <div class="am-cf">
                <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
                <a class="am-btn am-btn-default am-btn-sm am-fr" href="{{ url('/admin/password/reset') }}">忘记密码 ^_^?</a>
            </div>
        </form>
        <hr>
        <p>© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </div>
</div>
</body>
</html>
