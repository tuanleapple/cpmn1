<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('js/select2/dist/css/select2.min.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('js/components/productCreate.js')); ?>"></script>
<div class="breadcrumb">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item">Edit Product</li>
    </ol>
</div>
<div class="page-main-create">
    <div class="card">
        <div class="card-header">
            <div class="card-header-left-item">
                Edit Product
            </div>
            <div class="card-header-right-item">
                <button class="btn btn-block btn-primary active" id="editCollectionProduct" data-id=<?php echo e($product['id']); ?> type="button"
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
                    <input type="text" class="form-control"name="title" id="title" value="<?php echo e($product['title']); ?>" />
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label  class="col-sm-2 col-form-label">Collection</label>
                <div class="col-sm-10">
                    <select id="selectCollection" name="selectCollection">
                        <option value="-1">Please choose parent collecion ...</option>
                        <?php $__currentLoopData = $collectionProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($value['id'] == $product['collection_id']): ?>
                                <option value=<?php echo e($value['id']); ?> selected><?php echo e($value['title']); ?></option>
                            <?php else: ?>
                                <option value=<?php echo e($value['id']); ?>><?php echo e($value['title']); ?></option>
                            <?php endif; ?>
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
                        <?php $__currentLoopData = json_decode($product['list_image']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-getImage=<?php echo e($value); ?>><a class="image_a_upload">
                                <img src="/upload/product/<?php echo e($value); ?>" style="padding: 0.25rem;"/></a><i class="fas fa-times item-icon" data-image=<?php echo e($value); ?>></i>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea type="text" id="description" class="form-control" rows="6" cols="50" value="<?php echo e($product['description']); ?>"><?php echo e($product['description']); ?></textarea>
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <select id="selectGender" name="selectGender">
                        <option value="-1" checked>Please choose gender ...</option>
                        <?php $__currentLoopData = $gender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($value['id'] == $product['product_gender']): ?>
                                <option value=<?php echo e($value['id']); ?> selected><?php echo e($value['title']); ?></option>
                            <?php else: ?>
                                <option value=<?php echo e($value['id']); ?>><?php echo e($value['title']); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
        
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Size</label>
                <div class="col-sm-9">
                    <select id="selectSize" name="selectSize">
                        <option value="-1" selected disabled>Please choose size ...</option>
                        <?php if(!empty($optionCheck)): ?>
                            <?php echo $optionCheck; ?>

                        <?php else: ?>
                            <?php if(!empty($size)): ?>
                            <?php $__currentLoopData = $size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value=<?php echo e($value['id']); ?> data-size="<?php echo e($value['title']); ?>"><?php echo e($value['title']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-sm-1"><button type="button" class="btn btn-block btn-dart " id="plus-size" type="button" aria-pressed="true"><i class="fas fa-plus"></i></button></div>
              </div>
              <?php if(!empty($variant)): ?>
                <div class="form-group row m-g-1 attribute-size">
                    <label class="col-sm-2 col-form-label attribute-title">
                        <span>Các Size Đã Chọn : </span>
                        <?php $__currentLoopData = $variant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="attribute-<?php echo e($value['title']); ?> span-attribute" ><?php echo e($value['title']); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </label>
                    <div class="col-sm-10 attribute-size-info">
                        <div class="row attribute-size-info-row">
                            <div class="col-sm-2 size">Size </div><div class="col-sm-10 quality-size"> Số Lượng</div>
                            <?php $__currentLoopData = $variant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="attribute-info-<?php echo e($value['title']); ?> atribute-info-css"><div class="row"><div class="col-sm-2"><label><?php echo e($value['title']); ?></label></div><div class="col-sm-8"><input class="input-size-quality" placeholder="Vui Lòng nhập số lượng của size tương ứng " value="<?php echo e($value['quality']); ?>" data-size-attribute="<?php echo e($value['id']); ?>"/></div><div class=" col-sm-2 delete-icon" data-delete-size="<?php echo e($value['title']); ?>" data-variant="<?php echo e($value['id']); ?>" data-id="<?php echo e($value['attribute_id']); ?>"><i class="fas fa-trash-alt"></i></div></div></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
              <?php else: ?>
                <div class="form-group row m-g-1 attribute-size d-none">
                    <label class="col-sm-2 col-form-label attribute-title">
                        <span>Các Size Đã Chọn : </span>
                    </label>
                    <div class="col-sm-10 attribute-size-info">
                        <div class="row attribute-size-info-row"></div>
                    </div>
                </div>
              <?php endif; ?>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Price (vnd)</label>
                <div class="col-sm-10">
                    <input type="text" id="price" class="form-control" value="<?php echo e($product['price']); ?>"/>
                </div>
              </div>
        
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Display</label>
                <div class="col-sm-10">
                    <?php if($product['display'] == 1): ?>
                        <input class="form-check-input" type="checkbox" value="" id="checkdisplay" checked>
                    <?php else: ?>
                        <input class="form-check-input" type="checkbox" value="" id="checkdisplay">
                    <?php endif; ?>   
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">Highlights</label>
                <div class="col-sm-10">
                    <?php if($product['highlights'] == 1): ?>
                    <input class="form-check-input" type="checkbox" value="" id="checkhighlight" checked>
                    <?php else: ?>
                        <input class="form-check-input" type="checkbox" value="" id="checkhighlight" >
                    <?php endif; ?> 
                </div>
              </div>
              <div class="form-group row m-g-1">
                <label class="col-sm-2 col-form-label">meta-title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control meta-title"name="meta-title" value=<?php echo e($product['meta_title']); ?>>
                </div>
            </div>
              <div class="form-group row m-g-1">
                <div class="button-card">
                    <button class="btn btn-block btn-primary active" id="editCollectionProduct" data-id=<?php echo e($product['id']); ?> type="button"
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

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/admin/editProduct.blade.php ENDPATH**/ ?>