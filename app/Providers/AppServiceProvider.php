<?php

namespace App\Providers;
use DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer ('*', function($view)
        {
            $category_product_header=DB::table('tbl_category_product')->get();

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

            $view->with('min_price_value',$min_price)->with('max_price_value',$max_price)
            ->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range)
            ->with('category_product_header',$category_product_header);
        });
    }

}
