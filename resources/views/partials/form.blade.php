<div class="row">
    <form class="shadow rounded" method="{{$method}}">
        <h2 class="text-center mb-4">{{$action}}</h2>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
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