@extends('layouts.dashboard')

@section('title')
    Store Dashboard
@endsection

@section('content')
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <h2 class="dashboard-title">Dashboard</h2>
        <p class="dashboard-subtitle">Look what you have made today!</p>
        <div class="dashboard-content">
            <div class="row">
            <div class="col-md-4">
                <div class="card mb-2">
                <div class="card-body">
                    <div class="dashboard-card-title">Customer</div>
                    <div class="dashboard-card-subtitle">
                        {{($customer) }}
                        {{-- {{ number_format($customer) }} --}}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-2">
                <div class="card-body">
                    <div class="dashboard-card-title">Revenue</div>
                    <div class="dashboard-card-subtitle">$
                        {{ (number_format($revenue)) }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-2">
                <div class="card-body">
                    <div class="dashboard-card-title">Transaction</div>
                    <div class="dashboard-card-subtitle">{{ number_format($transactions_count) }}</div>
                </div>
                </div>
            </div>
            </div>
            <div class="row mt-3">
            <div class="col-12 mt-2">
                <h5 class="mb-3">Recent Transactions</h5>
                @forelse ($transactions_data as $transaction)
                    <a
                        href="{{ route('dashboard-transaction-detail', $transaction->id) }}"
                        class="card card-list d-block"
                    >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img
                                    src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                    alt=""
                                    class="w-100"
                                    />
                                </div>
                                <div class="col-md-3">{{ $transaction->product->name ?? '' }}</div>
                                <div class="col-md-3">{{ $transaction->transaction->user->name ?? '' }}</div>
                                <div class="col-md-3">{{ $transaction->transaction->updated_at ?? '' }}</div>
                                <div class="col-md-1 d-none d-md-block">
                                    <img
                                    src="/images/dashboard-arrow-right.svg"
                                    alt=""
                                    />
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-12 text-center py-5"
                        data-aos="fade-up"
                        data-aos-delay="100">
                        No Products Found in Transactions 
                    </div>
                @endforelse
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection