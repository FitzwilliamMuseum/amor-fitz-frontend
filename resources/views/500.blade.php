@extends('layouts.default')
@section('title', 'Internal server error')

@endsection
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"Error","path":"#"}
  ]'
  />
@endsection
@section('content')

  <section class="vh-80 bg-creme baskerville">
  <header class="tc ph5 lh-copy">
      <h1 class="f1 f-headline-l code mb3 fw9 dib tracked-tight light-purple">500</h1>
      <h2 class="tc f1-l fw1">Sorry, our code or server has a problem.</h2>
  </header>

</section>
@endsection
