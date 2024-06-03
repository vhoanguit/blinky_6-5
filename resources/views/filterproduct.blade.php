<?php 
//namespace App\Http\Controllers;

// use DB; // sử dụng database

// use Session; // thu vien sdung session
// use Illuminate\Support\Facades\Redirect; 
// session_start();
//use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/bootstrap/app.php';

// Make sure to boot the application to initialize all services
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use Illuminate\Support\Facades\DB;

    //echo"sdsdasad";
    if(isset($_GET['filter_checked']))
    {
        $filter_checked=$_GET['filter_checked'];
        //$all_product

        $all_product=DB::table('tbl_product')->where('product_status','1');

        for($i=0; $i<count($filter_checked); $i++)
        {
            
            if($i>0)
            {
                $all_product = $all_product->orWhere('product_color',$filter_checked[$i]);
            }
            $all_product = $all_product->Where('product_color',$filter_checked[$i]);
        }
    //     $all_product .= ")";

    //     //if(isset($_GET['cate'])) $all_product .= "category_id = '" .  $connect->real_escape_string($cate) . "'";

    //     if(isset($_GET['min_price'])&&($_GET['max_price']))
    //     {
    //         //$all_product .="product_price BETWEEN '".  $connect->real_escape_string($min_price) . "'";
    //         $all_product .="AND ( product_price BETWEEN '".  $connect->real_escape_string($_GET['min_price']) ."' AND '".  $connect->real_escape_string($_GET['max_price']) ."' )";
    //     }

    //     $all_product .= " ORDER BY product_id";
    //     $product = mysqli_query($connect, $all_product);
    // }
    // else
    // {
    //     // $all_product = "SELECT * FROM tbl_product WHERE product_status = '1' ORDER BY product_id";
    //     // $product = mysqli_query($connect, $all_product);
        
    //     $all_product = "SELECT * FROM tbl_product WHERE product_status = '1' 
    //                     AND ( product_price BETWEEN '".  $connect->real_escape_string($_GET['min_price']) ."' AND '".  $connect->real_escape_string($_GET['max_price']) ."' ) 
    //                     ORDER BY product_id";

    //     $product = mysqli_query($connect, $all_product);
    // }
    }
?>

    @foreach ($all_product as $key => $pro) 
    {
        <div class="product-card">
            <div class="product-image">
                <a href="{{ URL::to('/chi-tiet-san-pham/' . $pro->product_id) }}">
                    <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}" alt="">
                </a>
            </div>
            <div class="product-info">
                <a class="product-name" href="{{ URL::to('/chi-tiet-san-pham/' . $pro->product_id) }}">{{ $pro->product_name }}</a>
                <p class="product-price">{{ number_format($pro->product_price) . ' ' . 'VNĐ' }}</p>
            </div>
        </div>
    }

<?php
    // if ($product !== false && mysqli_num_rows($product) > 0) 
    // {      
    //     while ($pro = mysqli_fetch_object($product)) {
    //         echo '<div class="product-card">';
    //         echo '<div class="product-image">';
    //         echo '<a href="{{ URL::to(\'/chi-tiet-san-pham/\'.$pro->product_id) }}">';
    //         echo '<img src="public/uploads/product/' . $pro->product_image . '" alt="">';
    //         echo '</a>';
    //         echo '</div>';
    //         echo '<div class="product-info">';
    //         echo '<a class="product-name" href="{{ URL::to(\'/chi-tiet-san-pham/\'.$pro->product_id) }}">' . $pro->product_name . '</a>';
    //         echo '<p class="product-price">' . number_format($pro->product_price) . ' VNĐ</p>';
    //         echo '</div>';
    //         echo '</div>';
       // }
    //} 
    // $product->links('pagination::bootstrap-4');
?>