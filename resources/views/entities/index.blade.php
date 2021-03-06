@extends('layouts.default')
@section('title',  $page['title'])
@section('description', 'A paginated listing of entities found in Hayley\'s correspondence')
@section('breadcrumbs')
  <breadcrumbs
  :path-list='[
  {"text":"Entities","path":"{{ route('entities')}}"}
  ]'
  />
@endsection
@section('content')

  <header class="tc ph4 mb3">
    <h1 class="f3 f2-m f1-l fw4 black-90 mv3 helvetica">
    {{ $page['title']}}
    </h1>
    <h2 class="f5 f4-m f3-l fw2 berry mt0 lh-copy">
      Discover entities within the correspondence
    </h2>
  </header>

  <section class="pv3 w-100 center tc bg-white ph5-ns">
    <correspondence-list
   :correspondences='[
   {
     "names":["People"],
     "backgroundIds":["blake"],
     "curatorialStatement":"Find out about the people in Hayley’s life.",
     "buttonLink": "{{ route('entity', ['person']) }}"
   },
   {
     "names":["Locations"],
     "backgroundIds":["flaxman"],
     "curatorialStatement":"Find out about geographical locations in Hayley&apos;s world.",
     "buttonLink": "{{ route('entity', ['place']) }}"
   },
   {
     "names":["Families"],
     "backgroundIds":["flaxman"],
     "curatorialStatement":"Hayley mentioned several families in his correspondence. ",
     "buttonLink": "{{ route('entity', ['family']) }}"
   },
   {
     "names":["Events"],
     "backgroundIds":["flaxman"],
     "curatorialStatement":"Events mentioned in the letters.",
     "buttonLink": "{{ route('entity', ['event']) }}"
   },
   {
     "names":["Texts"],
     "backgroundIds":["flaxman"],
     "curatorialStatement":"Texts discussed in Hayley’s correspondence.",
     "buttonLink": "{{ route('entity', ['text']) }}"
   },
   {
     "names":["Sculptures"],
     "backgroundIds":["flaxman"],
     "curatorialStatement":"Memorials and other sculptures discussed.",
     "buttonLink": "{{ route('entity', ['sculpture']) }}"
   },
   {
     "names":["Pictures"],
     "backgroundIds":["flaxman"],
     "curatorialStatement":"Paintings, drawings and prints mentioned.",
     "buttonLink": "{{ route('entity', ['pictures']) }}"
   }
   ]'
 />

  </section>
@endsection
