<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('js/select2/dist/css/select2.min.css')); ?>">
<div class="breadcrumb">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Danh Mục Sản Phẩm</li>
    </ol>
</div>
<div class="page-main">
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                Danh Mục Sản Phẩm
            </div>
            <div class="card-header-right"><button class="btn btn-block btn-primary active" id="createCollection"
                    type="button" aria-pressed="true">
                    <li style="list-style: none"><a href="/admin/collectionProduct/create" style="color:#fff;text-decoration:none" >Tạo Danh Mục </a></li>
                    </button></div>
        </div>
        <div class="card-body">
            <table id="tableCollection" class="table table-resposive table-hover table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr class="table-primary">
                    <th>Số thứ tự</th>
                    <th>Title</th>
                    <th>Đường dẫn link</th>
                    <th>Chức Năng</th>
                </tr>
                <?php $__currentLoopData = $collectionProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($collectionProduct->firstItem() +$key); ?></th>
                    <td><?php echo e($value['title']); ?></td>
                    <td><?php echo e($value['slug']); ?></td>
                    <td><a href="/admin/collectionProduct/edit/<?php echo e($value['id']); ?>"><i class="fas fa-edit icon-table-edit"></i></a>
                        <i class="fas fa-trash-alt icon-table-delete" data-id="<?php echo e($value['id']); ?>" data-title="<?php echo e($value['title']); ?>"></i>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </thead>
            <tbody></tbody>
        </table>
        </div>
       <div class="d-flex justify-content-end p-e-5 c-b">
           <?php echo e($collectionProduct->appends(['sort' => 'votes'])->links()); ?>

        </div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/components/collectionProduct.js')); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('js/select2/dist/js/select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/admin/collectionProduct.blade.php ENDPATH**/ ?>