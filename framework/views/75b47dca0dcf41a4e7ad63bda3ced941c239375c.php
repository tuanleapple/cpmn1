<?php $__env->startSection('content'); ?>
<div class="breadcrumb">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Lịch sử</li>
    </ol>
</div>
<div class="page-main">
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                Lịch sử
            </div>
        </div>
        <div class="card-body">
            <table id="tableLog" class="table table-resposive table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr class="table-primary">
                    <th></th>
                    <th>Module</th>
                    <th>Người Tạo</th>
                    <th>Message</th>
                    <th>Ngày Tạo</th>
                </tr>
            </thead>
            
            <tbody>
                <?php $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($log->firstItem()+$key); ?></th>
                    <td><?php echo e($value->module); ?></td>
                    <td><?php echo e($value->fullname); ?></td>
                    <td><?php echo e($value->message); ?></td>
                    <td><?php echo e($value->created_at); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end p-e-5 c-b">
            Tổng số log trả về : <?php echo e($log->total()); ?>

         </div>
         <div class="d-flex justify-content-end p-e-5">
             <?php echo e($log->links()); ?>

         </div>
        </div>
    </div>
    <table></table>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/components/log.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/admin/log.blade.php ENDPATH**/ ?>