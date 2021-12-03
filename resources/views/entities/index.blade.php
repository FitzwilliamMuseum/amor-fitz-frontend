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
  <section class="mw9 mw9-ns center bg-white  ph5-ns">
    <h1 class="f1 helvetica tc fw4">{{ $page['title']}}</h1>
  </section>

  <section class="pv3 w-100 center tc bg-white ph5-ns">
    <correspondence-list
   :correspondences='[
   {
     "names":["People"],
     "backgroundIds":["blake"],
     "curatorialStatement":"Discover the people in Hayley&apos;s life who influenced him.",
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
     "curatorialStatement":"His letters mention events that affected the correspondents. ",
     "buttonLink": "{{ route('entity', ['event']) }}"
   },
   {
     "names":["Texts"],
     "backgroundIds":["flaxman"],
     "curatorialStatement":"Hayley mentions texts within his writing, written by others.",
     "buttonLink": "{{ route('entity', ['text']) }}"
   }
   ]'
 />

  </section>
@endsection
