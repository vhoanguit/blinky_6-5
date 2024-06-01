
<!DOCTYPE html>
	<head>
	<title>Trang Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css'/>
	<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
	<!-- font CSS -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	
	<!-- <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/> -->
	<!-- <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<!-- <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/> -->
	
	<!-- //font-awesome icons -->
	<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
	<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
	<script src="{{asset('public/backend/js/morris.js')}}"></script>
    <!-- summernote editor -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	</head>
<body>
	<section id="container">
	<!--header start-->
	<header class="header fixed-top clearfix">
	<!--logo start-->
	<div class="brand">
		<a href="index.html" class="logo">
			ADMIN
		</a>
		<div class="sidebar-toggle-box">  <!-- dung de keo ra keo vao thanh menu -->
			<div class="fa fa-bars"></div>
		</div>
	</div>
	<!--logo end-->

	<div class="top-nav clearfix">
		<!--search & user info start-->
		<ul class="nav pull-right top-menu">
			
			<!-- user login dropdown start-->
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<img alt="" src="{{('public/backend/images/2.png')}}">
					<span class="username">
					<?php
						$name = Session::get('admin_name'); // hàm get để lấy biến có tên là 'admin_name' ở bên AdminController
						if($name){ // neu ton tai name
							echo $name; // in ra name
						}
					?>
					</span>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu extended logout">
					
					<li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
				</ul>
			</li>
			<!-- user login dropdown end -->
		
		</ul>
		<!--search & user info end-->
	</div>
	</header>
	<!--header end-->
	<!--sidebar start-->
	<aside>
		<div id="sidebar" class="nav-collapse">
			<!-- sidebar menu start-->
			<div class="leftside-navigation">
				<ul class="sidebar-menu" id="nav-accordion">
					<li>
						<a class="active" href="{{URL::to('/dashboard')}}">
							<i class="fa fa-dashboard"></i>
							<span>Tổng quan</span>
						</a>
					</li>
					
					<li class="sub-menu">
						<a href="javascript:;">
						<i class="fa-solid fa-list"></i>							
						<span>Danh mục sản phẩm</span>
						</a>
						<ul class="sub">
							<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
							<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>    
						</ul>
					</li>
					<li class="sub-menu">
						<a href="javascript:;">
						<i class="fa-solid fa-tags"></i>
							<span> Sản phẩm</span>
						</a>
						<ul class="sub">
							<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
							<li><a href="{{URL::to('/all-product')}}">Tất cả sản phẩm</a></li>    
						</ul>
					</li>
					<li class="sub-menu">
						<a href="javascript:;">
						<i class="fa-solid fa-list"></i>							
						<span>Danh mục bài viết</span>
						</a>
						<ul class="sub">
							<li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết</a></li>
							<li><a href="{{URL::to('/all-category-post')}}">Tất cả danh mục bài viết</a></li>    
						</ul>
					</li>
					<li class="sub-menu">
						<a href="javascript:;">
							<i class="fa fa-book"></i>
							<span> Bài viết</span>
						</a>
						<ul class="sub">
							<li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
							<li><a href="{{URL::to('/all-post')}}">Tất cả bài viết</a></li>    
						</ul>
					</li>
				</ul> 
			</div>
			
		</div>
	</aside>
	<!--sidebar end-->
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
			@yield('admin_content')
		</section>
	<!-- footer -->
		<div class="footer"></div>
	<!-- / footer -->
	</section>
	<!--main content end-->
	
	<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
	<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
	<script src="{{asset('public/backend/js/scripts.js')}}"></script>
	<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
	<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
	<!-- <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script> -->

	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
	<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
	<!-- morris JavaScript -->	
	<script>
		//using ckeditor
			// CKEDITOR.replace('ckeditor');
			// CKEDITOR.replace('ckeditor1');
			// CKEDITOR.replace('ckeditor2');
			// CKEDITOR.replace('ckeditor3');
			// CKEDITOR.replace('id4');
			$('#tomtat').summernote({
				placeholder: 'Tóm tắt bài viết',
				tabsize: 2,
				height: 100,
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
					['insert', ['link', 'picture', 'video']],
					['view', ['fullscreen', 'codeview', 'help']]
				]
            });
			$('#noidung').summernote({
				placeholder: 'Nội dung bài viết',
				tabsize: 2,
				height: 400,
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
					['insert', ['link', 'picture', 'video']],
					['view', ['fullscreen', 'codeview', 'help']]
				]

            });
			$('#motaSp').summernote({
				placeholder: 'Mô tả sản phẩm',
				tabsize: 2,
				height: 200,
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
					['insert', ['link', 'picture', 'video']],
					['view', ['fullscreen', 'codeview', 'help']]
				]

            });
			$('#noidungSp').summernote({
				placeholder: 'Nội dung sản phẩm',
				tabsize: 2,
				height: 400,
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
					['insert', ['link', 'picture', 'video']],
					['view', ['fullscreen', 'codeview', 'help']]
				]

            });
			
			
	</script>
	
</body>
</html>
