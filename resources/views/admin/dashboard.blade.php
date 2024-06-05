@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 style="text-align:center">Lượt xem bài viết</h3>
        <div class="list_views">
            <table class="table_views table-bordered">
                <thead>
                    <tr style="height:50px;">
                        <th style="text-align:center" >Bài viết</th>
                        <th style="width:100px; text-align:center">Lượt xem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($post_views as $key => $post)
                    <tr style="height:50px;">
                        <td style="text-align:center">
                            <a style="color:black" target="_blank" href="{{url('/bai-viet/'.$post->post_slug)}}">{{$post->post_title}}</a>
                        </td>
                        <td style="text-align:center;color:red">
                        <b>{{$post->post_views}}</b>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4 col-xs-12">
        <h3 style="text-align:center">Lượt xem sản phẩm</h3>
        <div class="list_views">
            <table class="table_views table-bordered">
                <thead>
                    <tr style="height:50px;">
                        <th style="text-align:center" >Sản phẩm</th>
                        <th style="width:100px; text-align:center">Lượt xem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_views as $key => $product)
                    <tr style="height:50px;">
                        <td style="text-align:center;width:300px">
                            <a style="color:black;" target="_blank" href="{{url('/chi-tiet-san-pham/'.$product->product_id)}}">{{$product->product_name}}</a>
                        </td>
                        <td style="text-align:center;color:red">
                        <b>{{$product->product_views}}</b>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
