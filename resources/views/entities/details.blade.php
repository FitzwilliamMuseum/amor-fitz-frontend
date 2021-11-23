@extends('layouts.default')
@section('breadcrumbs')
<breadcrumbs
    :path-list='[{"text":"Entities","path":"{{ route('entities')}}"}]'
  />
@endsection
@section('title', $data['Title'])
{{-- @dd($data) --}}
@section('content')

<div class="mw9 mw9-ns center bg-creme pa3 ph5-ns cf">
  <div class="bg-white pa3">
    <entity-header
      type="{{ $data['type']}}"
      title="{{ $data['Title']}}"
      @if(Arr::exists( $data, 'Latitude'))
      :metadata-head='{"Latitude":"{{ $data['Latitude'] }}","Longitude":"{{ $data['Longitude'] }}","Address Today":"{{  $data['Address today'] }}"}'
      @endif
      @if($data['type'] === 'Person')
      :metadata-head='{"Birth Date":"1755-07-06","Death Date":"1826-12-07","Birth Place":"{{$data['Birthplace'] ?? 'Unknown birthplace' }}","Death Place":"{{$data['Deathplace'] ?? 'Unknown death place' }}","Occupation":"{{$data['Occupation'] ?? '' }}","Nickname":"{{ $data['Nickname'] ?? 'None recorded'}}","Relation To Hayley":"{{$data['Relation to Hayley']}}"}'
    @endif
      :metadata-tail="{}"
      :number-letters="{{ count($data['relations']) }}"
      @if(Arr::exists( $data, 'Description'))
      body-text="{{ $data['Description'] }}"
      @endif
    />
  </div>
  @if(Arr::exists( $data, 'Latitude'))
<leaflet-map
lat="{{ $data['Latitude'] }}"
lng="{{ $data['Longitude'] }}"
/>
@endif
</div>

<section class="mw9 mw9-ns center pa3 ph5-ns">
  <div class="fl w-100 w-50-ns">
    <h1 class="serif b">Referenced</h1>
    @foreach($data['expanded'] as $ref)

    <div class="pa2">
      <entity-card
        type="Person"
        title="{{ $ref['refs']['Title'] }}"
        @if(array_key_exists('property_label', $ref))
        role="{{ $ref['property_label']}} "
        @endif
        link-text="Read more"
        link-path="{{ route('letter', $ref['refs']['id']) }}"
        bg-image-src="{{ route('home')}}/images/flaxman.jpg"
      />
    </div>
    @endforeach
  </div>

</section>
@endsection
