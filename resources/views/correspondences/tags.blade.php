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
  <section class="mw9 mw9-ns bg-white pa3 ph5-ns">
    <h1 class="f1 helvetica fw4 tc">Tags</h1>

  </section>
<article class="mw9 mw9-ns bg-white pa3 ph5-ns">
  @if(!empty($tags))
    <div class="ph3">
      <h2 class="helvetica f4">Tags</h2>
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
