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
  <div class="mw9 center ph3-ns bg-white">
    <section class="mw9 mw9-ns center bg-white pa3 ph5-ns">
      <h1 class="f3 f1-l helvetica">Our Project Team</h1>
    </section>
    <div class="cf ph2-ns">
      @foreach($data as $datum)
        <div class="fl w-100 w-50-ns pa2">
          <article class="mw6 center bg-white br3 pa3 pa4-ns mv3 ba b--black-10">
            <div class="tc">
              <img src="http://tachyons.io/img/avatar_1.jpg" class="br-100 h3 w3 dib" title="Photo of a kitty staring at you">
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
            <p class="lh-copy measure f6 purple">
              {{ $datum['Job title']}}
            </p>
          @endif
        </article>
      </div>
    @endforeach
  </div>
</div>
@endsection
