@extends('layouts.dashboard')

@section('title')
    Store Settings
@endsection

@section('content')
  <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
  >
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Store Settings</h2>
        <p class="dashboard-subtitle">Make store that profitable</p>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-12">
              <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Toko</label>
                          <input 
                            name="store_name"
                            type="text" 
                            class="form-control" 
                            value="{{ $user->store_name ?? '' }}"
                            />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Kategori</label>
                          <select name="categories_id" class="form-control">
                            @if ($user->category == null)
                              <option value="" disabled>Select Category</option>
                            @else
                              <option value="{{ $user->category->id }}">Pilih jika tidak diganti ({{ $user->category->name }})</option>                                
                            @endif
                            @foreach ($categories as $category) 
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Store Status</label>
                          <p class="text-muted">
                            Apakah saat ini toko Anda buka?
                          </p>
                          <div class="form-check form-check-inline">
                            <input
                              type="radio"
                              name="store_status"
                              id="openStoreTrue"
                              class="form-check-input mt-1 border-dark-subtle"
                              value="1"
                              {{ $user->store_status == 1 ? 'checked' : '' }}
                            />
                            <label
                              for="openStoreTrue"
                              class="form-check-label"
                            >
                              Buka
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input
                              type="radio"
                              name="store_status"
                              id="openStoreFalse"
                              class="form-check-input mt-1 border-dark-subtle"
                              value="0"
                              {{ $user->store_status == 0 || $user->store_status == null ? 
                                'checked' : '' }}
                            />
                            <label
                              for="openStoreFalse"
                              class="form-check-label"
                            >
                              Sementara Tutup
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col text-right">
                        <button
                          type="submit"
                          class="btn btn-success px-5"
                        >
                          Save Now
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection