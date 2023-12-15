<?php $__env->startSection('content'); ?>
<div class="breadcrumb">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Bill Other</li>
    </ol>
</div>
<div class="page-main">
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                Bill Other
            </div>
        </div>
        <div class="card-body">
            <table id="tableLog" class="table table-resposive table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr class="table-primary">
                    <th></th>
                    <th>Tên</th>
                    <th>Thanh Toán</th>
                    <th>Tổng Cộng</th>
                    <th>Thành Tiền</th>
                    <th>Ghi Chú</th>
                    <th>Địa Chỉ</th>
                    <th>Trạng Thái</th>
                    <th>Người Tạo</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            
            <tbody>
                <?php $__currentLoopData = $other; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($other->firstItem()+$key); ?></th>
                    <td><?php echo e($value->customer_name); ?></td>
                    <td><?php echo e($value->payment_method); ?></td>
                    <td><?php echo e(number_format($value->sum_price,0,'',',')); ?> <u>vnd</u></td>
                    <td><?php echo e(number_format($value->total_price,0,'',',')); ?> <u>vnd</u></td>
                    <td><?php echo e($value->note); ?></td>
                    <td><?php echo e($value->info); ?>, <?php echo e($value->wardName); ?>, <?php echo e($value->districtName); ?>, <?php echo e($value->cityName); ?></td>
                    <td><?php echo e($value->status); ?></td>
                    <td><?php echo e($value->created_at); ?></td>
                    <td><i class="fas fa-toggle-on icon-table-edit" data-id="<?php echo e($value->id); ?>"></i>
                        <i class="fas fa-eye icon-table-view" data-id="<?php echo e($value->id); ?>"></i>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end p-e-5 c-b">
            Tổng số log trả về : <?php echo e($other->total()); ?>

         </div>
         <div class="d-flex justify-content-end p-e-5">
             <?php echo e($other->links()); ?>

         </div>
        </div>
    </div>
    <table></table>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/components/billLog.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/admin/billLog.blade.php ENDPATH**/ ?>