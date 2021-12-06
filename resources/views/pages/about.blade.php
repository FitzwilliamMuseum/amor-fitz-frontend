@extends('layouts.default')
@section('title', $data['title'])
@section('description', 'About a Museum of Relationships, the correspondences of William Hayley')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"About","path":"{{ route('about')}}"},
  ]'
  />
@endsection
@section('content')



  <header class="tc ph4 mb3">
    <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
      About the project
    </h1>
    <h2 class="f5 f4-m f3-l fw2 berry mt0 lh-copy">
      Who made this? Who do we need to thank?
    </h2>
  </header>

  <article class="ph7-ns pl4 pr4 mt3 mb3">
     <p class="f5 lh-copy measure-wide">
       {!! $data['text'] !!}
     </p>
  </article>

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
