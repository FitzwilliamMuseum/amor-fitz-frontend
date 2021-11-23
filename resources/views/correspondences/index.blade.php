@extends('layouts.default')
@section('breadcrumbs')
<breadcrumbs
    :path-list='[{"text":"Correspondences","path":"{{ route('correspondences')}}"}]'
  />
@endsection
@section('title', 'Hayley\'s correspondence')
@section('content')
  <section class="mw9 mw9-ns center bg-creme pa3 ph5-ns">
    <h1 class="serif">{{ $page['title']}}</h1>
    {!! $page['text'] !!}

  </section>
<section class="bg-creme">
  <section class="mw3 mw8-ns center bg-creme pa3 ph5-ns">
  @foreach($records as $item)
    @php
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
      {{-- @dd($item) --}}
  <section class="mw9 mv3">
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
       :entity-count='{"people":5,"places":3,"events":7}'
       link="{{ route('letter', $item['id']) }}"
       @if(array_key_exists(0, $item['images']))
       :letter-bg-src="'https://hayleypapers.fitzmuseum.cam.ac.uk/files/fullsize/{{ $item['images'][0]['filename']}}'"
       @endif
    />
  </section>
  @endforeach

</section>

</section>
<section class="mw9 mw9-ns center bg-creme pa3 ph5-ns cf">
  {{ $paginate->links('paginator.default') }}
</section>
@endsection
