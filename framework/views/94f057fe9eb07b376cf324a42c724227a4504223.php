<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/signup.css')); ?>" type="text/css">
<section id="register_smb">
	<div class="wrapper_smb">
		<div class="gird_smb">
			<div class="grid__item_smb">
				<div class="registers">
					<div class="registers_title">
						<h2>
							Đăng ký
						</h2>
						<p>Nếu bạn chưa có tài khoản, điền các thông tin đăng ký tại đây</p>
						<p class="registerss_error">* Đăng ký thất bại, vui lòng thử lại</p>
					</div>				
					<div class="registerss_main">


						<div class="register_col">
							<div class="register_main">
								<label>Họ và tên</label>
								<span>*Tên quá dài</span>
								<input id="fullName" type="text" placeholder="Nhập họ và tên của bạn">
							</div>
						</div>

						<div class="register_col">
							<div class="register_main">
								<label>Số điện thoại</label>
								<span>*Số điện thoại không hợp lệ</span>
								<input id="phoneNumber" type="text" placeholder="Nhập số điện thoại của bạn">
							</div>
						</div>

						<div class="register_col">
							<div class="register_main">
								<label>Email</label>
								<span>*Email không đúng định dạng</span>
								<input id="email" type="text" placeholder="Nhập Email của bạn">
							</div>
						</div>
						<div class="register_col register_col_50">
							<div class="register_col">
								<div class="register_main">
									<label>Mật khẩu</label>
									<span class="password_error">*Mật khẩu phải từ 8 ký tự trở lên</span>
									<input id="password" type="password" placeholder="Nhập mật khẩu của bạn" aria-autocomplete="list">
								</div>
							</div>
							<div class="register_col">
								<div class="register_main">
									<label>Nhập Lại Mật khẩu</label>
									<span class="message">*Mật khẩu không khớp , vui lòng nhập lại</span>
									<input id="password_again" type="password" placeholder="Nhập lại mật khẩu của bạn">
								</div>
							</div>
						</div>
						<div class="register_col register_col_50">
							<div class="register_col">
								<div class="register_main">
									<label>Ngày sinh</label>
									<span>*Ngày sinh không hợp lệ</span>
									<input id="dob" type="date" placeholder="Nhập mật khẩu của bạn">
								</div>
							</div>
							<div class="register_col">
								<div class="register_main">
									<label>Giới tính</label>
									<div class="genders">
										<div id="setC">
											<input id="setC_male" name="male" type="checkbox">
											<label for="setC_male">Nam</label>
											<input id="setC_female" name="fe_male" type="checkbox">
											<label for="setC_female">Nữ</label>
										</div>			
									</div>
								</div>
							</div>
						</div>
						<div class="register_col">
							<div class="register_main">
								<div class="register_main_bottom">
									<button id="registers_submit" class="button dark">
										<span>Đăng ký</span>
										<img src="https://file.hstatic.net/1000187248/file/spinner_6dbec68bd28a42718f17704bf42d58e7.gif" alt="image loading">
									</button>
									<span>Bạn đã có tài khoản?</span><a href="/loginClient">Đăng nhập</a>
								</div>
							</div>
						</div>
						
					</div>
				</div>			
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="getPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="send_mail_title">
                    <h2>
                        Lấy lại mật khẩu
                    </h2>
                </div>
            </div>
            <div class="modal-body">
                <div class="login_main">
					<label>Chúng tôi sẽ gửi cho bạn hướng dẫn về cách thiết lập lại mật khẩu</label>
					<span style="display: block;">* Gửi Email lỗi, vui lòng thử lại</span>
					<input id="send_email" type="text" placeholder="Nhập Email của bạn">
				</div>
            </div>
            <div class="modal-footer">
                <div class="send_mail_footer">
                    <button id="send_email_submit" class="button dark">Gửi email</button>
                    <button id="send_email_cancel" class="button">huỷ bỏ</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/components/frontend/signup.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/signup.blade.php ENDPATH**/ ?>