@extends('layouts.main')
@section('content')
    <div class="row">
        @for ($i = 0; $i < 10; $i++)
            <div class="col-sm-12 comment rounded shadow-sm">
                <p class="heading">
                    <small>
                        <a href="">
                            <i class="fa-solid fa-user"></i>
                            Someuser
                        </a>
                    </small>
                    <small>
                        <a href="">
                            <i class="fa-regular fa-calendar"></i> 3 Hours ago
                        </a>
                    </small>
                    <small>
                        <a href="">
                            <i class="fa-solid fa-diagram-project"></i>
                            Parent
                        </a>
                    </small>
                    
                    <small>
                        <a href="">
                            <i class="fa-solid fa-eye-slash"></i> Context
                        </a>
                    </small>
                    <small>
                        <a href="">
                            Next
                            <i class="fa-sharp fa-solid fa-forward"></i> 
                        </a>
                    </small>
                    <small>
                        On: 
                        <a href="">
                            The relevant article
                        </a>
                    </small>
                </p>
                <div class="coment-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat enim blanditiis ducimus facere odio dolorem saepe quod quae doloribus, voluptas veniam, iste voluptates voluptatibus quasi pariatur consequatur ab mollitia. Ea?
                </div>
            </div>
        @endfor
    </div>
@endsection