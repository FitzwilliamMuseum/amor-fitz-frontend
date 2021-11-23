@extends('layouts.default')
@section('breadcrumbs')
<breadcrumbs
    :path-list='[
    {"text":"Entities","path":"{{ route('entities')}}"},
    {"text":"{{ ucfirst(Request::segment(2))}}","path":"#"}
    ]'
  />
@endsection
@php
  $paginator = $paginate->links();
  $paginate = $paginator->getData()['paginator'];
@endphp
@section('title', 'A list of entities associated with ' . Request::segment(2))
@section('content')
    <div class="flex flex-wrap bg-creme pa3 ph2-ns items-center">
      @foreach($items as $item)
        <div class="w-40 pa3 mr2 ">
          <entity-card
          type="Place"
          title="{{ $item['Title'] }}"
          link-text="Discover more"
          link-path="{{ route('entity.detail', $item['id']) }}"
          />
        </div>
      @endforeach
    </div>
<section class="mw9 mw9-ns center bg-creme pa3 ph5-ns cf">
  {{ $paginate->links('paginator.default') }}
</section>
@endsection
