@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $poster->name }}</div>

                <div class="card-body">
                  <img class="img-fluid" src="{{ url("storage/poster_images/{$poster->image_url}") }}" alt="{{ $poster->name }}">
                </div>

                <div class="card-footer">
                  {{ $poster->description }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
