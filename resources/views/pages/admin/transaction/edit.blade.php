@extends('layouts.admin')

@section('title')
    Transaction
@endsection

@section('content')
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Transaction</h2>
            <p class="dashboard-subtitle">Update Transaction</p>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('transaction.update', $item->id) }}" id="locations" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Transaction Status</label>
                                                <select 
                                                    name="transaction_status" 
                                                    v-model="transaction_status"
                                                    class="form-control">
                                                    <option 
                                                        v-for="status in transaction_status_data" 
                                                        :value="status">@{{ status }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Total Harga Transaksi</label>
                                                <input 
                                                    type="number" name="total_price" 
                                                    class="form-control" 
                                                    value="{{ $item->total_price }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">Save Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>

    <script>
      var locations = new Vue({
        el: "#locations",
        data: {
            transaction_status: '{{ $item->transaction_status }}',
            transaction_status_data: [
                'PENDING',
                'SHIPPING',
                'SUCCESS'
            ]
        },
      });
    </script>
@endpush