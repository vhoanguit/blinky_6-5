<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục bài viết</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
	<link href="{{asset('public/frontend/css/blog_page.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/frontend/css/sanpham.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet"> 

</head>
@include('Header')
<body>
    <div class="tag-list">
        <div class="inner">
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_39.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_13.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_16.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_12.jpg')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_8.jpg')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_26.jpg')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_22.jpg')}}" alt="" >
            </div>
            <!-- lap lai hinh anh -->
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_39.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_13.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_16.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_12.jpg')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_8.jpg')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_26.jpg')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('public/frontend/image/main_img_22.jpg')}}" alt="" >
            </div>
        </div>
        <div class="fade"></div>
    </div>
    <div class="main">
        <div class="section">
            <div class="news_header">
        <!--Code chinh -->
                <h2><b>{{$catego_post->cate_post_name}}</b></h2>
            </div>

            <div class="post_lists">
                @foreach($post as $key=>$p)
                    <div class="displayPost">
                        <div class="">
                            <img style="" src="{{asset('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}"/>
                            <h3 style="color:#000;width:95%"><b>{{$p->post_title}}</b></h3>
                            <p style="width:95%">{!!$p->post_desc!!}</p>                     
                        </div>
                        <a  href="{{url('/bai-viet/'.$p->post_slug)}}" class="btn btn-default bt-sm">Xem bài viết</a>
                    </div>
                @endforeach
            </div> 
        <!--Code chinh-->
            
        </div>

        <div id="sidebar" class="sidebar">
            <div class="social">
                <div class="social_link">
                <h2 style="color:#5f4100;"><b>SOCIAL</b></h2>                
                </div>
                
                <div class="groupicon">
                    <ul class="social_icons">
                        <li style="--clr: #333333;">
                            <a href="">
                                <i class="fa-brands fa-tiktok"></i>
                            </a>
                        </li>
                        <li style="--clr: #3491d8;">
                            <a href="https://www.facebook.com/profile.php?id=100028951819543&mibextid=LQQJ4d">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </li>
                        <li style="--clr: #ff4d86;">
                            <a href="#">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                
            </div>
            <hr>
            <div class="foru">
            <div class="foru_header"><h2 style="color:#5f4100;"><b>FOR YOU</b></h2></div>
                <div class="foru_links">
                    
                    <ul>
                    @foreach($category_post as $key => $danhmucbaiviet)
                    <li>
                        <i class="fa-solid fa-angles-left" style="color:rgb(206, 158, 56)"></i>
                        <a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}"><b>{{$danhmucbaiviet->cate_post_name}}</b></a>
                        
                    </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <hr>
            <div class="watch_most">
                <div class="watch_most_header"><h2 style="color:#5f4100;"><b>LATEST POSTS</b></h2></div>
                <div class="watch_most_links">
                    <ul>
                    @foreach($newest_post as $key => $baivietmoinhat)
                    <li>
                        <i class="fa-solid fa-angles-right" style="color:rgb(206, 158, 56)"></i>
                        <a href="{{URL::to('/bai-viet/'.$baivietmoinhat->post_slug)}}">{{$baivietmoinhat->post_title}}</a>
                        
                    </li>
                    @endforeach
                    </ul>
                </div>
            </div>

        </div>

    </div>
   
    
</body>
</html>
