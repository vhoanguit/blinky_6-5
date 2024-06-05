
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất Cả Bài Viết</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
	<link href="{{asset('public/frontend/css/blog_page.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/frontend/css/sanpham.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet"> 

</head>
<body>
    @include('Header')
    <div class="tag-list">
        <div class="inner">           
            @foreach($imagePostSlider as $key => $sliderImg)
            <div class="tag">
            <a href="{{ URL::to('/chi-tiet-san-pham/'. $sliderImg->product_id) }}">
                <img src="{{ URL::to('public/uploads/product/' . $sliderImg->product_image) }}" alt="">
            </a>            
            </div>
            @endforeach
           <!-- Lặp lại hình ảnh  -->
            @foreach($imagePostSlider as $key => $sliderImg)
            <div class="tag">
                <a href="{{ URL::to('/chi-tiet-san-pham/' . $sliderImg->product_id) }}">
                <img src="{{ URL::to('public/uploads/product/' . $sliderImg->product_image) }}" alt="">
                </a>
            </div>
            @endforeach
        </div>
        <div class="fade"></div>
    </div>
    <div class="main">
        <div class="section">
            <div class="news_header">
        <!--Code chinh -->
                <h2><b>Tất cả bài viết</b></h2>
            </div>

            <div class="post_lists">
                @foreach($baiviet as $key=>$p)
                    <div class="displayPost">
                    <a style="text-decoration: none; color:black"  href="{{url('/bai-viet/'.$p->post_slug)}}">
                        <div class="singlePost">
                            <img style="object-fit:cover" src="{{asset('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}"/>
                            <h3 style="color:#000;width:95%"><b>{{$p->post_title}}</b></h3>
                            <p style="width:95%">{!!$p->post_desc!!}</p>                     
                        </div>
                    </a>
                    </div>
                @endforeach
            </div> 
        <div class="pagination">
            {{ $baiviet->links('pagination::bootstrap-4') }}
        </div>
        </div>

        <div id="sidebar" class="sidebar">
            <div class="social">
                <div class="social_link">
                    <hr>
                    <h2><b>SOCIAL</b></h2>         
                    <hr>      
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
            <div class="foru">
            <div class="foru_header">
                <hr>
                <h2><b>FOR YOU</b></h2>
                <hr>
            </div>
                <div class="foru_links">
                    
                    <ul>
                    @foreach($category_post as $key => $danhmucbaiviet)
                    <li>
                        <i class="fa-solid fa-angles-left" style="color:rgb(255, 103, 179)"></i>
                        <a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}"><b>{{$danhmucbaiviet->cate_post_name}}</b></a>
                        
                    </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="top_view">
                <div class="top_view_header">
                    <hr>
                    <h2><b>TOP VIEW</b></h2>
                    <hr>
                </div> 
                <div class="top_view_links">
                    <ul>
                    @foreach($topview as $key => $top)
                    <li>
                        <a href="{{URL::to('/bai-viet/'.$top->post_slug)}}">
                            <div style="display:flex">
                                <img style="object-fit:cover;width:70px;height:70px;margin-right:10px"  src="{{asset('public/uploads/post/'.$top->post_image)}}" alt="{{$top->post_slug}}"/>
                                <div>
                                    <p><b>{{$top->post_title}}</b></p>
                                    <p><em>{{$top->post_views}} lượt xem</em></p>
                                </div>
                            </div>               
                        </a>
                    </li>
                    @endforeach
                    </ul>
                </div> 
            </div>
            <div class="latest">
                <div class="latest_header">
                    <hr>
                    <h2><b>LATEST POSTS</b></h2>
                    <hr>
                </div>
                <div class="latest_links">
                    <ul>
                    @foreach($newest_post as $key => $baivietmoinhat)
                    <li>
                        <a href="{{URL::to('/bai-viet/'.$baivietmoinhat->post_slug)}}">
                            <div style="display:flex">
                                <img style="object-fit:cover;width:70px;height:70px;margin-right:10px"  src="{{asset('public/uploads/post/'.$baivietmoinhat->post_image)}}" alt="{{$baivietmoinhat->post_slug}}"/>
                                <div>
                                    <p><b>{{$baivietmoinhat->post_title}}</b></p>
                                    <p><em>{{$baivietmoinhat->post_views}} lượt xem</em></p>
                                </div>
                            </div>               
                        </a>
                    </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            

        </div>

    </div>
    
</body>
@include('Footer')

</html>
    
   
    

