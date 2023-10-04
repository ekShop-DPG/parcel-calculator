<aside class="left-sidebar" style="background: #0a0303">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" style="background: #0a0303">
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark"
                        href="{{ url('dashboard') }}" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Dashboard </span>
                        </a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark"
                        href="{{ route('crete.company') }}" aria-expanded="false"><i class="mdi mdi-tune-vertical"></i><span
                            class="hide-menu">Create Company</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark"
                        href="{{ route('countryLists.show') }}" aria-expanded="false"><i class="mdi mdi-content-copy"></i><span
                            class="hide-menu">Add Country </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark"
                        href="{{ route('countrySettings.show') }}" aria-expanded="false"><i class="mdi mdi-inbox-arrow-down"></i><span
                            class="hide-menu">Create Parcel Service </span></a>

                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark"
                        href="{{ route('security.show') }}" aria-expanded="false"><i class="mdi mdi-inbox-arrow-down"></i><span
                            class="hide-menu">Security Settings </span></a>

                </li>
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark"
                    href="{{ route('api_users.view') }}" aria-expanded="false"><i class="mdi mdi-inbox-arrow-down"></i>
                    <span
                        class="hide-menu">Api User Lists
                    </span>
                    </a>

                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
