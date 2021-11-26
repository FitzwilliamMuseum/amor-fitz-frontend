@extends('layouts.default')
@section('title', 'Page not found')
@section('description', 'An error page for a Museum of Relationships')
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
      <h1 class="f1 f-headline-l code mb3 fw9 dib tracked-tight light-purple">404</h1>
      <h2 class="tc f1-l fw1">Sorry, we can't find the page you are looking for.</h2>
  </header>

</section>
@endsection
