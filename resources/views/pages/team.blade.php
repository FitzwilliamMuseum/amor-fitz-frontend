@extends('layouts.default')
@section('title', 'Our team')
@section('description', 'About the team behind the project')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"About","path":"{{ route('about')}}"},
  ]'
  />
@endsection
@section('content')
  <header class="tc ph4 mb3">
    <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
      About the project's team
    </h1>
    <h2 class="f5 f4-m f3-l fw2 berry mt0 lh-copy">
      Who made this?
    </h2>
  </header>
  <article class="ph7-ns pl4 pr4 mt3">

    <div class="cf ph2-ns">
      @foreach($data as $datum)
        <div class="fl w-100 w-50-ns pa2">
          <team-profile-card
          name="{{ $datum['Title']}}"
          biography="{{$datum['Biographical Text']}}"
          role="{{ $datum['Job title']}}"
          bg-image-src="{{$datum['images'][0]['file_urls']['square_thumbnail']}}"
          />
        </div>
      @endforeach
    </div>
  </article>
@endsection
