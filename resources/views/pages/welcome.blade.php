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

  <section class="cf ph3 pa4 ph7-ns bg-light-green black-70" id="features">
    <div class="mw9 center">
      <div class="cf">
        <article class="pv2 fl w-100 w-50-l pr0 pr2-l">
          <cta-card
          title="People & Places"
          content="Explore the entities of Hayley's world"
          button-text="Explore entities"
          button-link="{{ route('entities') }}"
          />
        </article>
        <article class="pv2 fl w-100 w-50-l pl0 pl2-l">
          <cta-card
          title="Correspondences"
          content="Explore the world of Hayley's correspondence"
          button-text="Start reading"
          button-link="{{ route('correspondences') }}"
          />
        </article>
      </div>
    </div>
  </section>
@endsection
