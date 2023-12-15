<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('js/select2/dist/css/select2.min.css')); ?>">
<div class="breadcrumb">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Danh Mục</li>
    </ol>
</div>
<div class="page-main">
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                Danh Mục
            </div>
            <div class="card-header-right"><button class="btn btn-block btn-primary active" id="createCollection"
                    type="button" aria-pressed="true">
                    <li style="list-style: none"><a style="color:#fff;text-decoration:none" >Tạo Danh Mục </a></li>
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
                <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($collection->firstItem()+$key); ?></th>
                        <td><?php echo e($value['title']); ?></td>
                        <td><?php echo e($value['slug']); ?></td>
                        <td><i class="fas fa-edit icon-table-edit" data-id=<?php echo e($value['id']); ?> data-title="<?php echo e($value['title']); ?>" data-des="<?php echo e($value['description']); ?>" data-parent="<?php echo e($value['parent_id']); ?>"></i>
                            <i class="fas fa-trash-alt icon-table-delete" data-id="<?php echo e($value['id']); ?>" data-title="<?php echo e($value['title']); ?>"></i>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </thead>
            <tbody></tbody>
        </table>
        </div>
        <div class="d-flex justify-content-end p-e-5 c-b">
           Tổng số danh mục trả về : <?php echo e($collection->total()); ?>

        </div>
        <div class="d-flex justify-content-end p-e-5">
            <?php echo e($collection->links("pagination::bootstrap-4")); ?>

        </div>
    </div>
    
</div>
<div class="modal fade" id="collectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo Danh Mục</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row m-b-2">
                      <label class="col-sm-2 col-form-label">Tiêu Đề</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="titleCollection" placeholder="Vui lòng Nhập Tiêu Đề">
                      </div>
                    </div>
                    <div class="form-group row m-b-2">
                      <label  class="col-sm-2 col-form-label">Mô Tả</label>
                      <div class="col-sm-10">
                         <textarea rows="5" cols="50" type="text" class="form-control" id="desCollection" placeholder="Vui lòng Nhập Mô Tả"></textarea>
                      </div>
                    </div>
                    <div class="form-group row m-b-2">
                        <label  class="col-sm-2 col-form-label">Danh Mục Cha</label>
                        <div class="col-sm-10">
                          
                            <select class="selectCollection" name="selectCollection">
                                <option value="-1">Vui lòng chọn danh mục cha</option>
                            </select>
                        </div>
                    </div>
                  </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalCollection">Đóng</button>
                <button type="button" class="btn btn-primary"id="saveModalCollection" >Lưu</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/javascript" src="<?php echo e(asset('js/components/collection.js')); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('js/select2/dist/js/select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/admin/collection.blade.php ENDPATH**/ ?>