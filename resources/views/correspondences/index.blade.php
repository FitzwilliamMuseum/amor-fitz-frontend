@extends('layouts.default')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[{"text":"Correspondences","path":"{{ route('correspondences')}}"}]'
  />
@endsection
@section('title', 'Hayley\'s correspondence')
@section('description', 'An index of Hayley\'s correspondence')
@section('content')
  <section class="mw9 mw9-ns bg-white pa3 ph5-ns">
    <h1 class="f1 helvetica tc fw4">{{ $page['title']}}</h1>
      {!! $page['text'] !!}
  </section>
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
