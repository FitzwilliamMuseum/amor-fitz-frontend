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
  <section class="pv3 bg-white ph5-ns">
    <correspondence-list
    :correspondences='[
    @foreach($convos as $con)
      @php
      $names = '"'. str_replace('/', '","',$con[0]['names']) . '"';
      $count = count($con);
      $tags = array();
      $ids = array();
      foreach ($con as $c) {
          $ids =  $c['tags'];
      }
      $idList =  implode(',', array_unique($ids));
      $bgs = array();
      $bg = explode('/', $con[0]['names']);
      foreach($bg as $b){
        if($b != 'William Hayley'){
          $bgs[] = Str::slug($b);
        }
      }
      $backgrounds = '"'.  implode('","',$bgs) . '"';
      @endphp
    {"names":[{!! $names !!}],"backgrounds":[{{$backgrounds}}],"numberletters":{!! $count !!},"curatorial-statement":"", "buttonLink": "{{ route('tag', $idList) }}"},

    @endforeach
    ]'
    />


  </section>
  
@endsection
