@extends('admin.include.master_file')
@section('title', 'Transaction Details')
@section('body')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary text-center rounded p-4">
                <h3 class="mb-4">Transaction Details for John Doe</h3>
                
                @if(!empty($transaction))
                <div class="card text-white bg-dark mb-3">
                 
                    <div class="card-header">
                        <h4 class="card-title">Paypal Transaction ID: {{ $transaction->payment_id }}</h4>
                        <h4 class="card-title">User Paypal ID: {{ $transaction->payer_id }}</h4>
                        <h4 class="card-title">User Paypal Email: {{ $transaction->payer_email }}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Order Number: {{ $transaction->order_number }}</h5>
                        <p class="card-text">Amount: {{ $transaction->amount }}</p>
                        <p class="card-text">Currency: {{ $transaction->currency }}</p>
                        <p class="card-text">Payment Status: {{ $transaction->payment_status }}</p>
                        <p class="card-text">Date: {{ $transaction->created_at }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('Order.index') }}" class="btn btn-primary">Back to Dashboard</a>
                    </div>
                </div>
                @else
                <h4 class="card-title">Order Is Not Yet Paid</h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
