@extends('layouts.default')
@section('title', 'Our team')
@section('breadcrumbs')
<breadcrumbs
    :path-list='[
    {"text":"About","path":"{{ route('about')}}"},
    ]'
  />
@endsection
@section('content')

<div class="mw9 center ph3-ns bg-creme">
  <section class="mw9 mw9-ns center bg-creme pa3 ph5-ns">
    <h1 class="f3 f1-l serif">Our Project Team</h1>
  </section>
  <div class="cf ph2-ns">
    @foreach($data as $datum)

      @php
        $person = array();
        foreach($datum['element_texts'] as $element){
          if($element['element']['name'] == 'Title'){
            $person['title'] = $element['text'];
          }
          if($element['element']['name'] == 'Last Name'){
            $person['surname'] = $element['text'];
          }
          if($element['element']['name'] == 'First Name'){
            $person['forename'] = $element['text'];
          }
          if($element['element']['name'] == 'Biographical Text'){
            $person['biography'] = $element['text'];
          }
          if($element['element']['name'] == 'Job title'){
            $person['role'] = $element['text'];
          }
        }
      @endphp
      <div class="fl w-100 w-50-ns pa2">
          <article class="mw6 center bg-white br3 pa3 pa4-ns mv3 ba b--black-10">
            <div class="tc">
              <img src="http://tachyons.io/img/avatar_1.jpg" class="br-100 h3 w3 dib" title="Photo of a kitty staring at you">
              <h1 class="f4">{{ $person['title']}}</h1>
              <hr class="mw3 bb bw1 b--black-10">
            </div>
            {!! $person['biography'] !!}
            @if(array_key_exists('role', $person))
            <p class="lh-copy measure f6 purple">{{ $person['role']}}</p>
            @endif
          </article>
        </div>
    @endforeach

  </div>

</div>
@endsection
