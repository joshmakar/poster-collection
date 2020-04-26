@extends('layouts.app')

@section('content')
<div class="container">
  <div class="{{ count($posters) > 5 ? 'card-columns' : 'card-deck' }}">
    @foreach ($posters as $poster)
      <div class="card">
        <img class="card-img-top" src="{{ url("storage/poster_images/{$poster->image_url}") }}" alt="{{ $poster->name }}">
        <div class="card-body">
          <h5 class="card-title">{{ $poster->name }}</h5>
          <p class="card-text">{{ $poster->description }}</p>
          <p class="card-text"><small class="text-muted">Width: {{ $poster->width }}, Height: {{ $poster->height }}</small></p>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
