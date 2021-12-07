@extends('layouts.default')
@section('title', 'Acknowledgements')
@section('description', 'Acknowledgements for the Museum of Relationships')
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
      Acknowledgements
    </h1>
    <h2 class="f5 f4-m f3-l fw2 berry mt0 lh-copy">
      We would like to express our thanks to
    </h2>
  </header>

  <article class="ph7-ns pl4 pr4 mt3 mb3">
     <p class="f5 lh-copy measure-wide">
       {!! $data['text'] !!}
     </p>
  </article>


@endsection
