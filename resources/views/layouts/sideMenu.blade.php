<div class="col-md-2">
    <nav class="navbar nav-tabs" id="sidebar">
        <ul class="navbar-nav nav">
            <li class="nav-item nav-profile border-bottom ">
                <a href="#" class="nav-link flex-column">
                    <div class="row">
                        <div class="col-sm-4 col-md-4"></div>
                        <div class="col-sm-4  col-md-4 nav-profile-image">
                            <img src="{{ asset('image/face1.jpg') }}" alt="profile">
                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="col-sm-4  col-md-4"></div>
                    </div>
                    <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                        <span class="text-secondary icon-sm text-center">{{ Auth::user()->name }}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item pt-3 active">
                <a class="nav-link active" href="#">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Customers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Prodcuts</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
