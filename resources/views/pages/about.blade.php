@extends('layouts.default')
@section('title', $data['title'])
@section('description', 'About a Museum of Relationships, the correspondences of William Hayley')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"About","path":"{{ route('pages')}}"},
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

  <section class="cf ph3 ph5-ns pb2 bg-light-green pa3">
    <div class="dt-ns dt--fixed-ns">
      <div class="dtc-ns tc pv4 ">
        <article>
          <cta-card
          title="Our team"
          content="Who made this project?"
          button-text="Meet the people"
          button-link="{{ route('pages', 'team') }}"
          />
        </article>
      </div>
      <div class="dtc-ns tc pv4">
        <article>
          <cta-card
          title="Acknowledgements"
          content="Who are we grateful to for making this project work"
          button-text="Start reading"
          button-link="{{ route('pages', 'acknowledgements') }}"
          />
        </article>
      </div>
      <div class="dtc-ns tc pv4">
        <article>
          <cta-card
          title="User guide"
          content="How to use this resource"
          button-text="Learn more"
          button-link="{{ route('pages', 'user-guide') }}"
          />
        </article>
      </div>
    </div>

  </section>
@endsection
