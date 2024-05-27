@extends('copy_layout')
@section('blog')
    <div class="tag-list">
        <div class="inner">
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img1.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img2.jpeg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img3.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img4.png')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img5.png')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img8.jpg')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img7.jpg')}}" alt="" >
            </div>
            <!-- lap lai hinh anh -->
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img1.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img2.jpeg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img3.jpg')}}" alt="">
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img4.png')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img5.png')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img8.jpg')}}" alt="" >
            </div>
            <div class="tag">
                <img src="{{asset('resources/views/pages/baiviet/img7.jpg')}}" alt="" >
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
                            <h3 style="color:#000"><b>{{$p->post_title}}</b></h3>
                            <p>{!!$p->post_desc!!}</p>                     
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
                <div class="watch_most_header"><h2 style="color:#5f4100;"><b>NEWEST POSTS</b></h2></div>
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
    <!--Code chinh-->
    <!-- <h2 class="title text-center">Danh muc bai viet</h2>

        <div class="product-image-wrapper">
        @foreach($post as $key=>$p)
            <div class="single-products" style="margin:10px 0;">
                <div class="text-center">
                    <img style="float:left;widt:30%;padding:5px;width:100px;height:100px" src="{{asset('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}"/>
                    <h4 style="color:#000;padding:5px;">{{$p->post_title}}</h4>
                    <p>{!!$p->post_desc!!}</p>

                 
                </div>
                <a  href="{{url('/bai-viet/'.$p->post_slug)}}" class="btn btn-default bt-sm">Xem bai viet</a>
            </div>
        @endforeach
        </div>  -->
    <!--Code chinh-->
   
    
@endsection 

