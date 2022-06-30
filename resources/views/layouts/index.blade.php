    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('index/assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('index/assets/css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{asset('index/assets/css/templatemo-softy-pinko.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{asset('assets/css/chosen.min.css')}}" rel="stylesheet">
        {{-- <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}"> --}}
        <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
        {{-- <script src="{{asset('assets/js/bootstrap.4.3.1.min.js')}}"></script> --}}
        <script src="{{asset('assets/js/jquery.nicescroll.min.js')}}"></script>
        <script src="{{asset('assets/js/moment.min.js')}}"></script>
        </head>
        <body>
        <header class="header-area header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <a href="#" class="logo">
                                <h3 class="text-center">Selamat Datang di YPR Cell</h3>
                            </a>
                            <ul class="nav">
                                {{-- <li><a href="#welcome" >Beranda</a></li> --}}
                                <li><a href="#isipulsa">Isi Pulsa</a></li>
                                <li><a href="#aksesoris">Beli Aksesoris</a></li>
                            </ul>
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="welcome-area" id="welcome">
        </div>
        <section class="section padding-top-70 padding-bottom-0" id="isipulsa">
            <h6 class="text-center">Lihat paling bawah untuk melihat total harga transaksi.</h6><br>
            @include('layouts.transaksi.index')
        </section>
        <div class="container padding-top-70">
            <div class="alert" style="max-width: 50%">
                <div class="form-group mb-0">
                    {{-- <label for="tempat_lahir">Total Keseluruhan : Rp. {{$transaksitotal}} </label> --}}
                </div>
            </div>
        </div>
        </div>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-bottom-fix">
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5 col-md-12 col-sm-12 align-self-center mobile-bottom-fix-big" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    </div>
                </div>
            </div>
        </section>
        @include('sweetalert::alert')
        <script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{asset('index/assets/js/popper.js')}}"></script>
        <script src="{{asset('index/assets/js/bootstrap.min.js')}}"></script>
        <!-- Plugins -->
        <script src="{{asset('index/assets/js/scrollreveal.min.js')}}"></script>
        <script src="{{asset('index/assets/js/waypoints.min.js')}}"></script>
        <script src="{{asset('index/assets/js/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('index/assets/js/imgfix.min.js')}}"></script>
        <!-- Global Init -->
        <script src="{{asset('index/assets/js/custom.js')}}"></script>
    </body>
    </html>

