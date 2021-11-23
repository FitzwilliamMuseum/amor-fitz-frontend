@extends('layouts.default')
@section('breadcrumbs')
<breadcrumbs
    :path-list='[
    {"text":"About","path":"{{ route('about')}}"},
    ]'
  />
@endsection
@section('content')

<section class="mw9 mw9-ns center bg-creme pa3 ph5-ns">
  <article class="pa3 pa5-ns bg-white">
  <h1 class="f3 f2-m f1-l">Acknowledgements</h1>
  {!! $data['text'] !!}
</article>
</section>

@endsection
