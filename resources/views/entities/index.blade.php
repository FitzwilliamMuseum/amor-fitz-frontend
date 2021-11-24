@extends('layouts.default')
@section('breadcrumbs')
<breadcrumbs
    :path-list='[
    {"text":"Entities","path":"{{ route('entities')}}"}
    ]'
  />
@endsection
@section('title',  $page['title'])
@section('content')
  <section class="mw9 mw9-ns center bg-white pa3 ph5-ns">
    <h1 class="serif">{{ $page['title']}}</h1>
    {!! $page['text'] !!}

  </section>



  <section class="cf ph3 ph7-ns pb1 bg-light-green black-70" id="features">
              <div class="mw9 center">

                <div class="cf">
                  <article class="pv2 fl w-100 w-50-l pr0 pr2-l">
                    <entity-list-card
                    :names="['People']"
                    :backgrounds="['blake']"
                    :numberletters='{{$people[0]['items']['count']}}'
                    button-text="Discover colourful characters"
                    button-link="{{ route('entity', ['person']) }}"
                    />
                  </article>
                  <article class="pv2 fl w-100 w-50-l pl0 pl2-l">
                    <entity-list-card
                    :names="['Locations']"
                    :backgrounds="['blake']"
                    :numberletters='{{$places[0]['items']['count']}}'
                    button-text="Visit disparate locations"
                    button-link="{{ route('entity', ['place']) }}"
                    />
                  </article>
                </div>

                <div class="cf">
                  <article class="pv2 fl w-100 w-50-l pr0 pr2-l">
                    <entity-list-card
                    :names="['Families']"
                    :backgrounds="['blake']"
                    :numberletters='{{$family[0]['items']['count']}}'
                    button-text="Uncover family connections"
                    button-link="{{ route('entity', ['family']) }}"
                    />
                  </article>
                  <article class="pv2 fl w-100 w-50-l pl0 pl2-l">
                    <entity-list-card
                      :names="['Events mentioned']"
                      :backgrounds="['blake']"
                      :numberletters='{{$events[0]['items']['count']}}'
                      button-text="Relive events"
                      button-link="{{ route('entity', ['event']) }}"
                    />
                  </article>
                </div>

              </div>
            </section>







    @endsection
