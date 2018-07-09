<nav class="navbar navbar-expand-sm navbar-light bg-light mb-3">
    <a class="navbar-brand" href="{{route('welcome')}}">Self2Self</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Tin tức</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">FAQs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Giới thiệu</a>
        </li>
    </ul>
    <ul class="navbar-nav">
        @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-info-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('profileDetail', Auth::user()->userid)}}">Thông tin</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Đăng xuất
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Đăng nhập</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">Đăng ký</a>
            </li>
        @endauth
    </ul>
</nav>