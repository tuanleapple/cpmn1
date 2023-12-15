<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="John Le">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="description" content="Free Web tutorials for HTML and CSS">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Angle and Devil store">
    <meta property="og:image:secure_url" content="https://theme.hstatic.net/1000351433/1000669365/14/share_fb_home.png?v=320">
    <meta property="og:image" content="http://theme.hstatic.net/1000351433/1000669365/14/share_fb_home.png?v=320">
    <meta property="og:description" content="Tất cả sản phẩm">
    <meta property="og:site_name" content="Angle and Devil store">
    <script src="https://kit.fontawesome.com/d5c2bf0a7a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/home.css')); ?>" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <title>Angle and Devil</title>
    <link rel="shortcut icon" href="https://zingnews.vn/favicon/v003/favicon_48x48.ico" />
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/components/frontend/newCollection.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/loginClient.css')); ?>" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/mammoth@1.4.9/mammoth.browser.min.js"></script>
</head>

<body>
    <div class="main-body">
        <div class="nav-main">
            <div class="main">
                <div class="zing-content">
                        <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
        <?php echo $__env->yieldPushContent('scripts'); ?>
      
    </div>
    <div class="site-nav style--sidebar">
        <div id="site-seach" class="site-container-moblie hidden-sm">
            <div class="container-seach">
                <div class="site-title-seach">Tìm kiếm</div>
                <button type="button" class="site-exit" id="site-exit" class="site-exit" data-type="1">x</button>
            </div>
            <div class="site-nav-seach">
                <input type="text" id="keyword" class="search-auto" placeholder="Tìm Kiếm Sản Phẩm ..">
                <p class="mb-0" onclick=""><i class="fas fa-search"></i></p>
            </div>
            <div class="result-sreach">
            </div>
        </div>
        <div id="site-cart" class="site-container-moblie s hidden-sm">
            <div class="container-seach">
                <div class="site-title-seach">GIỎ HÀNG</div>
                <button type="button" class="site-exit" id="site-exit" class="site-exit" data-type="2">x</button>
            </div>
            <div class="cart-view clearfix">
                <div class="cart-product">
                    <?php if(!empty($cart)): ?>
                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valueCart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <table id="cart-view" class="table text-center border-table cart_<?php echo e($valueCart['id']); ?>"><tbody><tr class="item_2">
                                <td class="img"><a href="/products/<?php echo e($valueCart['slug']); ?>" title="/products/<?php echo e($valueCart['slug']); ?>"><img src="/upload/product/<?php echo e($valueCart['image']); ?>" alt="/products/<?php echo e($valueCart['slug']); ?>"></a></td>
                                <td class="table-product-p">
                                    <a class="pro-title-view" href="/products/<?php echo e($valueCart['slug']); ?>" title="/products/<?php echo e($valueCart['slug']); ?>"><?php echo e($valueCart['title']); ?></a>
                                    <span class="variant"><?php echo e($valueCart['size']); ?></span>	
                                    <span class="pro-quantity-view"><?php echo e($valueCart['quality']); ?></span>
                                    <span class="pro-price-view" data-price="<?php echo e($valueCart['price']); ?>"><?php echo e(number_format($valueCart['price'],0,'',',')); ?><u class="format_d">đ</u></span>
                                    <span class="remove_link remove-cart"><a onclick="deleteCart(<?php echo e($valueCart['id']); ?>)" ><i class="fa fa-times"></i></a></span>				
                                </td>
                            </tr></tbody></table>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                </div>
                <table id="cart-view" class="table text-center border-table"><tbody><tr class="item_2">
                    <td class="table-product-p">
                        Hiện Tại Chưa Có Sản Phẩm
                    </td>
                </tr></tbody></table> 
                <?php endif; ?>
				<span class="line"></span>
				<table class="table-total table border-table">
					<tbody><tr>
						<td class="text-left">TỔNG TIỀN:</td>
						<td class="text-right" id="total-view-cart"></td>
					</tr>
					<tr>
						<td><a href="/cart" class="linktocart button dark">Xem giỏ hàng</a></td>
						<td><a href="/checkouts" class="linktocheckout button dark">Thanh toán</a></td>
					</tr>
				</tbody></table>
			</div>
        </div>
    </div>
    </div>
    <div id="site-overlay" class="site-overlay"></div>
</body>

</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/home.blade.php ENDPATH**/ ?>