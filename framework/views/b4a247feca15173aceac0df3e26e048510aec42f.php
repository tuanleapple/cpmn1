<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('js/select2/dist/css/select2.min.css')); ?>">
<div class="breadcrumb">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item">Create Product</li>
    </ol>
</div>
<div class="page-main-create">
    <div class="card">
        <div class="card-header">
            <div class="card-header-left-item">
                Create Product
            </div>
            <div class="card-header-right-item">
                <button class="btn btn-block btn-primary active" id="createCollectionProduct" type="button"
                    aria-pressed="true">
                    <li style="list-style: none"><a style="color:#fff;text-decoration:none" >Lưu</a></li>
                </button>
                <button class="btn btn-block btn-primary active" type="button"
                    aria-pressed="true">
                    <li style="list-style: none"><a style="color:#fff;text-decoration:none;" href="/admin/product">Huỷ</a></li>
                </button>
            </div>
        </div>
        <div class="card-body">
             <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Title<span><strong style="color:red"> *</strong></span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"name="title" id="title">
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label  class="col-sm-2 col-form-label">Collection</label>
                <div class="col-sm-10">
                    <select id="selectCollection" name="selectCollection">
                        <option value="-1" checked>Please choose parent collecion ...</option>
                        <?php $__currentLoopData = $collectionProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value=<?php echo e($value['id']); ?>><?php echo e($value['title']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Image<span></label>
                <div class="col-sm-10">
                    <form class="form-feature-product" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input class="form-control" type="file" name="images[]" multiple/>
                    </form>
                    <div class="image_upload">
                    </div>
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea type="text" id="description" class="form-control" rows="6" cols="50"></textarea>
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <select id="selectGender" name="selectGender">
                        <option value="-1" checked>Please choose gender ...</option>
                        <?php $__currentLoopData = $gender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value=<?php echo e($value['id']); ?>><?php echo e($value['title']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
        
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Size</label>
                <div class="col-sm-9">
                    <select id="selectSize" name="selectSize">
                        <option value="-1" checked>Please choose size ...</option>
                        <?php $__currentLoopData = $size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value=<?php echo e($value['id']); ?> data-size="<?php echo e($value['title']); ?>"><?php echo e($value['title']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-1"><button type="button" class="btn btn-block btn-dart " id="plus-size" type="button" aria-pressed="true"><i class="fas fa-plus"></i></button></div>
              </div>
              <div class="form-group row m-g-1 attribute-size d-none">
                <label class="col-sm-2 col-form-label attribute-title">
                    <span>Các Size Đã Chọn : </span>
                 </label>
                <div class="col-sm-10 attribute-size-info">
                    <div class="row attribute-size-info-row"></div>
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Price (vnd)</label>
                <div class="col-sm-10">
                    <input type="number" id="price" class="form-control"/>
                </div>
              </div>
             
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Display</label>
                <div class="col-sm-10">
                    <input class="form-check-input" type="checkbox" value="" id="checkdisplay">
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Highlights</label>
                <div class="col-sm-10">
                    <input class="form-check-input" type="checkbox" value="" id="checkhighlight">
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">meta-title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control meta-title"name="meta-title" >
                </div>
            </div>
              <div class="form-group row m-g-1">
                <div class="button-card">
                    <button class="btn btn-block btn-primary active" id="createCollectionProduct" type="button"
                        aria-pressed="true">
                        <li style="list-style: none"><a style="color:#fff;text-decoration:none" >Lưu</a></li>
                    </button>
                    <button class="btn btn-block btn-primary active" type="button"
                        aria-pressed="true">
                        <li style="list-style: none"><a style="color:#fff;text-decoration:none;" href="/admin/product">Huỷ</a></li>
                    </button>
                </div>
              </div>
        </div>
    </div>
</div>
<div class="modal fade" id="SizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo Size</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row m-b-2">
                      <label class="col-sm-2 col-form-label">Thuộc tính Size</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="titleSize" placeholder="Thuộc tính Size">
                      </div>
                    </div>
                  </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalSize">Đóng</button>
                <button type="button" class="btn btn-primary"id="saveModalSize" >Lưu</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/select2/dist/js/select2.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('js/components/productCreate.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/admin/createProduct.blade.php ENDPATH**/ ?>