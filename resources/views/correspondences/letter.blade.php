@extends('layouts.default')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"Correspondences","path":"{{ route('correspondences')}}"},
  {"text":"Letters","path":"{{ route('letters')}}"}
  ]'
  />
@endsection
@if(array_key_exists('Letter Title',$data))
  @section('title', $data['Letter Title'] . ' ' . $data['Classmark'])
  @section('description', $data['Letter Title'] ?? 'A letter from the archive')
@else
  @section('title', $data['Classmark'] ?? 'A letter from the archives')
@endif

@php
$people = array_filter($data['expanded'], function($arr){
  return $arr['entityType'] == 'Person';
});
$families = array_filter($data['expanded'], function($arr){
  return $arr['entityType'] == 'Family';
});
$places = array_filter($data['expanded'], function($arr){
  return $arr['entityType'] == 'Place';
});
$events = array_filter($data['expanded'], function($arr){
  return $arr['entityType'] == 'Event';
});
$objects = array_filter($data['expanded'], function($arr){
  return $arr['entityType'] == 'Physical Object';
});
$texts = array_filter($data['expanded'], function($arr){
  return $arr['entityType'] == 'Text';
});
$works = array_filter($data['expanded'], function($arr){
  return $arr['entityType'] == 'Still Image';
});
$images = array();
foreach($data['images'] as $image){
  $images[] = $image['filename'];
}
@endphp
@section('content')

  <header class="tc ph4 mb3 w-100">
    <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
      {{ $data['Letter Title'] ?? 'A letter from the archive'}}
    </h1>
    <h2 class="f f4-m f3-l purple mt0 lh-copy fw3">
      {{$data['Title']}}
    </h2>
  </header>

  <article class="ph6-ns ph4 mb3 w-100">
     <p class="f5 lh-copy measure-wide">
     Sender address: {{  $data['Sender Address']  ?? ' Not recorded'}}<br/>
     Recipient address: {{  $data['Recipient Address'] ?? 'Not recorded'}}<br/>
     Number of Sheets: {{  $data['No. Sheets'] ?? 'Not recorded  '}}
     </p>
     @if(!empty($data['tags']))
       <div class="ph3">
         <tag-list
         :tags='[
         @foreach($data['tags'] as $tag)
           {"url":"{{route('tag',$tag['id'])}}","text":"{{$tag['name']}}"},
         @endforeach
         ]'
         />
       </div>
     @endif
  </article>



  @if(!empty($images) && array_key_exists('Transcription',$data))
    <section class="w-100 ph5-ns ph1">
      <letter-viewer
      :manuscript-page-images='[
      @foreach($images as $image)
        "https://hayleypapers.fitzmuseum.cam.ac.uk/files/fullsize/{{ $image}}",
      @endforeach
      ]'
      transcription="{{$data['Transcription']}}"
      transcriptPageComponents='["TranscriptPage1","TranscriptPage2","TranscriptPage3","TranscriptPage4"]'
      />
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
            @php
            if(!empty($person['images'])){
              $bgImageSrc = $person['images'][0]['file_urls']['square_thumbnail'];
            } else {
              $bgImageSrc = NULL;
            }
            switch($person['entityType']){
              case 'Letter':
                $route = 'letter';
                break;
              case 'Person':
              case 'Place':
              case 'Family':
              case 'Event':
              case 'Text':
              case 'Still Image':
                $route = 'entity.detail';
                break;
              case 'Team':
                $route = 'team';
                break;
              default:
                $route = 'letter';
                break;
            }
            @endphp
            <div>
              <entity-card
              type="{{$person['entityType']}}"
              @if(array_key_exists('First_Name', $person))
                title="{{ $person['First Name'] }} {{ $person['Last Name'] }}"
              @else
                title="{{ $person['Title'] }}"
              @endif
              @if(array_key_exists('property_label', $person))
                role="{{ $person['property_label'] }}"
              @endif
              link-text="Read more"
              link-path="{{ route($route, $person['object_item_id']) }}"
              bg-image-src="{{ $bgImageSrc }}"
              />
            </div>
          @endforeach
        </article>
        <article class="pv2 fl w-100 w-50-l pl0 pl2-l">
          <h3 class="helvetica fw4 f3">Places</h3>
          @dd($places)
          @foreach($places as $place)

            @php
            if(!empty($place['images'])){
              $bgImageSrc = $place['images'][0]['file_urls']['square_thumbnail'];
            } else {
              $bgImageSrc = NULL;
            }
            @endphp
            <div>
              <entity-card
              type="{{$place['entityType']}}"
              title="{{ $place['Title'] }}"
              link-text="Read more"
              @if(array_key_exists('property_label', $place))
                role="{{ $place['property_label'] }}"
              @endif
              link-path="{{ route($route, $place['object_item_id']) }}"
              bg-image-src="{{ $bgImageSrc }}"
              />
            </div>
          @endforeach

          @if(!empty($events))
            <h3 class="helvetica fw4 f3">Events</h3>
            @foreach($events as $event)
              <div>
                @php
                if(!empty($event['images'])){
                  $bgImageSrc = $event['images'][0]['file_urls']['square_thumbnail'];
                } else {
                  $bgImageSrc = NULL;
                }
                @endphp
                <entity-card
                type="{{$event['entityType']}}"
                title="{{ $event['Title'] }}"
                link-text="Read more"
                @if(array_key_exists('property_label', $event))
                  role="{{ $event['property_label'] }}"
                @endif
                link-path="{{ route($route, $event['object_item_id']) }}"
                bg-image-src="{{ $bgImageSrc }}"
                />
              </div>
            @endforeach
          @endif

          @if(!empty($objects))
            <h3 class="helvetica fw4 f3">Physical objects</h3>
            @foreach($objects as $object)
              <div>
                @php
                if(!empty($object['images'])){
                  $bgImageSrc = $object['images'][0]['file_urls']['square_thumbnail'];
                } else {
                  $bgImageSrc = NULL;
                }
                @endphp
                <entity-card
                type="{{$person['entityType']}}"
                title="{{ $object['Title'] }}"
                link-text="Read more"
                @if(array_key_exists('property_label', $object))
                  role="{{ $object['property_label'] }}"
                @endif
                link-path="{{ route($route, $object['object_item_id']) }}"
                bg-image-src="{{ $bgImageSrc }}"
                />
              </div>
            @endforeach
          @endif

          @if(!empty($works))
            <h3 class="helvetica fw4 f3">Works of art</h3>
            @foreach($works as $work)
              <div>
                @php
                if(!empty($work['images'])){
                  $bgImageSrc = $work['images'][0]['file_urls']['square_thumbnail'];
                } else {
                  $bgImageSrc = NULL;
                }
                @endphp
                <entity-card
                type="{{$work['entityType']}}"
                title="{{ $work['Title'] }}"
                link-text="Read more"
                @if(array_key_exists('property_label', $work))
                  role="{{ $work['property_label'] }}"
                @endif
                link-path="{{ route('entity.detail', $work['object_item_id']) }}"
                bg-image-src="{{ $bgImageSrc }}"
                />
              </div>
            @endforeach
          @endif

          @if(!empty($texts))
            <h3 class="helvetica fw4 f3">Texts</h3>
            @foreach($texts as $text)
              <div>
                @php
                if(!empty($text['images'])){
                  $bgImageSrc = $text['images'][0]['file_urls']['square_thumbnail'];
                } else {
                  $bgImageSrc = NULL;
                }
                @endphp

                <entity-card
                type="{{$text['entityType']}}"
                title="{{ $text['Title'] }}"
                link-text="Read more"
                @if(array_key_exists('property_label', $text))
                  role="{{ $text['property_label'] }}"
                @endif
                link-path="{{ route('entity.detail', $text['object_item_id']) }}"
                bg-image-src="{{ $bgImageSrc }}"
                />
              </div>
            @endforeach
          @endif

          @if(!empty($families))
            <h3 class="helvetica fw4 f3">Families</h3>
            @foreach($families as $family)
              <div>
                @php
                if(!empty($family['images'])){
                  $bgImageSrc = $family['images'][0]['file_urls']['square_thumbnail'];
                } else {
                  $bgImageSrc = NULL;
                }
                @endphp
                <entity-card
                type="{{$family['entityType']}}"
                title="{{ $family['Title'] }}"
                link-text="Read more"
                @if(array_key_exists('property_label', $family))
                  role="{{ $family['property_label'] }}"
                @endif
                link-path="{{ route('entity.detail', $family['object_item_id']) }}"
                bg-image-src="{{ $bgImageSrc }}"
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
