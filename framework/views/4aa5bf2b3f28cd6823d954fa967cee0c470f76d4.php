<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d5c2bf0a7a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="<?php echo e(asset('js/select2/dist/js/select2.min.js')); ?>"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
      crossorigin="anonymous"></script>
      <link rel="stylesheet" href="<?php echo e(asset('js/select2/dist/css/select2.min.css')); ?>">
    <title>Đăng Nhập</title> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/components/login.js')); ?>"></script>
    
    <style>
        body,
        html {
            background: url('<?php echo e(asset('./images/1.jpg')); ?>') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .login-box {
            text-align: center;
            width: 360px;
            margin: 7% auto;
        }

        .input-group-text {
            font-size: 1.5rem !important;
        }

        .title-signin {
            font-size: 4rem;
            padding: 20px;
            font-weight: 800;
        }
        .forget_password{
            text-align: -webkit-left;
            
        }
        a{
            text-decoration: none !important;
        }
        button{
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="background_in">
        <div class="login-box">
            <div class="title-signin">Đăng Nhập</div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i> </span>
                </div>
                <input id="user_login" type="text" class="form-control" placeholder="Username" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                </div>
                <input id="password_login" type="password" class="form-control" placeholder="password" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="d-none time-reset">Bạn còn <span class="time-login"></span> để đăng nhập</span>
            </div>
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat btn-login" data-src="<?php echo e($actual_link ?? ''); ?>">Đăng Nhập</button>
                
            </div>
            <div style="margin-top: 15px" class="form-group forget_password "><a href="/login/forget_password">Quên mật khẩu ? </a></div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/admin/login.blade.php ENDPATH**/ ?>