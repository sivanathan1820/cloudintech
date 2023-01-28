<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Product;
use App\Models\Card;
use App\Models\Order;
use App\Models\Customer;
use Session;

class MasterController extends Controller
{
    public function save_product(Request $request)
    {
        $valid = Validator::make($request->all(),
        [
            'product'      => 'required',
            'price'        => 'required',
            'description'  => 'required',
        ]);

        if($valid->fails())
        {
            return response()->json(['message' => 'Invalid Input','code' => 0],400);
        }
        
        $data       = $request->all();
        $id         = $this->decryption($request->id);
        $savedata   = ['product' => $request->product,'price' => $request->price,'description' => $request->description];

        if($request->id==0)
        {
            $isExist   = Product::where('product', $request->product)->first();
            if($isExist)
            {
                return response()->json(['message' => 'Product Already Added','code' => 3],200);
            }
            else
            {
                $result = Product::create($savedata);
                return response()->json(['message' => 'Product Saved Successfully','code' => 1],200);
            }
        }
        else
        {
            $isExist   = Product::where('product', $request->product)->where('id','!=', $id)->first();
            if($isExist)
            {
                return response()->json(['message' => 'Product Already Added','code' => 3],200);
            }
            else
            {
                $result = Product::where('id',$id)->update($savedata);
                return response()->json(['message' => 'Product Updated Successfully','code' => 2],200);
            }
        }
    }

    public function list_product(Request $request)
    {
        $products = Product::all()->sortBy('product');
        $data = [];
        foreach ($products as $value)
        {
            $temp                   = [];
            $temp['product']        = $value->product;
            $temp['price']          = $value->price;
            $temp['description']    = $value->description;
            $temp['ref']            = $this->encryption($value->id);
            $data[]                 = $temp;
        }
        return response()->json(['data' => $data],200);
    }

    public function get_product(Request $request)
    {
        $valid = Validator::make($request->all(),
        [
            'id'      => 'required',
        ]);

        if($valid->fails())
        {
            return response()->json(['message' => 'Invalid Input','code' => 0],400);
        }

        $products = Product::where('id',$this->decryption($request->id))->get();
        $data = [];
        foreach ($products as $value)
        {
            $temp                   = [];
            $temp['product']        = $value->product;
            $temp['price']          = $value->price;
            $temp['description']    = $value->description;
            $data[]                 = $temp;
        }
        return response()->json(['data' => $data],200);
    }

    public function delete_product(Request $request)
    {
        $valid = Validator::make($request->all(),
        [
            'id'      => 'required',
        ]);

        if($valid->fails())
        {
            return response()->json(['message' => 'Invalid Input','code' => 0],400);
        }

        $products = Product::where('id',$this->decryption($request->id))->delete();
        return response()->json(['message' => 'Product Deleted'],200);
    }

    public function getproductlist(Request $request)
    {
        $search = $request->search;
        $products = Product::all()->sortBy('product');
        if($search !="")
        {
            $products = Product::where('product','LIKE','%'.$search.'%')->get()->sortBy('product');
        }
        $data = [];
        foreach ($products as $value)
        {
            $temp                   = [];
            $temp['product']        = $value->product;
            $temp['price']          = $value->price;
            $temp['description']    = $value->description;
            $temp['ref']            = $this->encryption($value->id);
            $temp['ref1']           = $this->encryption($value->price);
            $data[]                 = $temp;
        }
        return response()->json(['data' => $data],200);
    }

    public function addproduct(Request $request)
    {
        $valid = Validator::make($request->all(),
        [
            'ref'       => 'required',
            'price'         => 'required',
        ]);

        if($valid->fails())
        {
            return response()->json(['message' => 'Invalid Input','code' => 0],400);
        }

        $array = array(

            'customerid'    => Session::get('customerid'),
            'product'       => $this->decryption($request->ref),
            'price'         => $this->decryption($request->price),
            'status'        => 'added',
        );

        $result = Card::create($array);
        if($result==true)
        {
            return response()->json(['message' => 'Product Added Successfully','code' => 1],200);
        }
    }

    public function getcardlist(Request $request)
    {
        $products = Card::join('products','products.id','cards.product')->select('products.product','cards.price')->where('cards.status','!=','placed')->get();
        $data = [];
        foreach ($products as $value)
        {
            $temp                = [];
            $temp['product']     = $value->product;
            $temp['price']       = $value->price;
            $data[]              = $temp;
        }
        return response()->json(['data' => $data],200);
    }

    public function customerlist(Request $request)
    {
        $customers = Customer::all();
        $data = [];
        foreach ($customers as $value)
        {
            $temp            = [];
            $temp['name']    = $value->name;
            $temp['email']   = $value->email;
            $data[]          = $temp;
        }
        return response()->json(['data' => $data],200);
    }

    public function orderlist(Request $request)
    {
        $customers = Customer::join('orders','orders.customerid','customers.id')->selectRaw('customers.name,customers.email,SUM(orders.price) as price')->groupBy('orders.orderid')->get();
        $data = [];
        foreach ($customers as $value)
        {
            $temp            = [];
            $temp['name']    = $value->name;
            $temp['email']   = $value->email;
            $temp['price']   = $value->price;
            $data[]          = $temp;
        }
        return response()->json(['data' => $data],200);
    }
}
