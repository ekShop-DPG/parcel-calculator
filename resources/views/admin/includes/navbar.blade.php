{{-- <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
      <a href="/" target="_blank">Visit Site</a>
      <div class="navbar-wrapper">
        <div class="navbar-toggle">
          <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </button>
        </div>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" style="column-gap: 10px" id="navigation">
        <form>
          <div class="input-group no-border">
            <input type="text" value="" class="form-control" placeholder="Search...">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="nc-icon nc-zoom-split"></i>
              </div>
            </div>
          </div>
        </form>
        <div class="settings">
          <a href="#" style="font-size:20px; color:green" data-toggle="modal" data-target="#settingsModal">
            <i class=" nc-icon nc-settings-gear-65"></i>
          </a>
        </div>
        <ul class="navbar-nav">
          @auth
          <li class="nav-item">
            <form method="post" action="{{ route('admin.signout') }}">
              @csrf
              <button type="submit" style="color:brown; border:none;outline:none;font-size:20px;font-weight:bold;background:transparent"><i class=" nc-icon nc-button-power"></i></button>
          </form>
        </li> 
          @endauth
        </ul>
      </div>
    </div>
  </nav>
  <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">General Settings</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('general_settings') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="mb-3 form-group">
                        <label class="form-label">Delivery Days</label>
                        <input type="text" placeholder=" day-day" class=" form-control" name="delivery_days">
                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-10 mx-auto">
                    <div class="mb-3 form-group">
                        <label class="form-label">Parcel Post Capacity</label>
                        <input type="number" placeholder=" Parcel Post Capacity" class=" form-control" name="parcelPost_capacity">
                        @error('parcelPost_capacity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-10 mx-auto">
                    <div class="mb-3 form-group">
                        <label class="form-label">Letter Post Capacity</label>
                        <input type="text" placeholder=" Latter Post Capacity" class=" form-control" name="letterPost_capacity">
                        @error('letterPost_capacity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-10 mx-auto">
                    <div class="mb-3 form-group">
                        <label class="form-label">Vat Amount %</label>
                        <input type="text" placeholder=" Enter Vat Amount" class=" form-control" name="vat">
                        @error('vat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info" style=" margin-left:40px">Submit</button>
        </form>
        </div>
      </div>
    </div>
</div> --}}


<nav class="navbar top-navbar navbar-expand-md navbar-dark">
  <div class="navbar-header" style="background: #0a0303">
      <!-- This is for the sidebar toggle which is visible on mobile only -->
      <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
      <!-- ============================================================== -->
      <!-- Logo -->
      <!-- ============================================================== -->
      <a class="navbar-brand" href="index.html">
          <!-- Logo icon -->
          <b class="logo-icon">
              <!-- Light Logo icon -->
              <img src="{{asset('')}}/assets/back/img/logo-light-icon.png" alt="homepage" class="light-logo" />
          </b>
          <!--End Logo icon -->
      </a>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Toggle which is visible on mobile only -->
      <!-- ============================================================== -->
      <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
  </div>
  <!-- ============================================================== -->
  <!-- End Logo -->
  <!-- ============================================================== -->
  <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <!-- ============================================================== -->
      <!-- toggle and nav items -->
      <!-- ============================================================== -->
      <ul class="navbar-nav float-left mr-auto">
          <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- create new -->
          <!-- ============================================================== -->
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
               <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/create/company">Company</a>
                  <a class="dropdown-item" href="/add/country">Country</a>
                  <a class="dropdown-item" href="/view/parcel-service">Parcel Service</a>
                  <a class="dropdown-item" href="/settings/security">Security Settings</a>
              </div>
          </li>
      </ul>
      <!-- ============================================================== -->
      <!-- Right side toggle and nav items -->
      <!-- ============================================================== -->
      <ul class="navbar-nav float-right">
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Messages -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- End Messages -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- User profile and search -->
          <!-- ============================================================== -->
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('') }}/assets/back/img/profile.png" alt="user" class="rounded-circle" width="31"></a>
              <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                  <span class="with-arrow"><span class="bg-primary"></span></span>
                  <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                      <div class=""><img src="{{ asset('') }}/assets/back/img/profile.png" alt="user" class="img-circle" width="60"></div>
                      <div class="m-l-10">
                          <h4 class="m-b-0">{{ auth()->user()->username }}</h4>
                          <p class=" m-b-0">{{ auth()->user()->email }}</p>
                      </div>
                  </div>
                  <ul class="navbar-nav">
                    @auth
                    <li class="nav-item">
                      <form method="post" action="{{ route('admin.signout') }}">
                        @csrf
                        <button type="submit" class=" btn btn-block btn-danger">Logout</button>
                    </form>
                  </li> 
                    @endauth
                  </ul>
              </div>
          </li>
          <!-- ============================================================== -->
          <!-- User profile and search -->
          <!-- ============================================================== -->
      </ul>
  </div>
</nav>