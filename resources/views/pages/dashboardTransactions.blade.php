@extends('layouts.dashboard')

@section('title')
    Store Dashboard Transactions
@endsection

@section('content')
    <div
        class="section-content section-dashboard-home"
        data-aos="fade-up"
    >
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">
                    Big result start from the small one
                </p>
                <div class="dashboard-content">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <ul
                                class="nav nav-pills mb-3"
                                id="pills-tab"
                                role="tablist"
                            >
                                <li class="nav-item" role="presentation">
                                    <button
                                    class="nav-link active"
                                    id="pills-sell-product-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#pills-sell-product"
                                    type="button"
                                    role="tab"
                                    aria-controls="pills-sell-product"
                                    aria-selected="true"
                                    >
                                    Sell Product
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button
                                    class="nav-link"
                                    id="pills-buy-product-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#pills-buy-product"
                                    type="button"
                                    role="tab"
                                    aria-controls="pills-buy-product"
                                    aria-selected="false"
                                    >
                                    Buy Product
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div
                                    class="tab-pane fade show active"
                                    id="pills-sell-product"
                                    role="tabpanel"
                                    aria-labelledby="pills-sell-product-tab"
                                    tabindex="0"
                                >
                                @forelse ($sellTransactions as $transaction)
                                    <a
                                        href="{{ route('dashboard-transaction-detail', $transaction->id) }}"
                                        class="card card-list d-block"
                                    >
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <img
                                                        src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                                        alt=""
                                                        class="w-100"
                                                    />
                                                </div>
                                                <div class="col-md-4">{{$transaction->product->name }}</div>
                                                <div class="col-md-3">{{ $transaction->product->user->store_name ? $transaction->product->user->store_name : $transaction->product->user->name}}</div>
                                                <div class="col-md-3">{{ $transaction->created_at }}</div>
                                                <div class="col-md-1 d-none d-md-block">
                                                    <img
                                                        src="{{ asset('images/dashboard-arrow-right.svg') }}"
                                                        alt=""
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    
                                @empty
                                    
                                @endforelse
                                </div>
                                <div
                                    class="tab-pane fade"
                                    id="pills-buy-product"
                                    role="tabpanel"
                                    aria-labelledby="pills-buy-product-tab"
                                    tabindex="0"
                                >
                                    @forelse ($buyTransactions as $transaction)
                                        <a
                                            href="{{ route('dashboard-transaction-detail', $transaction->id) }}"
                                            class="card card-list d-block"
                                        >
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <img
                                                            src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                                            alt=""
                                                            class="w-100"
                                                        />
                                                    </div>
                                                    <div class="col-md-4">{{$transaction->product->name }}</div>
                                                    <div class="col-md-3">{{ $transaction->product->user->store_name ? $transaction->product->user->store_name : $transaction->product->user->name}}</div>
                                                    <div class="col-md-3">{{ $transaction->created_at }}</div>
                                                    <div class="col-md-1 d-none d-md-block">
                                                        <img
                                                            src="{{ asset('images/dashboard-arrow-right.svg') }}"
                                                            alt=""
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        
                                    @empty
                                        
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
