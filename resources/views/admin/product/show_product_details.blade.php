@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết số lượng sản phẩm
            </div>
            {{-- <div class="row">
        <div class="col-md-3" align="right">
          
        </div>
      </div> --}}
            <div class="row w3-res-tb">
                <div class="col-md-2" align="right" style="margin-left: -30px">
                    <img src="{{ URL::to('public/uploads/product/' . $product_img->product_image) }}" height="100"
                        width="100" style="object-fit: cover">
                </div>
                <div class="col-md-6">
                    <td>
                        <p style="font-size: 18px"> {{ $product_img->product_name }}</p>
                    </td>
                    {{-- <br> --}}
                    <td >
                        <a href="{{ URL::to('/edit-product-details/' . $product_img->product_id) }}"
                            class="active styling-edit" ui-toggle-class="" style="font-size:16px">
                            <i class="fa fa-pencil-square-o text-success text-active" style="margin-top: 10px"></i>  Chỉnh sửa chi tiết sản phẩm
                        </a>
                    </td>
                    <td>
                      <p style="margin-top: 20px; font-size:13px">Tổng số sản phẩm: 
                        <?php
                        $sum = 0;
                        foreach ($product as $key => $pro) {
                            $sum += $pro->SL;
                        }
                        echo "$sum";
                        ?></p>
                    </td>
                </div>

            </div>
            <br><br>
            <div class="table-responsive">
                <?php
                $message = Session::get('message'); // hàm get để lấy biến có tên là 'message' ở bên AdminController
                if ($message) {
                    // neu ton tai message
                    echo '<span class="text-alert">' . $message . '</span>'; // in ra tin nhan
                    Session::put('message', null); //cho hien thi 1 lan thoi
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead >
                        <tr >
                            <th style=" display: table-cell; text-align: center; vertical-align: middle;">Kích cỡ</th>
                            <th style=" display: table-cell; text-align: center; vertical-align: middle;">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $key => $pro)
                            <tr>
                                <td style=" display: table-cell; text-align: center; vertical-align: middle;">{{ $pro->size_value }}</td>
                                <td style=" display: table-cell; text-align: center; vertical-align: middle;">{{ $pro->SL }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer> --}}
        </div>
    </div>
@endsection