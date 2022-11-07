<header>
    <nav class="navbar  navbar-dark bg-dark navbar-expand-md bg-faded justify-content-center">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}#">HN Clone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">New</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Past</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ask</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Show</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Submit</a>
                    </li>
                </ul>
                
                <span class="nav-item">
                    <a href="{{route('get.signin')}}">
                        Login
                        <i class="fa-solid fa-right-to-bracket" style="display: inline-block; margin-left: 5px;"></i>
                    </a>
                </span>
            </div>
        </div>
    </nav>
</header>