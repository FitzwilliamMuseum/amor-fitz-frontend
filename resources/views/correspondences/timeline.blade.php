@extends('layouts.default')

@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"Correspondences","path":"{{ route('correspondences')}}"},
  {"text":"Letters","path":"{{ route('letters')}}"},
  {"text":"Tags","path":"{{ route('tags')}}"},
  {"text":"Timeline","path":"#"},
  ]'
  />
@endsection
@section('title', 'Hayley\'s correspondence on a timeline for ' . $tags[0] )
@section('description', 'An index of Hayley\'s correspondence tagged with: ' . $tags[0] )
@section('content')

  <header class="tc ph4 mb3">
    <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
    A timeline for letters tagged with
    </h1>
    <h2 class="f5 f4-m f3-l fw2 berry mt0 lh-copy">
      {{ $tags[0] }}
    </h2>
  </header>

  <section class="w-100 mt3 mb3">
    <timeline doc-id="{{ route('timeline.json',$tag) }}"/>
  </section>
@endsection
