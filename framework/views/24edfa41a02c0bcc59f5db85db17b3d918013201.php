<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/user.css')); ?>" type="text/css">
<section class="smb_section">
    <div class="wrapper_smb">
        <div class="gird_smb">
            <div class="grid__item_smb grid__item_smb_25">
                <div class="AccountSidebar">
                    <div class="title_account">
                        <div class="title_account_img">
                            <?php if(!empty($checkUser[0]['image'])): ?>
                            <span id="logo_user" style="display: contents;"><img src="/images/<?php echo e($checkUser[0]['image']); ?>" alt="user image"></span>
                            <?php else: ?>
                            <span id="logo_user" style="background-image: url('<?php echo e(asset('./images/1.jpg')); ?>') ; display: block;"></span>
                            <?php endif; ?>
                        </div>
                        <div class="content_account">
                            <h2 class="name_account"><?php echo e($checkUser[0]['fullname']); ?></h2>
                            <p>
                                <?php echo e($checkUser[0]['email']); ?>

                            </p>
                        </div>
                    </div>
                    <div class="AccountContent">
                        <div class="account_list">
                            <ul class="list-unstyled">
                                <li class="current">
                                    <a href="/account/view=account_info.smb">
                                        <span>
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span>
                                            Hồ sơ của tôi
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/account/view=order.smb">
                                        <span>
                                            <i class="fas fa-file-invoice"></i>
                                        </span>
                                        <span>
                                            Đơn hàng của tôi
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="/account/view=addresses.smb">
                                        <span> <i class="fas fa-map-marker-alt"></i></span>
                                        <span> Sổ địa chỉ</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/account/view=vouchers.smb">
                                        <span> <i class="fas fa-tags"></i></span>
                                        <span> Vouchers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/account/view=reset_password.smb">
                                        <span><i class="fas fa-lock"></i></span>
                                        <span>Đổi mật khẩu</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('ul.list-unstyled li').click(function() {
                            $('li').removeClass("active");
                            $(this).addClass("active");
                        });
                    });
                </script>
            </div>
            <div class="grid__item_smb grid__item_smb_75">
                <div class="accounts">
                    <div class="accounts_title">
                        <h2>
                            Hồ sơ của tôi
                        </h2>
                        <p class="update_info_err">
                            * Cập nhật thông tin lỗi, vui lòng thử lại
                        </p>
                        <p class="data_error">* Có lỗi vui lòng thử lại, hoặc đăng nhập lại</p>
                    </div>
                    <div class="accounts_main">
                        <div class="account">
                            <div class="image_loading" style="display: none;">
                                <img src="https://file.hstatic.net/1000187248/file/spinner_6dbec68bd28a42718f17704bf42d58e7.gif" alt="image loading">
                            </div>
                            <div class="account_col">
                                <div class="account_main">
                                    <label>Họ và tên</label>
                                    <span class="error_input">* Họ và tên quá dài</span>
                                    <input id="fullName" type="text" name="edit" placeholder="Nhập tên đầy đủ của bạn" value="<?php echo e($checkUser[0]['fullname']); ?>" >
                                </div>
                            </div>

                            <div class="account_col">
                                <div class="account_main">
                                    <label>Email</label>
                                    <span class="error_input">* Email không hợp lệ</span>
                                    <input id="email" type="text" placeholder="Nhập Email của bạn" value="<?php echo e($checkUser[0]['email']); ?>" >
                                </div>
                            </div>

                            <div class="account_col">
                                <div class="account_main">
                                    <label>Số điện thoại</label>
                                    <span class="error_input"></span>
                                    <input id="phoneNumber" name="edit" type="text" placeholder="<?php echo e($checkUser[0]['tax']); ?>" value="<?php echo e($checkUser[0]['tax']); ?>" >
                                </div>
                            </div>
                            <div class="account_col account_col_seeq">
                                <div class="account_main">
                                    <label>Ngày sinh</label>
                                    <span class="error_input">* Ngày sinh không hợp lệ</span>
                                    <input id="dob" type="text" name="edit" placeholder="<?php echo e($checkUser[0]['bri_day']); ?>" value="<?php echo e($checkUser[0]['bri_day']); ?>" >
                                </div>
                                <div class="account_main">
                                    <label>Giới tính</label>
                                    <div class="genders">
                                        <div id="setC">
                                            <?php if($checkUser[0]['gender'] == 0): ?>
                                                <input id="setC_male" name="male" type="checkbox" checked>
                                            <?php else: ?>
                                                 <input id="setC_male" name="male" type="checkbox" >
                                            <?php endif; ?>
											<label for="setC_male">Nam</label>
                                            <?php if($checkUser[0]['gender'] == 1): ?>
                                                <input id="setC_female" name="fe_male" type="checkbox" checked>
                                            <?php else: ?>
                                                 <input id="setC_female" name="fe_male" type="checkbox">
                                            <?php endif; ?>
											<label for="setC_female">Nữ</label>
										</div>	
                                    </div>
                                </div>
                            </div>
                            <div class="account_col">
                                <div class="account_main">
                                    <label>Ảnh đại diện</label>
                                    <span class="error_input"></span>
                                    <div class="account_avatar">
                                        <div class="avatar_img">
                                            <form class="form-feature-product">
                                                <?php echo csrf_field(); ?>
                                                <lable for="avatar">Chọn ảnh</lable>
                                                <input id="avatar" type="file" name="avatar">
                                            </form>
                                        </div>
                                        <?php if(!empty($checkUser[0]['image'])): ?>
                                         <div id="imgTest" style="display: contents;"><img src="/images/<?php echo e($checkUser[0]['image']); ?>" alt="user image"></div>
                                         <?php else: ?>
                                         <div id="imgTest" style="background-image: url('<?php echo e(asset('./images/1.jpg')); ?>') ; display: block;"></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="account_col ">
                                <div class="account_main col_main_submit">
                                    <button id="cancel_info" class="button">
                                        <span>
                                            Huỷ bỏ
                                        </span>
                                        <img src="https://file.hstatic.net/1000187248/file/spinner_6dbec68bd28a42718f17704bf42d58e7.gif" alt="image loading">
                                    </button>

                                    <button id="submit_info" class="button dark">
                                        <span>
                                            Xác nhận
                                        </span>
                                        <img src="https://file.hstatic.net/1000187248/file/spinner_6dbec68bd28a42718f17704bf42d58e7.gif" alt="image loading">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/components/frontend/user.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/user.blade.php ENDPATH**/ ?>