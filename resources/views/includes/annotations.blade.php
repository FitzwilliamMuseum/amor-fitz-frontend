@if(!empty($annotations))
  <section class="w-100 pa3 ph5-ns bg-creme">
    <h1 class="serif b f3">Annotations</h1>
    <accordion-link
    show-text="Show annotations"
    hide-text="Hide annotations"
    slot-content=""
    >
    @foreach ($annotations['rows'] as $annotation)
      <article>
        <p class="f6 lh-copy measure">
          <blockquote class="ph0 f4 f7-ns measure-narrow ">
            <p class="fw9 lh-copy lh-title-ns purple">
              {!! nl2br($annotation['target'][0]['selector'][2]['exact']) !!}</blockquote>
            </p>
          </blockquote>
          <p class="f6">{{ $annotation['text'] }}</p>
        </article>
      @endforeach
    </accordion-link>  
    </section>
  @endif
