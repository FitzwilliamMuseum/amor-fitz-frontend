@php
$filtered = array_filter($data, function($arr){
  return array_key_exists('Date 1', $arr);
});
@endphp
{
  "title": {
    "media": {
      "url": "https://hayleypapers.fitzmuseum.cam.ac.uk/files/fullsize/9321b5a42258cb0ec8adb9795a633b5c.jpg",
      "caption": "Timeline of letters for the tag {{ implode(',', $params) }}",
      "credit": "The Fitzwilliam Museum"
    }
    ,
    "background": {
    "color": "#2B2B2E"
    },
    "text": {
      "headline": "Hayley's letters through time",
      "text": "<p>Letters for the tag {{ implode(',', $params) }}</p>"
    }
  },
  "events": [
  @foreach ($filtered as $datum)
    @if(Arr::exists($datum, 'Date 1'))
      @php
      $dates = explode('-',$datum['Date 1']);
      @endphp
      {
        "media": {
          "url": "{{ $datum['images']['file_urls']['fullsize']}}",
          "caption": "The front page of letter {{ $datum['Title'] }}",
          "credit": "The Fitzwilliam Museum",
          "link": "{{route('letter', [$datum['id']])}}",
          "link_target": "_parent",
          "thumbnail": "{{ $datum['images']['file_urls']['square_thumbnail']}}"
        },
        "start_date": {
          "month": "{{ $dates[2]}}",
          "day": "{{ $dates[1]}}",
          "year": "{{ $dates[0]}}"
        },
        "background": {
        "color": "#2B2B2E"
        },
        "text": {
          "headline": "{{ $datum['Letter Title']}} {{ $datum['Title'] }}",
          "text": "{{ json_encode(substr(strip_tags($datum['Transcription']),0,200)) }}..."
        }
      }@if(!$loop->last),@endif
      @endif
    @endforeach

    ]
  }
