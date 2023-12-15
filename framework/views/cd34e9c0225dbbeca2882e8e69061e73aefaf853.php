<?php $__env->startSection('content'); ?>
<div id="__next">
    <div class="signUp">
        <div class="price"><img alt="truong bach khoa hcm" fetchpriority="high" width="22" height="22" decoding="async" data-nimg="1" class="logo-image" style="color:transparent" src="/images/vector.svg">
            <div class="price-font">100</div><img alt="truong bach khoa hcm" fetchpriority="high" width="18" height="18" decoding="async" data-nimg="1" class="logo-image" style="color:transparent" src="/images/vector-plus.svg">
        </div>
        <div class="price-2"><img alt="truong bach khoa hcm" fetchpriority="high" width="22" height="22" decoding="async" data-nimg="1" class="logo-image" style="color:transparent" src="/images/vectoc.svg">
            <div class="price-font">100</div><img alt="truong bach khoa hcm" fetchpriority="high" width="18" height="18" decoding="async" data-nimg="1" class="logo-image" style="color:transparent" src="/images/vector-plus.svg">
        </div><img alt="truong bach khoa hcm" fetchpriority="high" width="18" height="21" decoding="async" data-nimg="1" class="logo-notifation" style="color:transparent" src="/images/vector-no.svg">
        <div class="text-signup">Đăng Xuất</div>
    </div>
    <div class="main-header">
        <div class="logo-header"><img alt="truong bach khoa hcm" fetchpriority="high" width="122" height="122" decoding="async" data-nimg="1" class="logo-image" style="color:transparent" src="/images/logoheader.svg"><img alt="truong bach khoa hcm" fetchpriority="high" width="473" height="51" decoding="async" data-nimg="1" class="logo-image" style="color:transparent" src="/images/logoText.svg"><img alt="truong bach khoa hcm" fetchpriority="high" width="122" height="122" decoding="async" data-nimg="1" class="logo-people" style="color:transparent" src="/images/people.svg"></div>
    </div>
    <div class="menu-parent">
        <ul class="menu">
            <li class="nav-links px-4 cursor-pointer capitalize font-medium text-gray-500 hover:scale-105 hover:text-white duration-200 link-underline">
                <div></div><a href="/history">Lịch Sử</a>
            </li>
        </ul>
    </div>
    <input type="file" onchange="parseWordDocxFile(this)">
    <button type="button" onclick="postFile()">Upload</button>
  <div style="margin:10px 0px; padding:20px; border:1px solid #ddd;">
    <h3>convertToHtml</h3>
    <div id="result1"></div>
  </div>
    <div class="ct-page">
        <div class="title">LỊCH SỬ IN</div>
        <div class="card-body">
            <table id="tableCollection" class="table table-resposive table-hover table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr class="table-primary">
                    <th>Mã số máy</th>
                    <th>Tên thơ mục</th>
                    <th>Số tờ</th>
                    <th>Số copy</th>
                    <th>Máy In</th>
                    <th>Loại giấy</th>
                    <th>nhập xét</th>
                    <th>Hồ sơ mã số</th>
                    <th>Ngày nhâp</th>
                </tr>
                <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                    <td><?php echo e($value['factory_number']); ?></td>
                    <td><?php echo e($value['name_file']); ?></td>
                    <td><?php echo e($value['paper']); ?></td>
                    <td><?php echo e($value['copy']); ?></td>
                    <td><?php echo e($value['printer']); ?></td>
                    <td><?php echo e($value['kind_paper']); ?></td>
                    <td><?php echo e($value['comment']); ?></td>
                    <td><?php echo e($value['profile_code']); ?></td>
                    <td><?php echo e($value['date']); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </thead>
            <tbody></tbody>
        </table>
        </div>
        <div class="d-flex justify-content-end p-e-5 c-b">
        </div>
        <div class="d-flex justify-content-end p-e-5">
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/components/frontend/login.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/main.blade.php ENDPATH**/ ?>