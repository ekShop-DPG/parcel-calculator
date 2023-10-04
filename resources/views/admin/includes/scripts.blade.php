
<script src="{{ asset('') }}/assets/back/js/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('') }}/assets/back/js/popper.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="{{ asset('') }}/assets/back/js/app.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/app.init.mini-sidebar.js"></script>
<!-- Theme settings -->
<script src="{{ asset('') }}/assets/back/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('') }}/assets/back/js/perfect-scrollbar.jquery.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/sparkline.js"></script>
<!--Wave Effects -->
<script src="{{ asset('') }}/assets/back/js/waves.js"></script>
<!--Menu sidebar -->
<script src="{{ asset('') }}/assets/back/js/sidebarmenu.js"></script>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/af-2.3.7/b-2.0.1/r-2.2.9/sc-2.0.5/sb-1.3.0/datatables.min.js"></script>
<!--Custom JavaScript -->
<script src="{{ asset('') }}/assets/back/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="{{ asset('') }}/assets/back/js/d3.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/c3.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/Chart.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/gauge.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/excanvas.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/jquery.flot.js"></script>
<script src="{{ asset('') }}/assets/back/js/jquery.flot.tooltip.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{ asset('') }}/assets/back/js/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{ asset('') }}/assets/back/js/dashboard2.js"></script>
<script src="{{ asset('') }}/assets/back/js/custom.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#companyServices').DataTable();
        $('#countrytable').DataTable();
        $('#countrySettings').DataTable({
            "scrollX": true,
        });
        var path = window.location.href;
        $('.nav a').each(function() {
            if (this.href === path) {
                $(this).addClass('active');
                $(this).parent("li").addClass("active");
            }
        });
    })
</script>
