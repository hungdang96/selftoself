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
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">Home</a>
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