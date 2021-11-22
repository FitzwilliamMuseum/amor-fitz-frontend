@if ($paginator->hasPages())
<div class="dib">
  @if (!$paginator->onFirstPage())
    <a href="{{ \Request::url() }}"><span class="green dib mr3 underline pointer">first</span></a>
  @endif
  <div class="dib dib mr3"><a href="{{ $paginator->previousPageUrl() }}"><div class="button--square serif flex justify-center items-center bg-green creme f4 fw7 pa2 button dim"><span class="flip-h">➺</span></div></a></div>

  <span class="dib mr2">page</span>
<div data-v-63010fd4="" class="dib dib mr2"><div data-v-63010fd4="" class="bg-berry br-100 flex white justify-center items-center sans-serif number-bullet"><span data-v-63010fd4="">{{$paginator->currentPage()}}</span></div></div>
  <span class="dib mr3">of </span>
  <div data-v-e0422746="" class="dib dib mr3"><a href="{{ $paginator->nextPageUrl() }}"><div data-v-e0422746="" class="button--square serif flex justify-center items-center bg-green creme f4 fw7 pa2 button dim">➻</div></a></div>
  <a href="{{ \Request::url() .'?page='.$paginator->lastPage() }}"><span class="green dib underline pointer" >last</span></a>
</div>
@endif
