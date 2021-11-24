@extends('layouts.default')
@section('breadcrumbs')
<breadcrumbs
    :path-list='[
    {"text":"Entities","path":"{{ route('entities')}}"},
    {"text":"Details","path":"#"}
    ]'
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
      :metadata-head='{"Birth Date":"{{ $data['Birth Date'] ?? ''}}","Death Date":"{{ $data['Death Date'] ?? ''}}","Birth Place":"{{$data['Birthplace'] ?? 'Unknown birthplace' }}","Death Place":"{{$data['Deathplace'] ?? 'Unknown death place' }}","Occupation":"{{$data['Occupation'] ?? '' }}","Nickname":"{{ $data['Nickname'] ?? 'None recorded'}}","Relation To Hayley":"{{$data['Relation to Hayley'] ?? ''}}"}'
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


<section class="cf ph3 ph5-ns pb5 bg-light-green black-70" id="features">
            <div class="mw9 center">

              <div class="cf">
                <article class="pv2 fl w-100 w-50-l pr0 pr2-l">
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
                </article>

              </div>



            </div>
          </section>




@endsection
