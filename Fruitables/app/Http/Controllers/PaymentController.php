<?php

namespace App\Http\Controllers;

use Omnipay\Omnipay;
use App\Models\order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $gateway;

 
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); // Or false for live transactions
    }

    public function payment(Request $request)
    {
        
        try {
            // dd(env('PAYPAL_CLIENT_ID'),env('PAYPAL_CLIENT_SECRET'));
            $response = $this->gateway->purchase([
                'amount' => $request->input('Price'),
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('payment/success?order_number='.$request->input('order_number')),
                'cancelUrl' => url('payment/error'),

            ])->send();

            if ($response->isRedirect()) {
                $response->redirect(); // This will redirect the user to PayPal
            } else {
                return view('user.TransactionError', ['transerror' => $response->getMessage()]);
            }
        } catch (\Exception $e) {
            return view('user.TransactionError', ['transerror' => $e->getMessage()]);
        }
    }

    public function success(Request $request)
    {
        if ($request->input("paymentId") && $request->input("PayerID")) {
            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->input("PayerID"),
                'transactionReference' => $request->input("paymentId")
            ]);
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $paymentdata = $response->getData();
                $orderNumber = $request->input('order_number');

                $Payment = Payment::create([
                    'payment_id' => $paymentdata['id'],
                    'payer_id' => $paymentdata['payer']['payer_info']['payer_id'],
                    'payer_email' => $paymentdata['payer']['payer_info']['email'],
                    'amount' => $paymentdata['transactions'][0]['amount']['total'],
                    'currency' => env('PAYPAL_CURRENCY'),
                    'payment_status' => $paymentdata['state'],
                    'order_number' => $orderNumber,
                ]);
                $order = Order::where('order_number', $orderNumber)->first();
                $order->update([
                    'order_confirmed_at'=>now(),
                ]);
                return view('user.TransactionSuccessfull', ['transid' => $paymentdata['id'],'ordernum' =>$orderNumber]);
            } else {
                return view('user.TransactionError', ['transerror' => $response->getMessage()]);
            }
        } else {
            return view('user.TransactionDeclined');
        }
    }

    public function error()
    {
        return view('user.TransactionUnSuccessfull');
    }
}
