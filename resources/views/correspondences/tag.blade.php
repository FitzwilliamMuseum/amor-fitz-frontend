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
@section('title', 'Hayley\'s correspondence')
@section('description', 'An index of Hayley\'s correspondence')
@section('content')
  <section class="mw9 mw9-ns bg-white pa3 ph5-ns">
    <h1 class="f1 helvetica fw4 tc">{{ $page['title']}} tagged:<br/> <span class="purple">{{ implode(' / ', $tag) }}</span></h1>

  </section>

  {{-- <section class="pv3 cf bg-white ph5-ns">
    <h2 class="fw3 tc f4">Who was corresponding with whom for this tag?</h2>
    <article>
      <correspondence-list
      :correspondences='[
      @foreach($convos as $con)
        @php
        $names = '"'. str_replace('/', '","',$con[0]['names']) . '"';
        $count = count($con);
        $tags = array();
        $ids = array();
        foreach ($con as $c) {
          $ids =  $c['tags'];
        }
        $idList =  implode(',', array_unique($ids));
        $bgs = array();
        $bg = explode('/', $con[0]['names']);
        foreach($bg as $b){
          if($b != 'William Hayley'){
            $bgs[] = Str::slug($b);
          }
        }
        $backgrounds = '"'.  implode('","',$bgs) . '"';
        @endphp
        {"names":[{!! $names !!}],"backgrounds":[{{$backgrounds}}],"numberletters":{!! $count !!},"curatorial-statement":"", "buttonLink": "{{ route('tag', $idList) }}"},
      @endforeach
      ]'
      />

    </article>

  </section> --}}

  <section class="pv3 bg-white ph7-ns">
    <div class="ph3 ph5-ns">
      {{-- <h2 class="fw4">Letters tagged with</h2>
       <span class="purple">
        <p>
          @foreach($tag as $t)
           @if (!$loop->last)
             {{ $t }}<br>
          @else
            {{  $t }}
          @endif
         @endforeach
        </p>
       </span> --}}
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
        <section class="mw9 mv3 ">
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
    </div>
    <section class="mw8-ns center tc bg-white pa3 ph5-ns">
      {{ $paginate->links('paginator.default') }}
    </section>
  </section>


@endsection
