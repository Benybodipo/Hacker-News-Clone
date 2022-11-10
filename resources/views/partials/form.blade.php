<div class="row">
    <form class="shadow rounded" method="{{$method}}" action="{{$route}}">
        @if (strtolower($method) == 'post')
            @csrf
        @endif
        <h2 class="text-center mb-4">{{$action}}</h2>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" >
            @error('username') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        @if (strtolower($action) == 'create account')
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        @endif
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        @if (strtolower($action) == 'create account')
            <div class="mb-3">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password">
                @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        @endif
        @if (strtolower($action) == 'login')
          <div class="pl-0 mb-3">
            <span>
              Don't have an naccount? <a href="{{route('get.signup')}}" style="text-decoration: underline;">Signup</a>
            </span>
          </div>
        @endif
        <button type="submit" class="btn ">{{$action}}</button>
    </form>
</div>
