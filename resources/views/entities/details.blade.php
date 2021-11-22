@extends('layouts.default')
@dump($data)
@section('content')

<div class="mw9 mw9-ns center bg-creme pa3 ph5-ns cf">
  <div class="bg-white pa3">
    <entity-header
      type="place"
      title="{{ $data['Title']}}"
      @if(Arr::exists( $data, 'Latitude'))
      :metadata-head='{"Latitude":"{{ $data['Latitude'] }}","Longitude":"{{ $data['Longitude'] }}","Address Today":"{{  $data['Address today'] }}"}'
      @endif
      :metadata-tail="{}"
      {{-- :number-letters="{{ count($data['relations']) }}" --}}
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
@endsection
