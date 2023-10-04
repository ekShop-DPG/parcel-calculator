@include('front.includes.header')

<body>
    {{-- Start Header Section --}}
    <header>
        <div class="nav__section">
            <img src="{{ asset('') }}/assets/front/image/dakbivag.png" alt="" class=" img-fluid">
        </div>
    </header>
    {{-- End Header Section --}}

    {{-- Start Main Content Section --}}
    @yield('content')
    {{-- End Main Content Section --}}

    {{-- Start Footer Section --}}
    <footer>
        <div class="container-fluid bg-light myfooter shadow" style="z-index: 999; !important; overflow: hidden;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 d-none d-sm-block" style="padding-top: 10px">
                        <p>Copyright © <a href="#" style="color:#D1120F;text-decoration:none">ekShop</a> All right reserved.</p>
                    </div>
                    <div class="col-lg-2 col-sm-12 text-center"><img
                            src="{{ asset('') }}/assets/front/image/postalfavicon.png" width="50px" alt=""></div>
                    <div class="col-sm-12 d-sm-none text-center">
                        <span class="pt-2">Copyright © <a class="footer_text" href="#" style="color:#D1120F;text-decoration:none">ekShop</a>
                        </span>
                    </div>
                    <div class="col-lg-5 d-none d-sm-block" style="padding-top: 10px; text-align: right">
                        <p>Replicated ❤ by <a accesskey="g" href="https://www.ekshop.gov.bd" target="_blank" style="color:#D1120F;text-decoration:none">ekShop</a>
                        </p>
                    </div>
                    <div class="d-sm-none col-sm-12" style="text-align: center">
                        <p>Replicated ❤ by <a href="https://www.ekshop.gov.bd" target="_blank" style="color:#D1120F;text-decoration:none">ekShop</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    {{-- Modal Section --}}
   @include('front.includes.modal')
    {{-- End Footer Section --}}

@include('front.includes.script')
</body>

</html>
