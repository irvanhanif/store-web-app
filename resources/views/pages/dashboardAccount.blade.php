@extends('layouts.dashboard')

@section('title')
    Account Settings
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
              <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-account') }}" id="locations" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">Your Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            value="{{ $user->name }}"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Your Email</label>
                          <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="{{ $user->email }}"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="addresOne">Address 1</label>
                          <input
                            type="text"
                            class="form-control"
                            id="addressOne"
                            name="address_on"
                            value="{{ $user->address_one }}"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="addresTwo">Address 2</label>
                          <input
                            type="text"
                            class="form-control"
                            id="addressTwo"
                            name="address_two"
                            value="{{ $user->address_two }}"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="province">Province</label>
                          <select 
                            name="provinces_id" 
                            id="province" 
                            class="form-control"
                            v-model="provinces_id"
                            >
                            <option value="" disabled>Select Province</option>
                            <option 
                              v-for="province in provinces" 
                              :value="province.id">@{{ province.name }}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="city">City</label>
                          <select 
                            name="regencies_id" 
                            id="city" 
                            class="form-control"
                            v-model="regencies_id"
                            >
                            <option value="" disabled>Select City</option>
                            <option 
                              v-for="regency in regencies" 
                              :value="regency.id">@{{ regency.name }}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="postalCode">Postal Code</label>
                          <input
                            type="text"
                            class="form-control"
                            id="postalCode"
                            name="zip_code"
                            value="{{ $user->zip_code }}"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="country">Country</label>
                          <input
                            type="text"
                            class="form-control"
                            id="country"
                            name="country"
                            value="{{ $user->country }}"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mobile">Mobile Phone</label>
                          <input
                            type="text"
                            class="form-control"
                            id="mobile"
                            name="phone_number"
                            value="{{ $user->phone_number }}"
                          />
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

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          AOS.init();
          this.getProvinces();
          if(this.provinces_id) {
            this.getRegencies();
          }
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: {{ $user->provinces_id ? $user->provinces_id : 0 }},
          regencies_id: {{ $user->regencies_id ? $user->regencies_id : 0 }},
        },
        methods: {
          getProvinces() {
            var self = this;
            axios.get('{{ route('api-provinces') }}')
            .then(response => {
              self.provinces = response.data;
            });
          },
          getRegencies() {
            var self = this;
            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
            .then(response => {
              console.log(response.data);
              self.regencies = response.data;
            });
          }
        },
        watch: {
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegencies();
          }
        }
      });
    </script>
@endpush