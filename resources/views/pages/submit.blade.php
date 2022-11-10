@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-8">
            <form action="{{route('post.submit')}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="url">Url</label>
                    <input type="url" name="url" class="form-control" id="title" value="{{old('url')}}">
                    @error('url') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="text">Text</label>
                    <textarea class="form-control" name="text" id="text" rows="5" />{{old('text')}}</textarea>
                    @error('text') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <button type="submit" class="btn custom-btn">Submit</button>
            </form>
        </div>
    </div>
@endsection