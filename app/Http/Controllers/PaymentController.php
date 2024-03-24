<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // dd($request->all());
        $data = $request->all();

        $payment = Payment::create([
            'order_id' => rand(),
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
            'price' => $data['price'],
            'status' => 'pending',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $admin = Auth::guard('admin')->user();

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $data['price'],
            ),
            'customer_details' => array(
                'first_name' => $admin->name,
                'email' => $admin->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $payment->snap_token = $snapToken;
        $payment->save();

        return redirect()->route('checkout', $payment->id);
    }

    public function checkout($id)
    {
        $payment = Payment::find($id);

        $products = Product::all();
        $product = $products->where('id', $payment->product_id)->first();
        // dd($product);

        return view('transaction.checkout', compact('payment', 'product'));
    }


    public function success(Payment $payment)
    {
        $admin = Auth::guard('admin')->user();

        $payment->status = 'success';
        $payment->order_id = rand();
        $payment->user_id = $admin->id;
        $payment->product_id = $admin->product_id;
        $payment->price = $admin->product->harga;
        $payment->save();

        return view('transaction.checkout-success', compact('payment'));
    }
}
