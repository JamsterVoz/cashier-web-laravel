@extends('components.body')

@section('css')
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-wizard.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-number-input.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Checkout</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="w-75 float-end">
                            {{-- {{ Route('func-checkout') }} --}}
                            <form action="" method="post">
                            @csrf
                                <input type="disable" class="hidden" name="receipt_id" value="{{ $receipt->id }}" />
                                <select class="form-select" name="produk_id" id="" onchange="this.form.submit()">
                                    <option hidden selected>Tambah Produk</option>
                                    @foreach ($produk as $data)
                                        <option value="{{ $data['id'] }}">{{ $data['nama_produk'] }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="bs-stepper checkout-tab-steps">
                    <!-- Wizard starts -->
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#step-cart" role="tab" id="step-cart-trigger">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="shopping-cart" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Cart</span>
                                    <span class="bs-stepper-subtitle">Your Cart Items</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                    </div>
                    <!-- Wizard ends -->

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger mt-1">
                                <span class="my-1 fs-4 p-1">{{ $error }}</span>
                            </div>
                        @endforeach
                    @endif

                    <div class="bs-stepper-content">
                        <!-- Checkout Place order starts -->
                        <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
                            <div id="place-order" class="list-view product-checkout">
                                <!-- Checkout Place Order Left starts -->
                                <div class="checkout-items">
                                    @foreach ($checkout as $item)
                                        <div class="card ecommerce-card">
                                            <div class="item-img">
                                                <img src="{{ asset('foto_produk/' . $item->produk->foto_produk) }}"
                                                    alt="img-placeholder" />
                                            </div>
                                            <div class="card-body">
                                                <div class="item-name">
                                                    <h6 class="mb-0"><a href="app-ecommerce-details.html"
                                                            class="text-body">{{ $item->produk->nama_produk }}</a></h6>
                                                    <span class="item-company">By <spanclass="manual-space text-primary fw-bold">Apple</spanclass=></span>
                                                </div>
                                                <span class="text-success mb-1">Stock:<span
                                                        class="manual-space">{{ $item->produk->stok_produk }}</span></span>
                                                <div class="item-quantity">
                                                    <span class="quantity-title me-1">Quantity:</span>
                                                    <div class="quantity-counter-wrapper">
                                                        {{-- {{ Route('func-quantity', [$item->id]) }} --}}
                                                        <form action="" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="input-group quantity-input">
                                                                <input type="number" class="form-control text-center"
                                                                    name="quantity_produk"
                                                                    value="{{ $item->quantity_produk }}" min="1" max="{{ $item->produk->stok_produk }}"
                                                                    onkeyup="enforceMinMax(this)" onchange="this.form.submit()" />
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-options text-center">
                                                <div class="item-wrapper">
                                                    <div class="item-cost">
                                                        <h4 class="item-price">Rp {{ number_format($item->produk->harga_produk, 2, ',', '.') }}</h4>
                                                    </div>
                                                </div>
                                                {{-- {{ Route('func-delete', $item->id) }} --}}
                                                <form action="" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light mt-1 w-100">
                                                        <i data-feather="x" class="align-middle me-25"></i>
                                                        <span>Remove</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Checkout Place Order Left ends -->

                                <!-- Checkout Place Order Right starts -->
                                <div class="checkout-options">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="price-details">
                                                {{-- {{ Route('func-receipt' , $receipt->id) }} --}}
                                                <form action="" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <h6 class="price-title mt-1">Nama pembeli</h6>
                                                    <input type="text" class="form-control pembeli" name="nama_pembeli" placeholder="Masukan nama pembeli" required>
                                                    <hr />
                                                    <h6 class="price-title">Price Details</h6>
                                                    <ul class="list-unstyled">
                                                        @foreach ($checkout as $item)
                                                            <li class="price-detail">
                                                                <div class="detail-title">{{ $item->produk->nama_produk }} x {{$item->quantity_produk}}</div>
                                                                <div class="detail-amt">Rp {{ number_format($item->produk->harga_produk * $item->quantity_produk, 2, ',', '.') }}</div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <hr />
                                                    <ul class="list-unstyled">
                                                        <li class="price-detail">
                                                            <div class="detail-title detail-total">Total</div>
                                                            <div class="detail-amt fw-bolder">Rp {{ number_format($total_harga, 2, ',', '.') }}</div>
                                                        </li>
                                                    </ul>
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 btn-next place-order">Place Order
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Checkout Place Order Right ends -->
                                </div>
                            </div>
                            <!-- Checkout Place order Ends -->
                        </div>
                        <!-- Checkout Place order starts -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('script')
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-ecommerce-checkout.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
@endsection