@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow rounded user-card">
            <div class="image">
                <img src="https://via.placeholder.com/150/150" alt="" class="img-thumbnail ">
            </div>
            <div class="card-body" >
                <table class="table">
                    <tr>
                        <th>User:</th>
                        <td>{{request()->route()->parameters['id']}}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{$user->created}}</td>
                    </tr>
                    <tr>
                        <th>Karma</th>
                        <td>{{$user->karma}}</td>
                    </tr>
                    <tr>
                        <th>About</th>
                        <td>
                            Submited: {{count($user->submitted)}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection