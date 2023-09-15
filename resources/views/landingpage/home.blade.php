@extends('layouts.landingpage.app')

@section('content')
    <div id="carrouselBanner" class="carousel slide half-height-carousel" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($carrousels as $key => $c)
                @if ($key == 0)
                    <div class="carousel-item active">
                        <img src="{{ $c }}" class="d-block w-100 carousel-img" alt="Banner">
                    </div>
                @else
                    <div class="carousel-item">
                        <img src="{{ $c }}" class="d-block w-100 carousel-img" alt="Banner">
                    </div>
                @endif
            @endforeach
        </div>
        <ol class="carousel-indicators">
            @foreach ($carrousels as $key => $c)
                @if ($key == 0)
                    <li data-target="#carrouselBanner" data-slide-to="{{ $key }}" class="active">
                        <i class="fas fa-circle" style="color: #008B8B;"></i>
                    </li>
                @else
                    <li data-target="#carrouselBanner" data-slide-to="{{ $key }}">
                        <i class="fas fa-circle" style="color: #008B8B;"></i>
                    </li>
                @endif
            @endforeach
        </ol>
        <a class="carousel-control-prev" href="#carrouselBanner" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carrouselBanner" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container mt-4">
        <div class="card feature-card shadow-md" style="color: #008B8B;">
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($features as $key => $f)
                        <div class="col-sm-6 col-md-3 d-flex align-items-center">
                            <i class="{{ $key }} feature-icon"></i>
                            <h6 class="card-title ml-2 text-justify text-capitalize">{{ $f }}</h6>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-3">
                    <a href="{{ route('landingpage.show', 'test') }}" style="text-decoration: none">
                        <div class="text-center">
                            <img src="{{ asset($category->category_image) }}" alt="{{ $category->category_name }}"
                                class="img-fluid rounded">
                            <h5 class="mt-3">{{ $category->category_name }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container mt-4 flash-sale-section">
        <div class="text-center">
            <h2 class="section-title-light">Promo</h2>
        </div>
        <div class="row">
            @foreach ($discount_products as $discount_product)
                <div class="col-md-3 col-6 flash-sale p-2">
                    <div class="card">
                        {!! $discount_product['stock'] !!}
                        <div class="product-cart">
                            <a href="javascript:void(0);" onclick="cartModal({{ $discount_product['slug'] }})"
                                class="text-light" style="text-decoration: none;">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                        <img src="{{ $discount_product['image'] }}" style="height: 150px;" class="card-img-top">
                        <div class="card-body">
                            <h6 class="card-title text-capitalize">{{ Str::limit($discount_product['name'], 30) }}</h6>
                            {!! $discount_product['price'] !!}
                        </div>
                    </div>
                </div>
            @endforeach
            @if (count($discount_products) >= 7)
                <div class="col-md-3 col-6 text-center p-2">
                    <a href="{{ route('landingpage.show', 'test') }}?jenis_produk=promotion"
                        style="text-decoration: none;">
                        <div class="card-see-all d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-angles-right fa-4x"></i>
                            <p class="mt-2">Lihat Semua<br>Produk Diskon</p>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-4">
        <div class="text-center">
            <h2 class="section-title">Produk Baru</h2>
        </div>
        <div class="row">
            @foreach ($new_arrive_products as $new_arrive_product)
                <div class="col-md-3 col-6 product p-2">
                    <div class="card">
                        {!! $new_arrive_product['stock'] !!}
                        <div class="product-cart">
                            <a href="javascript:void(0);" onclick="cartModal({{ $new_arrive_product['slug'] }})"
                                class="text-light" style="text-decoration: none;">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                        <img src="{{ $new_arrive_product['image'] }}" style="height: 150px;" class="card-img-top">
                        <div class="card-body">
                            <h6 class="card-title text-capitalize">{{ Str::limit($new_arrive_product['name'], 30) }}</h6>
                            {!! $discount_product['price'] !!}
                        </div>
                    </div>
                </div>
            @endforeach
            @if (count($new_arrive_products) >= 7)
                <div class="col-md-3 product col-6 text-center p-2">
                    <a href="{{ route('landingpage.show', 'test') }}?jenis_produk=new_arrive" style="text-decoration: none;">
                        <div class="card-see-all d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-angles-right fa-4x"></i>
                            <p class="mt-2">Lihat Semua<br>Produk Baru</p>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
    {{-- <div class="container mt-4">
        <div class="text-center">
            <h2 class="section-title">Produk D'Lisa</h2>
        </div>
        <div class="row">
            @foreach ($produk as $pp)
                <div class="col-md-3 col-6 product p-2">
                    <div class="card">
                        {!! $pp->stok !!}
                        <div class="product-cart">
                            <a href="javascript:void(0);" onclick="cartModal({{ $pp->id_produk }})" class="text-light"
                                style="text-decoration: none;">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                        <img src="{{ $pp->gambar_produk }}" style="height: 150px;" class="card-img-top">
                        <div class="card-body">
                            <h6 class="card-title text-capitalize">{{ Str::limit($pp->nama_produk, 30) }}</h6>
                            <p class="card-text">
                                @if ($pp->harga_diskon != null && $pp->harga_diskon >= 0)
                                    <del class="text-warning font-weight-bold">@currency($pp->harga_jual)</del> <!-- Harga asli -->
                                    <strong class="text-light">@currency($pp->harga_jual - $pp->harga_diskon)</strong> <!-- Harga diskon -->
                                @else
                                    <strong class="text-light">@currency($pp->harga_jual)</strong>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Kolom Lihat Semua -->
            <div class="col-md-3 product col-6 text-center p-2">
                <a href="{{ route('products') }}" style="text-decoration: none;">
                    <div class="card-see-all d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-angles-right fa-4x"></i>
                        <p class="mt-2">Lihat Semua<br>Produk D'Lisa</p>
                    </div>
                </a>
            </div>
        </div>
    </div> --}}
    {{-- Modal --}}
    <div class="modal fade modal-add-to-cart" id="addToCartModal" tabindex="-1" role="dialog"
        aria-labelledby="addToCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #008B8B; color: #fff;">
                    <h5 class="modal-title" id="addToCartModalLabel">Tambahkan ke Keranjang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body"></div>
            </div>
        </div>
    </div>
@endsection
