@extends('layouts.default')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[{"text":"Correspondences","path":"{{ route('correspondences')}}"}]'
  />
@endsection
@section('title', 'Hayley\'s correspondence')
@section('description', 'An index of Hayley\'s correspondence')
@section('content')
  <header class="tc ph4 mb3">
    <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
    {{ $page['title']}}
    </h1>
    <h2 class="f5 f4-m f3-l fw2 berry mt0 lh-copy">
      What can you learn from Most Sacred Things?
    </h2>
  </header>
  <article class="ph7-ns pl4 pr4 mt3 mb3">
    <p class="f5 lh-copy measure-wide"></p>
    {!! $page['text'] !!}
  </article>

  <section class="pv3 w-80 center tc bg-white ph5-ns">
    <correspondence-list
    :correspondences='[
    @foreach($convos as $convo)

      @php
      $names = '"' .  implode('","', $convo['names']) . '"';
      $backgrounds = '"'.  implode('","',$convo['backgrounds']) . '"';
      @endphp
    {"names":[{!! $names !!}],"backgrounds":[{!! $backgrounds !!}], "numberletters": {{ $convo['count'] }}, "buttonLink": "{{ route('tag', $convo['tag']) }}"},
    @endforeach
    ]'
    />


  </section>

@endsection
