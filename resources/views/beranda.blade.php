<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TYLUXE-SHOP</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('style/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="style/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('style/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">T</span>LUXE</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="{{ route('products.search') }}" method="GET" class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for products">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-transparent text-primary" id="search-button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="{{ route('cart.index') }}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">{{ session('cart_count', 0) }}</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">

            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">T</span>LUXE</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('beranda') }}" class="nav-item nav-link">Home</a>
                            <a href="{{ route('product.show') }}" class="nav-item nav-link active">Shop</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="{{ route('transaction.detail') }}" class="dropdown-item">History</a>
                                    <a href="{{ route('cart.index') }}" id="authButton"
                                        class="nav-item nav-link">Shopping Cart</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </div>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle"
                                    data-toggle="dropdown">Categories</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    @foreach ($categories as $item)
                                        <a href="{{ route('product.category', $item->id) }}"
                                            class="nav-item nav-link"
                                            style="margin-bottom: 5px;">{{ $item->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                            <a href="{{ route('profile') }}" class="nav-item nav-link">Profile</a>
                        </div>
                        <!-- Navbar -->
                        <div class="navbar-nav ml-auto py-0">
                            <a href="#" class="nav-item nav-link" data-toggle="modal"
                                data-target="#loginModal">Login</a>
                            <a href="#" class="nav-item nav-link" data-toggle="modal"
                                data-target="#registerModal">Register</a>
                        </div>

                        <!-- Modal Login -->
                        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog"
                            aria-labelledby="loginModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                                <div class="mb-3 d-flex">
                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link ml-auto"
                                                            href="{{ route('password.request') }}">
                                                            Forgot Your Password?
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary col-12">Login</button>
                                            <div class="mt-2 mb-3">
                                                <p class="text-center">
                                                    Belum Punya Akun?
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#registerModal" onclick="closeLoginModal()">
                                                        Register
                                                    </a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Register -->
                        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog"
                            aria-labelledby="registerModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="registerModalLabel">Register</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name') }}" required
                                                    autocomplete="name" autofocus>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="no_telp" class="form-label">Phone</label>

                                                <div class="col-md-6">
                                                    <input id="no_telp" type="number"
                                                        class="form-control @error('no_telp') is-invalid @enderror"
                                                        name="no_telp" value="{{ old('no_telp') }}" required
                                                        autocomplete="no_telp" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password-confirm" class="form-label">Confirm
                                                    Password</label>
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">
                                            </div>

                                            <button type="submit" class="btn btn-primary col-12">Register</button>
                                        </form>

                                        <div class="mt-2 mb-3">
                                            <p class="text-center">
                                                Sudah Punya Akun?
                                                <a href="#" data-toggle="modal" data-target="#loginModal"
                                                    onclick="closeRegisterModal()">
                                                    Login
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#authButton').click(function(e) {
                            e.preventDefault();
                            @if (session()->has('user'))
                                // Jika pengguna sudah masuk, lakukan aksi yang diinginkan (misalnya, pergi ke halaman keranjang)
                                window.location.href = "{{ route('cart.index') }}";
                            @else
                                // Jika pengguna belum masuk, tampilkan modal login
                                showLoginModal();
                            @endif
                        });

                        function showLoginModal() {
                            $('#loginModal').modal('show');
                        }
                    });

                    function closeLoginModal() {
                        $('#loginModal').modal('hide');
                    }

                    function closeRegisterModal() {
                        $('#registerModal').modal('hide');
                    }
                </script>

                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 450px;">
                            <img class="img-fluid" src="images/navbar.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 800px;">
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable</h3>
                                    <a href="{{ Route('product.show') }}" class="btn btn-light py-2 px-3">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 450px;">
                            <img class="img-fluid" src="images/header.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Trendy</h3>
                                    <a href="{{ Route('product.show') }}" class="btn btn-light py-2 px-3">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($product as $p)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div
                            class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ asset('storage/images/' . $p->image) }}"
                                alt="Product Image">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $p->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>${{ $p->price }}</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('product.detail', ['id' => $p->id]) }}"
                                class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                Detail</a>
                            <button onclick="showQuantityForm({{ $p->id }})"
                                class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                            <!-- Form untuk menambahkan produk ke keranjang -->

                            <!-- End of Form untuk menambahkan produk ke keranjang -->
                        </div>
                        <form method="post" action="{{ route('cart.add', ['product' => $p->id]) }}"
                            id="add-to-cart-form-{{ $p->id }}" style="display: none;">
                            @csrf
                            <div class="quantity-container text-left">
                                <label for="quantity">Jumlah:</label>
                                <input type="number" name="quantity" value="1" min="1">
                            </div>
                            <button type="submit" class="btn btn-default text-left btn-xs">Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function showQuantityForm(productId) {
            // Hide all quantity forms
            document.querySelectorAll('[id^="add-to-cart-form-"]').forEach(form => form.style.display = 'none');
            // Show the quantity form for the selected product
            document.getElementById('add-to-cart-form-' + productId).style.display = 'block';
        }
    </script>

    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('style/img/lv.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('style/img/prada.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('style/img/versace.jfif') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('style/img/celine.jfif') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('style/img/versace.jfif') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('style/img/dior.jfif') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('style/img/channel.jfif') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('style/img/baleciaga.jfif') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border border-white px-3 mr-1">T</span>LUXE</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum
                    dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name"
                                    required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe
                                    Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights
                    Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="style/lib/easing/easing.min.js"></script>
    <script src="style/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('style/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('style/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('style/js/main.js') }}"></script>
</body>

</html>
