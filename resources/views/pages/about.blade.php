@extends('layouts.default')
@section('title', $data['title'])
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"About","path":"{{ route('about')}}"},
  ]'
  />
@endsection
@section('content')
  <section class="mw9 mw9-ns center bg-white pa3 ph5-ns">
    <article class="pa3 pa5-ns bg-white">
      <h1 class="f3 f2-m f1-l serif">About the project</h1>
      {!! $data['text'] !!}
    </article>
  </section>

  <section class="cf ph3 ph5-ns pb2 bg-light-green black-70 pa3">
    <div class="mw9 center">

      <div class="cf">
        <article class="pv2 fl w-100 w-50-l pr0 pr2-l">
          <cta-card
          title="Our team"
          content="Who made this project?"
          button-text="Meet the people"
          button-link="{{ route('team') }}"
          />
        </article>
        <article class="pv2 fl w-100 w-50-l pl0 pl2-l">
          <cta-card
          title="Acknowledgements"
          content="Who are we grateful to for making this project work"
          button-text="Start reading"
          button-link="{{ route('acknowledgements') }}"
          />
        </article>
      </div>

    </div>
  </section>

@endsection
