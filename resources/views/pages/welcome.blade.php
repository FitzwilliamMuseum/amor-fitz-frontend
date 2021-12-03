@extends('layouts.default')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[]'
  />
@endsection
@section('title', 'Welcome to A Museum of Relationships')
@section('description', 'A welcome to this digital edition of a Museum of Relationships held in the Fitzwilliam Museum')
@section('content')

<header class="tc ph4 mb3">
  <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
    {{ $page['title']}}
  </h1>
  <h2 class="f5 f4-m f3-l fw2 black-50 mt0 lh-copy">
    Most Sacred Things: A Museum of Relationships
  </h2>
</header>
<section class="fl w-100 bg-light-green h-100 flex items-center pv2 mv3">
  <div class="w-100 mw7-ns center bg-light-green pa3 ph5-ns pv3 flex items-center">
    <correspondence-card-front
    :backgrounds='["john-flaxman","anne-nancy-flaxman","thomas-alphonso-hayley","eliza-hayley"]'
    />
  </div>
</section>
<article class="ph7-ns pl4 pr4 mt3">
   <p class="f5 lh-copy measure-wide">
     {!! $page['text'] !!}
   </p>
</article>

@endsection
