@extends('layouts.default')
@section('title','Search results')
@section('meta_description', "Search results for your query" )
@section('meta_keywords', 'search,results,fitzwilliam,museum')
@section('breadcrumbs')
    <breadcrumbs
        :path-list='[
  {"text":"Search","path":"{{ route('search')}}"},
  {"text":"Results","path":"{{ route('search.results')}}"},
  ]'
    />
@endsection
@section('content')
    <section class="mw9 mw9-ns center bg-white pa3 ph5-ns">
        @foreach($records as $record)
            @php
                $route=match($record['itemtype']){'Person','Place','Family','Event','Text','Pictures','Sculpture'=>'entity.detail','Team'=>'pages.team',default=>'letter',};
                if($record['model'] == 'SimplePagesPage'){
                  $route = 'pages';
                }
            @endphp
            @if($loop->even)
                <article class="pv2 fl w-100 w-50-l pr0 pr2-l">
                    <entity-card
                        type="{{ $record['itemtype'] }}"
                        title="{{ $record['title'][0]}}"
                        link-text="Discover more"
                        @if($route != 'pages')
                            link-path="{{ route($route, $record['modelid'] ) }}"
                        @else
                            link-path="{{ route($route, $record['simple_pages_slug_t'][0]) }}"
                        @endif />
                </article>
            @endif
            @if($loop->odd)
                <article class="pv2 fl w-100 w-50-l pl0 pl2-l">
                    <entity-card
                        type="{{ $record['itemtype']  }}"
                        title="{{ $record['title'][0]}}"
                        link-text="Discover more"
                        @if($route != 'pages')
                            link-path="{{ route($route, $record['modelid'] ) }}"
                        @else
                            link-path="{{ route($route, $record['simple_pages_slug_t'][0]) }}"
                        @endif
                    />
                </article>
            @endif
        @endforeach
    </section>

    <section class="mw8-ns center tc bg-white pa3 ph5-ns">
        {{ $paginate->links('paginator.default') }}
    </section>
@endsection
