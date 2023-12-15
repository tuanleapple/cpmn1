<?php $__env->startSection('content'); ?>
<div class="breadcrumb">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Product</li>
    </ol>
</div>
<div class="page-main">
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <span>Product</span>
                <form action="<?php echo e(route('seacher')); ?>" method="GET">
                    <div class="input-group mb-3">
                      <?php if(!empty($type)): ?>
                      <input type="text" class="form-control" placeholder="Nhập tên sản phẩm cần tìm " aria-describedby="basic-addon2" name="search" value="<?php echo e($type); ?>">
                      <?php else: ?>
                      <input type="text" class="form-control" placeholder="Nhập tên sản phẩm cần tìm " aria-describedby="basic-addon2" name="search">
                      <?php endif; ?>
                    <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"> Tìm Kiếm </button>
                    </div>
                    </div>
                    </form>
            </div>
            <div class="card-header-right"><button class="btn btn-block btn-primary active" id="createCollection"
                type="button" aria-pressed="true">
                <li style="list-style: none"><a href="/admin/product/create" style="color:#fff;text-decoration:none" >Create Product </a></li>
                </button></div>
        </div>
        <div class="card-body">
            <table id="tableLog" class="table table-resposive table-striped table-bordered text-center l-heght">
            <thead class="thead-dark">
                <tr class="table-primary">
                    <th></th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Price</th>
                    <th>Quality</th>
                    <th>Display</th>
                    <th>Highlights</th>
                    <th>Create</th>
                    <th>Tools</th>
                </tr>
            </thead>
            
            <tbody>
   
                <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($product->firstItem() +$key); ?></th>
                    <td>
                        <?php if(strlen($value->image) != 0): ?>
                            <a class="img_table"><img src="/upload/product/<?php echo e($value->image); ?>" alt=<?php echo e($value->image); ?>></a>
                        <?php else: ?>
                            <a class="img_table"><img src="/images/default_image.png" alt='No Image'></a>
                        <?php endif; ?>
                       
                    </td>
                    <td><?php echo e($value->title); ?></td>
                    <td><?php echo e($value->slug); ?></td>
                    <td><?php echo e($value->price); ?></td>
                    <td><?php echo e($value->qualityProduct); ?></td>
                    <td>
                        <?php if($value->display == 1): ?>
                        <input class="form-check-input" type="checkbox" onclick="checkDisplay(<?php echo e($value->id); ?>)" name="display"  checked>
                        <?php else: ?>
                            <input class="form-check-input" type="checkbox" onclick="checkDisplay(<?php echo e($value->id); ?>)"  name="display">
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($value->highlights == 1): ?>
                            <input class="form-check-input" type="checkbox" onclick="checkHighlight(<?php echo e($value->id); ?>)" name="highlights"  checked>
                        <?php else: ?>
                            <input class="form-check-input" type="checkbox" onclick="checkHighlight(<?php echo e($value->id); ?>)" name="highlights" >
                        <?php endif; ?>
                    </td>
                  
                     <td><?php echo e($value->created_at); ?></td>
                    <td><a href="/admin/product/edit/<?php echo e($value->id); ?>"><i class="fas fa-edit icon-table-edit"></i></a>
                        <i class="fas fa-trash-alt icon-table-delete" data-id="<?php echo e($value->id); ?>" data-title="<?php echo e($value->title); ?>"></i>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end p-e-5 c-b">
            Tổng số product trả về : <?php echo e($product->total()); ?>

         </div>
         <div class="d-flex justify-content-end p-e-5">
             <?php echo e($product->links()); ?>

         </div>
        </div>
    </div>
    <table></table>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('js/components/product.js')); ?>"></script>
<script type="text/javascript">
    function checkDisplay(e){
        if(e){
            let data = {};
            data.id = e;
            data.type = $('input[name="display"]:checkbox:not(":checked")').length;
            if(data.type == 2){
                data.type =0;
            }
            $.ajax({
            type: 'POST',
            url: '/admin/product/changeDisplay',
            data: data,
            cache: false,
            success: function (data) {
                if (data.data == 1) {
                    swal('Change display', 'Change Display', 'success');
                }
            },
            });
        }
    }

    function checkHighlight(e){
        let data = {};
            data.id = e;
            data.type = $('input[name="highlights"]:checkbox:not(":checked")').length;
            if(data.type == 2){
                data.type =1;
            }else{
                data.type =0;
            }
            $.ajax({
            type: 'POST',
            url: '/admin/product/changeHighlight',
            data: data,
            cache: false,
            success: function (data) {
                if (data.data == 1) {
                    swal('Change Highlight', 'Change Highlight', 'success');
                }
            },
            });
        
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/admin/product.blade.php ENDPATH**/ ?>