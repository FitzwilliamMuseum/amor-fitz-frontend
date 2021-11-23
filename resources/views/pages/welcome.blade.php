@extends('layouts.default')
@section('breadcrumbs')
<breadcrumbs
    :path-list='[]'
  />
@endsection
@section('title', 'Welcome')
@section('content')
  <article class="pa2 pa5-ns bg-creme">
    <h1 class="f3 f2-m f1-l serif">{{ $page['title']}}</h1>
    {!! $page['text'] !!}
  </article>
  <section class="mw9 mw9-ns center bg-creme pa2 ph5-ns">
    <cta-card
    title="Correspondences"
    content="Explore the world of Hayley's correspondence"
    button-text="Start reading"
    button-link="{{ route('correspondences') }}"
    />
  </section>

  <section class="bg-creme pa2 ph5-ns">
    <cta-card
    title="People, Places, and more"
    content="Explore the entities of Hayley's world"
    button-text="Explore entities"
    button-link="{{ route('entities') }}"
    />
  </section>
@endsection
