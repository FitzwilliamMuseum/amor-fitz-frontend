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
@section('description', 'A list of entities associated with ' . Request::segment(2))
@section('content')
  <header class="tc ph4 mb3">
    <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
    All records attributed to {{Request::segment(2)}}
    </h1>
    <h2 class="f5 f4-m f3-l fw2 purple mt0 lh-copy">
      Discover more about this entity type
    </h2>
  </header>
  @if ($paginate->onFirstPage())
  @if(Request::segment(2) == 'place')
  <section class="w-100 mb3">
    <leaflet-geojson
    :path='"/maps/places"'
    />
  </section>
  @endif
@endif
  <section class="cf ph3 ph5-ns pb5 bg-light-white black-70">
    <div class="mw9 center">
      @foreach($items as $item)
        <div class="cf">
          @php
          if(!empty($item['images'])){
            $bgImageSrc = $item['images'][0]['file_urls']['square_thumbnail'];
          } else {
            $bgImageSrc = NULL;
          }
          @endphp
          @if($loop->even)
            <article class="pv2 fl w-100 w-50-l pr0 pr2-l">
              <entity-card
              type="{{$item['type']}}"
              title="{{ $item['Title'] }}"
              link-text="Discover more"
              link-path="{{ route('entity.detail', $item['id']) }}"
              @if(array_key_exists('Relation to Hayley', $item))
                role="{{ $item['Relation to Hayley'] }}"
              @endif
              @if(!is_null($bgImageSrc))
              bg-image-src="{{ $bgImageSrc }}"
              @endif
              />
            </article>
          @endif
          @if($loop->odd)
            <article class="pv2 fl w-100 w-50-l pl0 pl2-l">
              <entity-card
              type="{{$item['type']}}"
              title="{{ $item['Title'] }}"
              link-text="Discover more"
              link-path="{{ route('entity.detail', $item['id']) }}"
              @if(!is_null($bgImageSrc))
              bg-image-src="{{ $bgImageSrc }}"
              @endif
              @if(array_key_exists('Relation to Hayley', $item))
                role="{{ $item['Relation to Hayley'] }}"
              @endif
              />
            </article>
          @endif

        @endforeach
      </div>

    </div>
  </section>


<section class="mw8-ns center tc bg-white pa3 ph5-ns">
{{ $paginate->links('paginator.default') }}
</section>
@endsection
