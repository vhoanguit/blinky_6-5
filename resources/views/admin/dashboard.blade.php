@extends('admin_layout')
@section('admin_content')
<div class="row">
    <h2>Thống kê doanh số</h2>
    <form autocomplete ="off">
        @csrf 
        <div class="col-md-2">
            <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
        </div>
        <div class="col-md-2">
            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
        </div>
        
        <div class="col-md-2">
            <p>
                Lọc theo: 
                <select class="dashboard-filter form-control">
                    <option>--Chọn--</option>
                    <option value="lastweek">Tuần vừa rồi</option>
                    <option value="lastmonth">Tháng trước</option>
                    <option value="thismonth">Tháng này</option>
                    <option value="lastyear">Năm trước</option>

                </select>
            </p>
        </div>
                
    </form>
    <?php 
        $con = new mysqli('localhost','root','','elaravel');
        $query= $con->query("
        SELECT 
        DATE_FORMAT(order_date, '%Y-%m') AS month,
        SUM(order_total_price) AS total_revenue
        FROM 
            tbl_customer_order
        GROUP BY 
            DATE_FORMAT(order_date, '%Y-%m')
        ORDER BY 
            month;
        ");
        
        foreach($query as $data){
            $month[]= $data['month'];
            $revenue[] = $data['total_revenue'];
        }
    ?>
    <div>
    <canvas id="myChart"></canvas>
    </div>
</div>
<div style="height:100px"></div>
<div class="row">
    <div class="col-md-2 ">
    </div>
    <div class="col-md-4 ">
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
    <div class="col-md-4 ">
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
<script>
  const ctx = document.getElementById('myChart');
  const labels = <?php echo json_encode($month) ?>;
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
	  
      datasets: [{
        label: 'VND',

        data: <?php echo json_encode($revenue) ?>,
		backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
	borderColor: [
      'black'
    ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
 
@endsection
