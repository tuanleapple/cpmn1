<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title>Admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>" type="text/css">
    <script src="https://kit.fontawesome.com/d5c2bf0a7a.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script src='https://cdn.tiny.cloud/1/jbj33yr8pu29zao4xcpea8ejwxklfygv87xouuthxl8ops5e/tinymce/5/tinymce.min.js'
        referrerpolicy="origin"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/components/dashboard.js')); ?>"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body>
    <header id="page-topbar">
        <div class="header">
            <div class="header-left">
                <a href="#" class="logo-header"><img src="<?php echo e(asset('/upload/admin/logo.png')); ?>" alt="">
                    <p class="title-hearder">DEVIL</p>
                </a>
            </div>
            <div class="header-right">
                <div class="site-header-right">
                    <div class="site-header-menu-left">
                        <li class="menu menu-click" id="menu-hidden">
                            <i class="fas fa-align-justify"></i>
                        </li>
                        <div class="site-nav-seach">
                            <input type="text" id="keyword" class="search-auto" placeholder="Search ..."
                                onkeypress="doEnter(event,'keyword');">
                            <p class="mb-0" onclick="onSearch('keyword');"><i class="fas fa-search"></i></p>
                        </div>
                    </div>
                    <div class="site-header-menu-right">
                        <div class="right-menu">
                            <div class="people-logo">
                                <i class="fas fa-bell"></i>
                                <i class="fas fa-list-ul"></i>
                                <i class="far fa-envelope"></i>
                                <img src="<?php echo e(asset('images/1.jpg')); ?>" alt="user_image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="nav-main">
        <div class="nav-left">
            <div class="menu-left">
                    <?php if(session('user.role') == 1): ?>
                    <li class="menu-item">
                        <a href="/admin/collection"><span><i class="fas fa-tachometer-alt"></i></span><span class="title_nav_left">Dashboard</span></a>
                    </li> 
                    <li class="menu-item">
                        <a href="/admin/user"><span><i class="fas fa-user-plus item"></i></span><span class="title_nav_left">User</span></a>
                    </li>
                    <li class="menu-item">
                        <a href="/admin/setting"><span><i class="fas fa-cogs"></i></span><span class="title_nav_left">Setting</span></a>
                    </li>
                    <?php endif; ?>
                    <li class="menu-item">
                        <a href="/admin/collection"><span><i class="fas fa-ethernet"></span></i><span class="title_nav_left">Menu</span></a>
                    </li>
                    
                    <li class="menu-item">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
                        <a href="/admin/collectionProduct"><span><i class="far fa-calendar-minus"></i></span><span class="title_nav_left">Collection Product</span></a>
                    </li>
                    <li class="menu-item">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
                        <a href="/admin/product"><span><i class="fas fa-dolly-flatbed"></i></span><span class="title_nav_left">Product</span></a>
                    </li>
                    
                    
                    
                    <li class="menu-item">
                        <a href="/admin/log"><span><i class="fas fa-clock item"></i></span><span class="title_nav_left">History</span></a>
                    </li>
                    <li class="menu-item">
                        <a href="/admin/billLog"><span><i class="fas fa-wallet"></i></span><span class="title_nav_left">Bill Log</span></a>
                    </li>
                   
            </div>
        </div>
        
    </div>
    <div class="main-content">
        <div class="main">
            <div class="zing-content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/admin/layout.blade.php ENDPATH**/ ?>