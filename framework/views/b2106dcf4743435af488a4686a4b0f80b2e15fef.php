<?php $__env->startSection('content'); ?>
<script src='https://cdn.tiny.cloud/1/jbj33yr8pu29zao4xcpea8ejwxklfygv87xouuthxl8ops5e/tinymce/5/tinymce.min.js'referrerpolicy="origin"></script>
<div class="row product-info">
    <div class="col-lg-7 ">
        <div class="container1">
            <?php $__currentLoopData = json_decode($product['list_image']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mySlides zoom">
                <div class="numbertext hidden-sm"><?php echo e($key+1); ?> / <?php echo e(count(json_decode($product['list_image']))); ?></div>
                <img src="/upload/product/<?php echo e($value); ?>" style="padding: 0.25rem;" />
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
            <div class="row1">
                <?php $__currentLoopData = json_decode($product['list_image']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="column">
                    <img class="demo cursor" src="/upload/product/<?php echo e($value); ?>" onclick="currentSlide(<?php echo e($key1+1); ?>)" />
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-5 product-info-right">
        <div class="title">
            <?php echo e($product['title']); ?>

        </div>
        <div class="price" data-price="<?php echo e($product['price']); ?>">
            <span class="pro-price"><?php echo e(number_format($product['price'],0,'',',')); ?><u class="format_d">đ</u></span>
        </div>
        <div class="size swatch">
          <div class="select-swap-sm">
            <?php if(!empty($variant)): ?>
                <?php $__currentLoopData = $variant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $valsize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($valsize->quality == 0): ?>
                <div class="select-wrap">
                    <div data-value="<?php echo e($valsize->title); ?>" class="n-sd swatch-element">
                        <label for="swatch-0-s" class="checksize soldout" data-value="<?php echo e($valsize->title); ?>">
                            <span><?php echo e($valsize->title); ?></span>
                        </label>
                    </div>
                </div> 
                <?php else: ?>
                <div class="select-wrap">
                    <div data-value="<?php echo e($valsize->title); ?>" class="n-sd swatch-element">
                        <label class="checksize notSoldOut" for="swatch-0-s" data-value="<?php echo e($valsize->title); ?>">
                            <span><?php echo e($valsize->title); ?></span>
                        </label>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            <?php endif; ?>
          </div>
        </div>
        <?php if(!empty($sum)): ?>
            <?php if($sum[0]['qualityProduct'] >= 1): ?>
            <div class="number">
                <span class="minus">-</span><input class="quality" type="text" value="1"/><span class="plus">+</span>
            </div> <?php endif; ?>
         <?php endif; ?>
    
        <div class="wrap-addcart clearfix">
            <?php if(!empty($sum)): ?>
                <?php if($sum[0]['qualityProduct'] == 0): ?>
                    <button type="button" class="button dark btn-addtocart addtocart-modal" name="add">Hết Hàng</button>
                    <?php else: ?>
                    <button type="button" id="add-to-cart" class="add-to-cartProduct button dark btn-addtocart addtocart-modal" name="add" data-id="<?php echo e($product['id']); ?>" data-slug="<?php echo e($product['slug']); ?>" >Thêm vào giỏ</button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="discription clearfix">						
            <?php echo $product->description; ?>

        </div>
    </div>
</div>
<div class="list-productRelated">
  <div class="heading-title text-center">
    <h2>Sản phẩm liên quan</h2>
  </div>
  <div class="content-product-list">
    <?php $__currentLoopData = $productRelated; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="pro-loop">
        <div class="product-block product-resize site-animation">
            <div class="product-img">
                <a href="/products/<?php echo e($value['slug']); ?>" title="<?php echo e($value['title']); ?>" class="image-resize">
                    <img src="/upload/product/<?php echo e($value['image']); ?>" alt=<?php echo e($value['title']); ?>>
                </a>
                <div class="pro-price-mb hidden-sm">
                    <span class="pro-price"><?php echo e(number_format($value['price'],0,'',',')); ?><u class="format_d">đ</u></span>
                </div>
            </div>
            <div class="product-detail clearfix">
                <div class="box-pro-detail">
                    <h3 class="pro-name">
                        <li>
                            <a href="/products/<?php echo e($value['slug']); ?>" title="<?php echo e($value['slug']); ?>">
                                <?php echo e($value['title']); ?>

                            </a>
                         </li>
                    </h3>
                </div>
                <div class="pro-price">
                    <span class="pro-price"><?php echo e(number_format($value['price'],0,'',',')); ?><u class="format_d">đ</u></span>
                </div>
            </div>
            
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<script type="text/javascript" src="<?php echo e(asset('js/zoom/jquery.zoom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/components/product_info.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/product_info.blade.php ENDPATH**/ ?>