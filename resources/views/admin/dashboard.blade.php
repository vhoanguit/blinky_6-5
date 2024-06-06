@extends('admin_layout')
@section('admin_content')
<?php 
        $connect = new mysqli('localhost', 'root', '', 'elaravel');
        $querySQL = $connect->query("
        SELECT           
            p.product_name as tensp,
            SUM(od.product_quantity) AS total_quantity_sold
        FROM 
            tbl_order_details od
        JOIN 
            tbl_product p ON od.product_id = p.product_id
        GROUP BY 
            p.product_id, p.product_name
        ORDER BY 
            total_quantity_sold DESC
        LIMIT 10;
        ");

        foreach($querySQL as $data){
            $tensp[]= $data['tensp'];
            $quantity[]= $data['total_quantity_sold'];
        }
    ?> 
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
            $revenue[]= $data['total_revenue'];
        }
    ?>
<div class="row">
    <h2 style="text-align:center">Thống kê doanh số</h2> 
   
    <canvas id="myChart"></canvas>
  
</div>

<div style="height:100px"></div>

<div class="row">   
<h2 style="text-align:center">Thống kê lượt bán sản phẩm</h2> 
    
    <canvas  id="myChart2"></canvas>
    
</div>
<div class="row" style="margin-top:-100px">
    <div class="col-md-2"></div>  
    <div class="col-md-4">
        <h3 style="text-align:center">Lượt xem bài viết</h3>
        <div class="list_views">
            <table class="table_views table-bordered">
                <thead>
                    <tr style="height:50px;">
                        <th style="text-align:center">Bài viết</th>
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
    <div class="col-md-4">
        <h3 style="text-align:center">Lượt xem sản phẩm</h3>
        <div class="list_views">
            <table class="table_views table-bordered">
                <thead>
                    <tr style="height:50px;">
                        <th style="text-align:center">Sản phẩm</th>
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
                label: 'Doanh thu (VND)',
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

    const ctz = document.getElementById('myChart2');
    const labelz = <?php echo json_encode($tensp) ?>;
    new Chart(ctz, {
        type: 'doughnut',
        data: {
            labels: labelz,
            datasets: [{
                label: 'Số lượt bán',
                data: <?php echo json_encode($quantity) ?>,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(25, 215, 46)',
                    'rgb(125, 25, 12)',
                    'rgb(255, 159, 64)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)',
                    'rgb(0, 128, 128)'
                ],
                hoverOffset: 4
            }]
            
        },
        options: {
        cutout: '50%', // Giảm phần được cắt ra, ví dụ 50% sẽ làm cho biểu đồ nhỏ hơn
        radius: '70%', // Giảm bán kính của biểu đồ, ví dụ 80% sẽ làm cho biểu đồ nhỏ hơn
        animation: {
        animateRotate: true, // Có hiệu ứng quay khi biểu đồ xuất hiện
        animateScale: false // Không có hiệu ứng phóng to từ trung tâm ra ngoài
        }
    
  },
  

    });
</script>
@endsection
