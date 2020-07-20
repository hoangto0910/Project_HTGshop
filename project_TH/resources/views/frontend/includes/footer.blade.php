<!-- FOOTER -->
<footer id="footer">
	<!-- top footer -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-3 col-xs-6">
					<div class="footer">
						<h3 class="footer-title">Về chúng tôi</h3>
						<p>Chuyên cung cấp linh kiện điện tử, phụ kiện game thủ, máy chơi game console.</p>
						<ul class="footer-links">
							<li><a href="#"><i class="fa fa-map-marker"></i>Tổ 19 Lĩnh Nam Mai Động</a></li>
							<li><a href="#"><i class="fa fa-phone"></i>+78 715 7928</a></li>
							<li><a href="#"><i class="fa fa-envelope-o"></i>Hoangto@gmail.com</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3 col-xs-6">
					<div class="footer">
						<h3 class="footer-title">Danh mục</h3>
						<ul class="footer-links">
							<li><a href="#">Linh Kiện Máy tính</a></li>
							<li><a href="#">Phụ kiện điện tử</a></li>
							<li><a href="#">Gaming gear</a></li>
							<li><a href="#">Đồ chơi công nghệ</a></li>
							<li><a href="#">Máy điện tử console</a></li>
						</ul>
					</div>
				</div>

				<div class="clearfix visible-xs"></div>

				<div class="col-md-3 col-xs-6">
					<div class="footer">
						<h3 class="footer-title">Thông tin</h3>
						<ul class="footer-links">
							<li><a href="#">Về chúng tôi</a></li>
							<li><a href="#">Liên hệ với chúng tôi</a></li>
							<li><a href="#">Chính sách bảo hành</a></li>
							<li><a href="#">Đặt hàng và trả hàng</a></li>
							<li><a href="#">Điều khoản sử dụng</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3 col-xs-6">
					<div class="footer">
						<h3 class="footer-title">Dịch vụ</h3>
						<ul class="footer-links">
							<li><a href="#">Quản lý tài khoản</a></li>
							<li><a href="#">Xem giỏ hàng</a></li>
							<li><a href="#">Wishlist</a></li>
							<li><a href="#">Kiểm tra order</a></li>
							<li><a href="#">Giúp đỡ</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /top footer -->

	<!-- bottom footer -->
	<div id="bottom-footer" class="section">
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12 text-center">
					<ul class="footer-payments">
						<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
						<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
						<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
						<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
						<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
						<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
					</ul>
					<span class="copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</span>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script> --}}
<script type="text/javascript">
	$(document).ready(function(){
		$('#register').on('submit', function(e){
			e.preventDefault();
					// alert('ss');
					$.ajax({
						type: "POST",
						url: '{{ route("backend.user.storeajax") }}',
						data: $("#register").serialize(),
						success: function (response) {
							console.log(response)
							$("#registerModal").modal('hide')
							cache: false
							alert("Đăng ký thành công");
						},
						error: function (error) {
							console.log(error)
							alert("Đăng ký thất bại");
						}
					});
				});
	});
</script>
@yield('js-footer')	
</body>
</html>