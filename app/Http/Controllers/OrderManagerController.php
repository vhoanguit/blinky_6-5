<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_customer_order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderAcceptedMail;

class OrderManagerController extends Controller
{
    public function order_not_process_yet()
    {
        $orders = tbl_customer_order::where('order_status', 0)->get();
        return view('admin.order.Order_Manager_not_process', compact('orders'));
    }

    public function order_not_delivered_yet()
    {
        $orders = tbl_customer_order::where('order_status', 1)->get();
        return view('admin.order.Order_Manager_not_deliver', compact('orders'));
    }

    public function order_delivered()
    {
        $orders = tbl_customer_order::where('order_status', 2)->get();
        return view('admin.order.Order_Manager_Delivered', compact('orders'));
    }

    public function accept_order($id)
    {
        $order = tbl_customer_order::findOrFail($id);
        $order->order_status = 1;  // Update the order status to 'accepted'
        $order->save();

        // Send email to the customer
        Mail::to($order->customer_email)->send(new OrderAcceptedMail($order));

        return redirect()->route('order_not_process_yet')->with('success', 'Order has been accepted and email sent.');
    }
    public function admin_order_delivered($id)
    {
        $order = tbl_customer_order::findOrFail($id);
        $order->order_status = 2;  // Update the order status to 'accepted'
        $order->save();

        // Send email to the customer
        Mail::to($order->customer_email)->send(new OrderAcceptedMail($order));

        return redirect()->route('order_not_process_yet')->with('success', 'Order has been accepted and email sent.');
    }
    
}