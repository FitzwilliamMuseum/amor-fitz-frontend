@extends('layouts.default')
@section('title',  $page['title'])
@section('content')
  <section class="mw9 mw9-ns center bg-creme pa3 ph5-ns">
    <h1 class="serif">{{ $page['title']}}</h1>
    {!! $page['text'] !!}

  </section>
  <section class="mw9 mw9-ns center bg-creme pa3 ph5-ns cf">
    <div class="fl w-50  tc">
      <entity-list-card
      :names="['People']"
      :backgrounds="['blake']"
      :numberletters='{{$people[0]['items']['count']}}'
      button-text="Discover colourful characters"
      button-link="{{ route('entity', ['person']) }}"
      />
      </div>

      <div class="fr w-50 tc">
        <entity-list-card
        :names="['Locations']"
        :backgrounds="['blake']"
        :numberletters='{{$places[0]['items']['count']}}'
        button-text="Visit disparate locations"
        button-link="{{ route('entity', ['place']) }}"
        />
        </div>
  </section>

    

      <section class="mw9 mw9-ns center bg-creme pa3 ph5-ns cf">
        <div class="fl w-50  tc">
          <entity-list-card
          :names="['Families']"
          :backgrounds="['blake']"
          :numberletters='{{$family[0]['items']['count']}}'
          button-text="Uncover family connections"
          button-link="{{ route('entity', ['family']) }}"
          />
          </div>
          <div class="fl w-50  tc">
          <entity-list-card
            :names="['Events mentioned']"
            :backgrounds="['blake']"
            :numberletters='{{$events[0]['items']['count']}}'
            button-text="Relive events"
            button-link="{{ route('entity', ['event']) }}"
          />
        </div>
      </section>
    @endsection
