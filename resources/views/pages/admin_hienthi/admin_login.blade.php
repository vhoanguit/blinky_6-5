
<!DOCTYPE html>
<head>
<title>Admin Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="admin-login-main">
	<h2>Đăng nhập</h2>
	<?php
	    $message = Session::get('message'); // hàm get để lấy biến có tên là 'message' ở bên AdminController
	    if($message){ // neu ton tai message
			echo '<span class="text-alert">'.$message.'</span>' ; // in ra tin nhan
			Session::put('message',null); //cho hien thi 1 lan thoi
		}
	?>
	
		<form action="{{URL::to('/admin-dashboard')}}" method="post"> <!--Khi đăng nhập thì sẽ điều hướng đến admin dashboard-->
			{{ csrf_field() }} <!--Gửi 1 trường chứa token CSRF nhằm để tránh việc bị đánh cắp thông tin-->
			<input type="text" class="ggg" name="admin_email" placeholder="nhập email" required=""> 
			<!-- sửa name sao cho trùng với thuộc tính đã tạo ở phpmyadmin -->
			<input type="password" class="ggg" name="admin_password" placeholder="nhập mật khẩu" required="">
			<span class="rememberLogin"><input type="checkbox" />Nhớ lần đăng nhập tiếp theo</span>
			<h6><a href="#">Quên mật khẩu?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Đăng Nhập" name="login">
		</form>
</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{('public/backend/js/jquery.scrollTo.js"></script>
</body>
</html>
