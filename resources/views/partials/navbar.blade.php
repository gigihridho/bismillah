<section class="h-100 w-100 bg-white" style="box-sizing: border-box">
<div class="container-xxl mx-auto p-0  position-relative header-2-2" style="font-family: 'Poppins', sans-serif">
    <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
    <a href="#">
        <img style="margin-right: 0.75rem"
            src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header2/Header-2-5.png" alt="" />
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal" data-bs-target="#targetModal-item">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog"
        aria-labelledby="targetModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-white border-0">
            <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                <a class="modal-title" id="targetModalLabel">
                <img style="margin-top: 0.5rem"
                    src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header2/Header-2-5.png"
                    alt="" />
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Feature</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang</a>
                </li>
                </ul>
            </div>
            <div class="modal-footer border-0 gap-3" style="padding: 2rem; padding-top: 0.75rem">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-fill text-white">Masuk</a>
                @endguest
            </div>
            </div>
        </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Feature</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
        <div class="gap-3">
            @guest
                <a href="{{ route('login') }}" class="btn btn-fill text-white">Masuk</a>
            @endguest
        </div>
        </div>
    </nav>
</div>
</section>

