@extends('layouts.default')
@section('title', 'Our team')
@section('description', 'About the team behind the project')
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
      About the project's team
    </h1>
    <h2 class="f5 f4-m f3-l fw2 berry mt0 lh-copy">
      Who made this?
    </h2>
  </header>

    <div class="cf ph2-ns">
      @foreach($data as $datum)
        <div class="fl w-100 w-50-ns pa2">
          <article class="mw6 center bg-white br3 pa3 pa4-ns mv3 ">
            <div class="tc">
              @if(!empty($datum['images']))

              <img src="{{$datum['images'][0]['file_urls']['square_thumbnail']}}" class="dib" title="Profile image of {{ $datum['Title']}}">

              @else
              <img src="http://tachyons.io/img/avatar_1.jpg" class="br-100 h3 w3 dib" title="Photo of a kitty staring at you">
              @endif
              <h1 class="f4">
                {{ $datum['Title']}}
              </h1>
              <hr class="mw3 bb bw1 b--black-10">
            </div>
            <accordion-link
            show-text="Show more"
            hide-text="Show less"
            slot-content=""
            >
            {!! $datum['Biographical Text'] !!}
          </accordion-link>
          @if(array_key_exists('Job title', $datum))
            <p class="lh-copy measure f6 berry">
              {{ $datum['Job title']}}
            </p>
          @endif
        </article>
      </div>
    @endforeach
  </div>
</div>
@endsection
