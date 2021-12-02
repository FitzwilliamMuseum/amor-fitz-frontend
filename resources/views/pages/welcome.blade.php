@extends('layouts.default')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[]'
  />
@endsection
@section('title', 'Welcome to A Museum of Relationships')
@section('description', 'A welcome to this digital edition of a Museum of Relationships held in the Fitzwilliam Museum')
@section('content')


  <article class="pa1 pa5-ns bg-white">
    <h1 class="f3 f2-m f1-l helvetica tc fw4">{{ $page['title']}}</h1>
    <div class="mw5 mw7-ns center  pa3 ph5-ns">
      <correspondence-card-front
      :backgrounds='["john-flaxman","anne-nancy-flaxman","thomas-alphonso-hayley","eliza-hayley"]'
      />
    </div>
    <div class="pa1 pa5-ns">{!! $page['text'] !!}</div>
  </article>

@endsection
