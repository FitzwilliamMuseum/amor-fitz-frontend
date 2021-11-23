@extends('layouts.default')
@section('breadcrumbs')
<breadcrumbs
    :path-list='[{"text":"Correspondences","path":"{{ route('correspondences')}}"}]'
  />
@endsection
@if(array_key_exists('Letter Title',$data[0]))
@section('title', $data[0]['Letter Title'] . ' ' . $data[0]['Classmark'])
@else
  @section('title', $data[0]['Classmark'] ?? 'A letter from the archives')
@endif
@php
$people = array_filter($data[0]['expanded'], function($arr)
{
    return $arr['entityType'] == 'Person';
});

$places = array_filter($data[0]['expanded'], function($arr)
{
    return $arr['entityType'] == 'Place';
});
$object = count(array_filter($data[0]['expanded'], function($arr)
{
    return $arr['entityType'] == 'Physical Object';
}));
$images = array();
foreach($data[0]['images'] as $image){
  $images[] = $image['filename'];
}
@endphp
@section('content')
  <section class="mw9 mw9-ns center bg-white ph5-ns">

    <h1 class="serif ph5-ns">{{ $data[0]['Letter Title'] ?? 'A letter from the archive'}}</h1>
    <div class="bg-white  ph5-ns sans-serif">
      @if(array_key_exists('Classmark', $data[0]))
        <p >Classmark: {{ $data[0]['Classmark'] }}</p>
      @endif
      <p>Sender address: {{  $data[0]['Sender Address'] }}</p>
      <p>Recipient address: {{  $data[0]['Recipient Address'] }}</p>
      <p>Number of Sheets: {{  $data[0]['No. Sheets'] }}</p>
    </div>
  </section>

<section class="mw9 mw9-ns center bg-white pa3 ph5-ns">

  <letter-viewer
    :manuscript-page-images='[
    @foreach($images as $image)
    "http://hayleypapers.fitzmuseum.cam.ac.uk/files/fullsize/{{ $image}}",
    @endforeach
    ]'
    transcription="{{$data[0]['Transcription']}}"
    />

</section>


<section class="mw9 mw9-ns center pa3 ph5-ns">
  <div class="fl w-100 w-50-ns">
    <h1 class="serif b">People</h1>
    @foreach($people as $person)
    <div class="pa2">
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
        bg-image-src="http://localhost:8001/images/flaxman.jpg"
      />
    </div>
    @endforeach
  </div>
  <div class="fl w-100 w-50-ns">
      <h1 class="serif">Places</h1>
    @foreach($places as $place)
    <div class="pa2">
      <entity-card
        type="Place"
        title="{{ $place['Title'] }}"
        link-text="Read more"
        @if(array_key_exists('property_label', $place))
        role="{{ $place['property_label'] }}"
        @endif
        link-path="{{ route('entity.detail', $place['object_item_id']) }}"
        bg-image-src="http://localhost:8001/images/sussex-place.jpg"
      />
    </div>
    @endforeach
  </div>
</section>
@endsection
