@extends('layouts.default')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"Correspondences","path":"{{ route('correspondences')}}"},
  {"text":"Letters","path":"{{ route('letters')}}"},
  {"text":"Tags","path":"{{ route('tags')}}"},
  ]'
  />
@endsection
@section('title', 'Hayley\'s ' . implode(' / ', $tag))
@section('description', 'An index of Hayley\'s correspondence tagged with: ' .  implode(' / ', $tag) )
@section('content')

  <header class="tc ph4 mb3">
    <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
    {{ $page['title']}} tagged with
    </h1>
    <h2 class="f5 f4-m f3-l fw2 purple mt0 lh-copy">
      {{ implode(' / ', $tag) }}
    </h2>
  </header>



  <section class="mw7-ns center  pl2 pr2 ph1-ns">

      @foreach($records as $item)
        @php
        $people = count(array_filter($item['expanded'], function($arr)
        {
          return $arr['entityType'] == 'Person';
        }));

        $places = count(array_filter($item['expanded'], function($arr)
        {
          return $arr['entityType'] == 'Place';
        }));
        $objects = count(array_filter($item['expanded'], function($arr)
        {
          return $arr['entityType'] == 'Physical Object';
        }));
        $events = count(array_filter($item['expanded'], function($arr)
        {
          return $arr['entityType'] == 'Event';
        }));
        $texts = count(array_filter($item['expanded'], function($arr)
        {
          return $arr['entityType'] == 'Text';
        }));

        $works = count(array_filter($item['expanded'], function($arr)
        {
          return $arr['entityType'] == 'Still Image';
        }));
        $images = array();
        foreach($item['images'] as $image){
          $images[] = $image['filename'];
        }
        $author = array();
        foreach($item['expanded'] as $expand)
        {
          if($expand['property_label'] == 'Author'){
            if(array_key_exists('First Name',$expand)){
              $author['firstname'] = $expand['First Name'];
            }
            if(array_key_exists('Last Name',$expand)){
              $author['lastname'] = $expand['Last Name'];
            }
            if(array_key_exists('Last Name',$expand) && array_key_exists('First Name',$expand)){
              $author['name'] = $expand['First Name'] . ' ' . $expand['Last Name'];
            }
            $author['id'] = $expand['object_item_id'];
          }
        }
        $recipient = array();
        foreach($item['expanded'] as $expand)
        {
          if($expand['property_label'] == 'Recipient'){
            if(array_key_exists('First Name',$expand)){
              $recipient['firstname'] = $expand['First Name'];
            }
            if(array_key_exists('Last Name',$expand)){
              $recipient['lastname'] = $expand['Last Name'];
            }
            if(array_key_exists('Last Name',$expand) && array_key_exists('First Name',$expand)){
              $recipient['name'] = $expand['First Name'] . ' ' . $expand['Last Name'];
            }
            $recipient['id'] = $expand['object_item_id'];
          }
        }
        @endphp
        <section class="mt3 mb3">
          <letter-preview-card
          title="{{ $item['Letter Title']}}"
          @if(array_key_exists('Date 1', $item))
            date="{{ $item['Date 1'] }}"
          @endif
          @if(array_key_exists('name', $author))
            :author='{"name":"{{ $author['name'] }}","link":"{{ route('entity.detail',$author['id']) }}"}'
          @endif
          @if(array_key_exists('name', $recipient))
            :recipient='{"name":"{{ $recipient['name'] }}","link":"{{ route('entity.detail',$recipient['id']) }}"}'
          @endif
          :entity-count='{"people": {{ $people ?? 0}},"places": {{ $places ?? 0 }},"events": {{ $events ?? 0 }}, "texts": {{ $texts ?? 0 }}, "objects": {{ $objects ?? 0 }}, "families": {{ $families ?? 0 }}, "works of art": {{ $works ?? 0 }}}'
          link="{{ route('letter', $item['id']) }}"
          @if(array_key_exists(0, $item['images']))
            :letter-bg-src="'https://hayleypapers.fitzmuseum.cam.ac.uk/files/fullsize/{{ $item['images'][0]['filename']}}'"
          @endif
          />
        </section>
      @endforeach


  </section>
  <section class="fl w-100 bg-light-green h-100 flex items-center pv2 mv3">

  <section class="mw8-ns center tc pa3 ph5-ns">
    {{ $paginate->links('paginator.default') }}
  </section>
@endsection
