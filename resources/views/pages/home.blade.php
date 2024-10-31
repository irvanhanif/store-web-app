@extends('layouts.app')

@section('title')
    Store Homepage
@endsection

@section('content')
    <div class="page-content page-home">
        <section class="store-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div
                        id="storeCarousel"
                        class="carousel slide"
                        data-ride="carousel"
                    >
                    <div class="carousel-indicators">
                        <button
                            class="active"
                            data-bs-target="#storeCarousel"
                            data-bs-slide-to="0"
                        ></button>
                        <button
                            data-bs-target="#storeCarousel"
                            data-bs-slide-to="1"
                        ></button>
                        <button
                        data-bs-target="#storeCarousel"
                        data-bs-slide-to="2"
                        ></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img
                            src="./images/banner.jpg"
                            alt="Carousel Image"
                            class="d-block w-100"
                        />
                        </div>
                        <div class="carousel-item">
                        <img
                            src="./images/banner.jpg"
                            alt="Carousel Image"
                            class="d-block w-100"
                        />
                        </div>
                        <div class="carousel-item">
                        <img
                            src="./images/banner.jpg"
                            alt="Carousel Image"
                            class="d-block w-100"
                        />
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Trend Categories</h5>
                    </div>
                </div>
                <div class="row">
                    @php
                        $incrementCategory = 0;
                    @endphp

                    @forelse ($categories as $category)
                        <div
                            class="col-6 col-md-3 col-lg-2"
                            data-aos="fade-up"
                            data-aos-delay="{{ $incrementCategory += 100 }}"
                        >
                            <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                                <div class="categories-image">
                                    <img
                                    src="{{ Storage::url($category->photo) }}"
                                    class="w-100"
                                    alt=""
                                    />
                                </div>
                            <p class="categories-text">{{ $category->name }}</p>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5"
                            data-aos="fade-up"
                            data-aos-delay="100">
                            No Categories Found
                        </div>
                    @endforelse

                    {{-- <div
                        class="col-6 col-md-3 col-lg-2"
                        data-aos="fade-up"
                        data-aos-delay="200"
                    >
                        <a href="#" class="component-categories d-block">
                        <div class="categories-image">
                            <img
                            src="./images/categories-furniture.svg"
                            class="w-100"
                            alt=""
                            />
                        </div>
                        <p class="categories-text">Furniture</p>
                        </a>
                    </div>

                    <div
                        class="col-6 col-md-3 col-lg-2"
                        data-aos="fade-up"
                        data-aos-delay="300"
                    >
                        <a href="#" class="component-categories d-block">
                        <div class="categories-image">
                            <img
                            src="./images/categories-makeup.svg"
                            class="w-100"
                            alt=""
                            />
                        </div>
                        <p class="categories-text">Make Up</p>
                        </a>
                    </div>

                    <div
                        class="col-6 col-md-3 col-lg-2"
                        data-aos="fade-up"
                        data-aos-delay="400"
                    >
                        <a href="#" class="component-categories d-block">
                        <div class="categories-image">
                            <img
                            src="./images/categories-sneaker.svg"
                            class="w-100"
                            alt=""
                            />
                        </div>
                        <p class="categories-text">Sneaker</p>
                        </a>
                    </div>

                    <div
                        class="col-6 col-md-3 col-lg-2"
                        data-aos="fade-up"
                        data-aos-delay="500"
                    >
                        <a href="#" class="component-categories d-block">
                        <div class="categories-image">
                            <img
                            src="./images/categories-tools.svg"
                            class="w-100"
                            alt=""
                            />
                        </div>
                        <p class="categories-text">Tools</p>
                        </a>
                    </div>

                    <div
                        class="col-6 col-md-3 col-lg-2"
                        data-aos="fade-up"
                        data-aos-delay="600"
                    >
                        <a href="#" class="component-categories d-block">
                        <div class="categories-image">
                            <img
                            src="./images/categories-baby.svg"
                            class="w-100"
                            alt=""
                            />
                        </div>
                        <p class="categories-text">Baby</p>
                        </a>
                    </div> --}}
                </div>
            </div>
        </section>

        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>New Products</h5>
                    </div>
                </div>
                <div class="row">
                    @php
                        $incrementProduct = 0;
                    @endphp
                    @forelse ($products as $product)
                        <div
                            class="col-6 col-md-4 col-lg-3"
                            data-aos="fade-up"
                            data-aos-delay="{{ $incrementProduct += 100 }}"
                        >
                            <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div
                                        class="products-image"
                                        style="
                                            @if($product->galleries->count())
                                                background-image: url('{{ Storage::url($product->galleries->first()->photos) }}');
                                            @else
                                                background-color: #eee
                                            @endif
                                        "
                                    ></div>
                                </div>
                                <div class="products-text">{{ $product->name }}</div>
                                <div class="products-price">${{ number_format($product->price) }}</div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5"
                            data-aos="fade-up"
                            data-aos-delay="100">
                            No Products Found
                        </div>
                    @endforelse
                    {{--<div
                        class="col-6 col-md-4 col-lg-3"
                        data-aos="fade-up"
                        data-aos-delay="400"
                    >
                        <a href="" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div
                            class="products-image"
                            style="
                                background-image: url('./images/products-bubuk-maketti.jpg');
                            "
                            ></div>
                        </div>
                        <div class="products-text">Bubuk Maketti</div>
                        <div class="products-price">$225</div>
                        </a>
                    </div>
                    <div
                        class="col-6 col-md-4 col-lg-3"
                        data-aos="fade-up"
                        data-aos-delay="500"
                    >
                        <a href="" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div
                            class="products-image"
                            style="
                                background-image: url('./images/products-tatakan-gelas.jpg');
                            "
                            ></div>
                        </div>
                        <div class="products-text">Tatakan Gelas</div>
                        <div class="products-price">$45,184</div>
                        </a>
                    </div>
                    <div
                        class="col-6 col-md-4 col-lg-3"
                        data-aos="fade-up"
                        data-aos-delay="600"
                    >
                        <a href="" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div
                            class="products-image"
                            style="
                                background-image: url('./images/products-mavic-kawe.jpg');
                            "
                            ></div>
                        </div>
                        <div class="products-text">Mavic Kawe</div>
                        <div class="products-price">$503</div>
                        </a>
                    </div>
                    <div
                        class="col-6 col-md-4 col-lg-3"
                        data-aos="fade-up"
                        data-aos-delay="700"
                    >
                        <a href="" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div
                            class="products-image"
                            style="
                                background-image: url('./images/products-black-edition-nike.jpg');
                            "
                            ></div>
                        </div>
                        <div class="products-text">Black Edition Nike</div>
                        <div class="products-price">$70,482</div>
                        </a>
                    </div>
                    <div
                        class="col-6 col-md-4 col-lg-3"
                        data-aos="fade-up"
                        data-aos-delay="800"
                    >
                        <a href="" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div
                            class="products-image"
                            style="
                                background-image: url('./images/products-monkey-toys.jpg');
                            "
                            ></div>
                        </div>
                        <div class="products-text">Monkey Toys</div>
                        <div class="products-price">$783</div>
                        </a>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>
@endsection