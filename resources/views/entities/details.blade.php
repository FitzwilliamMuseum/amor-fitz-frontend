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
@section('description', 'An overview of information from Hayley\'s correspondence about ' . $data['Title'] )
@section('content')
  <div class="mw9 mw9-ns center bg-white pa3 ph5-ns cf">
    <div class="bg-white pa3">

      <entity-header
      type="{{ $data['type']}}"
      title="{{ $data['Title']}}"
      @if(Arr::exists( $data, 'Latitude'))
        :metadata-head='{"Latitude":"{{ $data['Latitude'] }}","Longitude":"{{ $data['Longitude'] }}","Address Today":"{{  $data['Address today'] }}"}'
      @endif
      @if($data['type'] === 'Person')
        :metadata-head='{"Birth Date":"{{ $data['Birth Date'] ?? ''}}","Death Date":"{{ $data['Death Date'] ?? ''}}","Birth Place":"{{$data['Birthplace'] ?? '' }}","Death Place":"{{$data['Deathplace'] ?? '' }}","Occupation":"{{$data['Occupation'] ?? '' }}","Nickname":"{{ $data['Nickname'] ?? ''}}","Relation To Hayley":"{{$data['Relation to Hayley'] ?? ''}}"}'
      @endif
      :metadata-tail="{}"
      :number-letters="{{ count($data['linked_items']) }}"
      @if(Arr::exists( $data, 'Description'))
        body-text="{{ $data['Description'] }}"
      @endif
      @if(Arr::exists($data, 'images') && !empty($data['images']))
        bg-image-src="{{ $data['images'][0]['file_urls']['fullsize'] }}"
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

 @if(!empty($data['linked_items']) || !empty($data['linked_subjects']) )
  <section class="cf ph3 ph5-ns pb5 bg-light-green black-70" id="features">
    <div class="mw9 center">
      <div class="cf">
        <article class="pv2 fl w-100 w-50-l pr0 pr2-l">
          <h3 class="helvetica fw4 f3">Letters and texts</h1>
          @foreach($data['linked_items'] as $ref)
            @php
            switch($ref['entityType']){
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
            <div class="pa2">
              <entity-card
              type="{{$ref['entityType']}}"
              title="{{ $ref['Title'] }}"
              @if(array_key_exists('property_label', $ref))
                role="{{ $ref['property_label']}} "
              @endif
              link-text="Read more"
              link-path="{{ route($route, $ref['object_item_id']) }}"
              @if(Arr::exists($ref, 'images') && !empty($ref['images']))
                bg-image-src="{{ $ref['images'][0]['file_urls']['square_thumbnail'] }}"
              @endif

              />
            </div>
          @endforeach
        </article>
        @if(!empty($data['linked_subjects']))
        <article class="pv2 fl w-100 w-50-l pl0 pl2-l">
          <h3 class="helvetica fw4 f3">Linked people and places</h3>
          @foreach($data['linked_subjects'] as $place)
            @php
            switch($place['entityType']){
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
            @php
            if(!empty($place['images'])){
              $bgImageSrc = $place['images'][0]['file_urls']['square_thumbnail'];
            } else {
              $bgImageSrc = NULL;
            }
            @endphp
            <div>
              <entity-card
              type="Place"
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
      </div>
      </article>
    @endif
    </div>
  </section>
@endif
@endsection
