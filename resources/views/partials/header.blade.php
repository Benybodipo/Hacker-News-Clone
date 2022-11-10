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
                        <a class="nav-link" aria-current="page" href="{{route('newstories')}}">New</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('comments')}}">Comments</a>
                    </li>
                    <li class="nav-item">
                        @auth
                            <a class="nav-link" href="{{route('get.submit')}}">Submit</a>
                        @else
                            <a class="nav-link" href="{{route('get.signin')}}">Submit</a>
                        @endauth
                    </li>
                </ul>
                @auth
                    <span class="nav-item" style="margin-right: 15px;">
                        <a href="{{route('get.signin')}}">
                            <i class="fa-solid fa-user" style="display: inline-block; margin-left: 5px;"></i>
                            {{auth()->user()->username}}
                        </a>
                    </span>
                    <span class="nav-item">
                        <form action="{{route('logout')}}" method="POST" class="nav-link">
                            <label for="logout-btn">
                                Logout
                                <i class="fa-solid fa-right-from-bracket"
                                style="display: inline-block; margin-left: 5px;"></i>
                            </label>
                            <button type="submit" id="logout-btn" style="display: none;"></button>
                            @csrf
                        </form>
                    </span>
                @else
                    <span class="nav-item">
                        <a href="{{route('get.signin')}}">
                            Login
                            <i class="fa-solid fa-right-to-bracket" style="display: inline-block; margin-left: 5px; transform: rotateZ(180deg);"></i>
                        </a>
                    </span>
                @endauth
            </div>
        </div>
    </nav>
</header>
