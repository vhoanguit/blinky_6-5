<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Customer;
use DB;
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Customer::class, function ($app) {
            return new Customer();
        });
    }

    public function boot()
    {
        view()->composer ('*', function($view)
        {
            $category_product_header=DB::table('tbl_category_product')->get();
            $category_post_header = DB::table('tbl_category_post')->orderBy('cate_post_id','DESC')->where('cate_post_status','1')->get(); // k có phân trang nên mình lấy hết bằng hàm get
            
            $min_price=DB::table('tbl_product')->min('product_price');
            $max_price=DB::table('tbl_product')->max('product_price');
            $min_price_range=$min_price-100000;
            $max_price_range=$max_price+100000;

            if(isset($_GET['price_from']) && ($_GET['price_from']) )
            {
                $min_price=$_GET['price_from'];
                $max_price=$_GET['price_to'];
                $all_product=DB::table('tbl_product')->where('product_status','1')->whereBetween('product_price',[$min_price,$max_price])->orderby('product_price','asc')->get();
            }

            $view
            // ->with('min_price_value',$min_price)->with('max_price_value',$max_price)
            // ->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range)
            ->with('category_product_header',$category_product_header)
            ->with('category_post_header',$category_post_header);
        });
    }
}