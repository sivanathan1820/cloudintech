<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use App\Models\Order; 
use App\Models\Card;
use Razorpay\Api\Api;
use Session;

class CustomerController extends Controller
{
    public function payment(Request $request)
    {
        $api = new Api('rzp_test_1xufIWYYSKB4jD', 'vS40zgXT1Tybz7GTDRbipq4B');

        $products = Card::where('customerid',Session::get('customerid'))->where('status','!=','placed')->get();
        $total_amount = 0;
        foreach ($products as $value)
        {
            $total_amount   += $value->price;
        }

        $order = $api->order->create(array('receipt' => '123', 'amount' => $total_amount*100, 'currency' => 'INR'));
        return view('customer.payment')->with([ 'data' => $order ]);
    }
    public function paymentresponse(Request $request)
    {
        $paymentid  = $request->paymentid;
        $order_id   = $request->order_id;
        $sign       = $request->sign;
        $amount     = $request->amount;

        if($paymentid !="")
        {
            $products = Card::where('customerid',Session::get('customerid'))->where('status','!=','placed')->get();
            foreach ($products as $value)
            {
                $customerid     = $value->customerid;
                $product        = $value->product;
                $price          = $value->price;

                $data = array(

                    'customerid'    => $customerid,
                    'product'       => $product,
                    'price'         => $price,
                    'status'        => 'paid',
                    'orderid'       => $order_id,
                    'paymentid'     => $paymentid,
                    'signature'     => $sign,
                    'totalpaid'     => $amount,
                );

                $result = Order::create($data);
                if($result==true)
                {
                    Card::where('id',$value->id)->update(array('status'=> 'placed'));
                }
            }
        }
        return response()->json(['message' => 'Paid Successfully'],200);
    }
}
