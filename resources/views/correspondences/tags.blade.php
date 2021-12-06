@extends('layouts.default')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"Correspondences","path":"{{ route('correspondences')}}"},
  {"text":"Letters","path":"{{ route('letters')}}"},
  {"text":"Tags","path":"{{ route('tags')}}"}
  ]'
  />
@endsection
@section('title', 'Hayley\'s correspondence - tags used')
@section('description', 'An index of tags used in Hayley\'s correspondence analysis')
@section('content')
  <header class="tc ph4 mb3">
    <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
    Tags used
    </h1>
    <h2 class="f5 f4-m f3-l fw2 berry mt0 lh-copy">
      Discover content via tag
    </h2>
  </header>

<article class="bg-white pa3 tc">
  @if(!empty($tags))
    <div class="ph3">
      <tag-list
      :tags='[
      @foreach($tags as $tag)
        {"url":"{{route('tag',$tag['id'])}}","text":"{{$tag['name']}}"},
      @endforeach
      ]'
      />
    </div>
  @endif
</article>

@endsection
