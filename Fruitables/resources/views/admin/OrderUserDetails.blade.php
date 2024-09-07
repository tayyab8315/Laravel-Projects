@extends('admin.include.master_file')
@section('title', 'Transaction Details')
@section('body')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary text-center rounded p-4">
                <h3 class="mb-4">Delivery Details of {{$user->first_name." ".$user->last_name}}</h3>
                
                @if(!empty($user))
                <div class="card text-white bg-dark mb-3">
                 
                    <div class="card-header">
                                  <h4 class="card-title">Order Number: {{ $user->order_number }}</h4>
                        <h4 class="card-title">Customer Mobile Number: {{ $user->mobile }}</h4>
                        <h4 class="card-title">Customer Email: {{ $user->email }}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Customer Country: {{ $user->country}}</p>
                        <p class="card-text">Customer CIty: {{ $user->city }}</p>
                        <p class="card-text">Customer Post/Zip: {{ $user->postcode}}</p>
                        <p class="card-text">Customer Complete Address: {{ $user->address }}</p>
                        <p class="card-text">Customer Company: {{ $user->company_name }}</p>
                        @php
                        if($user->ship_to_different_address==1){
                            $shipping = "Yes";
                        }else{
                            $shipping = "No";
                        }
                    @endphp
                 <p class="card-text">Ship To Same Address: {{$shipping}}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('Order.index') }}" class="btn btn-primary">Back to Dashboard</a>
                    </div>
                </div>
                @else
                <h4 class="card-title">No Details Found</h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
