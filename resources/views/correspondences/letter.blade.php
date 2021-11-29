@extends('layouts.default')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"Correspondences","path":"{{ route('correspondences')}}"},
  {"text":"Letter","path":"#"},

  ]'
  />
@endsection
@if(array_key_exists('Letter Title',$data[0]))
  @section('title', $data[0]['Letter Title'] . ' ' . $data[0]['Classmark'])
  @section('description', $data[0]['Letter Title'] ?? 'A letter from the archive')
@else
  @section('title', $data[0]['Classmark'] ?? 'A letter from the archives')
@endif
@php
$people = array_filter($data[0]['expanded'], function($arr)
{
  return $arr['entityType'] == 'Person';
});
$families = array_filter($data[0]['expanded'], function($arr)
{
  return $arr['entityType'] == 'Family';
});
$places = array_filter($data[0]['expanded'], function($arr)
{
  return $arr['entityType'] == 'Place';
});
$events = array_filter($data[0]['expanded'], function($arr)
{
  return $arr['entityType'] == 'Event';
});
$objects = array_filter($data[0]['expanded'], function($arr)
{
  return $arr['entityType'] == 'Physical Object';
});
$images = array();
foreach($data[0]['images'] as $image){
  $images[] = $image['filename'];
}
@endphp
@section('content')

  <section class="cf ph1 ph5-ns pb1 bg-white black-70">
    <div class="mw9 center">
      <h1 class="helvetica f1 fw4">{{ $data[0]['Letter Title'] ?? 'A letter from the archive'}}</h1>
      <article class="pv2 fl w-100 ">
        <div class="sans-serif">
          @if(array_key_exists('Classmark', $data[0]))
            <p >Classmark: {{ $data[0]['Classmark'] }}</p>
          @endif
          <p>Sender address: {{  $data[0]['Sender Address']  ?? ' Not recorded'}}</p>
          <p>Recipient address: {{  $data[0]['Recipient Address'] ?? 'Not recorded'}}</p>
          <p>Number of Sheets: {{  $data[0]['No. Sheets'] ?? 'Not recorded  '}}</p>
        </div>

        @if(!empty($data[0]['tags']))
          <div class="ph3">
            <h2 class="helvetica f4">Tags</h2>
            <tag-list
            :tags='[
            @foreach($data[0]['tags'] as $tag)
              {"url":"{{route('tag',$tag['id'])}}","text":"{{$tag['name']}}"},
            @endforeach
            ]'
            />
          </div>
        @endif
      </article>

    </div>
  </section>

  @if(!empty($images) && array_key_exists('Transcription',$data[0]))
    <section class="w-100 ph5-ns ph1">

      <letter-viewer
      :manuscript-page-images='[
      @foreach($images as $image)
        "https://hayleypapers.fitzmuseum.cam.ac.uk/files/fullsize/{{ $image}}",
      @endforeach
      ]'
      transcription="{{$data[0]['Transcription']}}"
      transcriptPageComponents='["TranscriptPage1","TranscriptPage2","TranscriptPage3","TranscriptPage4"]'

      ></letter-viewer>

    </section>

    @include('includes.annotations')

    @if(!empty($images))
      @include('includes.iiif')
    @endif
  @else
    <section class="mw9 mw9-ns center bg-creme pa3 ph5-ns">
      <p>No transcription or images available.</p>
    </section>
  @endif
  <section class="cf ph3 ph5-ns pb5 bg-light-green black-70" id="features">
    <div class="mw9 center">

      <div class="cf">
        <article class="pv2 fl w-100 w-50-l pr0 pr2-l">
          <h1 class="helvetica fw4 f3">People</h1>
          @foreach($people as $person)
            <div >
              <entity-card
              type="Person"
              @if(array_key_exists('First_Name', $person))
                title="{{ $person['First Name'] }} {{ $person['Last Name'] }}"
              @else
                title="{{ $person['Title'] }}"
              @endif
              @if(array_key_exists('property_label', $person))
                role="{{ $person['property_label'] }}"
              @endif
              link-text="Read more"
              link-path="{{ route('entity.detail', $person['object_item_id']) }}"
              bg-image-src="{{ route('home')}}/images/flaxman.jpg"
              />
            </div>
          @endforeach
        </article>
        <article class="pv2 fl w-100 w-50-l pl0 pl2-l">
          <h3 class="helvetica fw4 f3">Places</h3>
          @foreach($places as $place)
            <div >
              <entity-card
              type="Place"
              title="{{ $place['Title'] }}"
              link-text="Read more"
              @if(array_key_exists('property_label', $place))
                role="{{ $place['property_label'] }}"
              @endif
              link-path="{{ route('entity.detail', $place['object_item_id']) }}"
              bg-image-src="{{ route('home')}}/images/sussex-place.jpg"
              />
            </div>
          @endforeach

          @if(!empty($events))
            <h3 class="helvetica fw4 f3">Events</h3>
            @foreach($events as $event)
              <div >
                <entity-card
                type="Event"
                title="{{ $event['Title'] }}"
                link-text="Read more"
                @if(array_key_exists('property_label', $event))
                  role="{{ $event['property_label'] }}"
                @endif
                link-path="{{ route('entity.detail', $event['object_item_id']) }}"
                bg-image-src="{{ route('home')}}/images/sussex-place.jpg"
                />
              </div>
            @endforeach
          @endif

          @if(!empty($objects))
            <h3 class="helvetica fw4 f3">Physical objects</h3>
            @foreach($objects as $object)
              <div >
                <entity-card
                type="Event"
                title="{{ $object['Title'] }}"
                link-text="Read more"
                @if(array_key_exists('property_label', $object))
                  role="{{ $object['property_label'] }}"
                @endif
                link-path="{{ route('entity.detail', $object['object_item_id']) }}"
                bg-image-src="{{ route('home')}}/images/sussex-place.jpg"
                />
              </div>
            @endforeach
          @endif

          @if(!empty($families))
            <h3 class="helvetica fw4 f3">Families</h3>
            @foreach($families as $family)
              <div>
                <entity-card
                type="Event"
                title="{{ $family['Title'] }}"
                link-text="Read more"
                @if(array_key_exists('property_label', $family))
                  role="{{ $family['property_label'] }}"
                @endif
                link-path="{{ route('entity.detail', $family['object_item_id']) }}"
                bg-image-src="{{ route('home')}}/images/sussex-place.jpg"
                />
              </div>
            @endforeach
          @endif
        </article>
      </div>



    </div>
  </section>


@endsection

@section('scripts')
