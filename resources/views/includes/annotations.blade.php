@if($annotations['total'] > 0)
  <section class="w-100 pa3 ph5-ns bg-creme">
    <h1 class="helevtica fw4 b f3">Annotations</h1>
    <accordion-link
    show-text="Show annotations"
    hide-text="Hide annotations"
    slot-content=""
    >
    @foreach ($annotations['rows'] as $annotation)
      <article>
        <p class="f6 lh-copy measure">
            <p class="fw9 lh-copy lh-title-ns berry">
              {!! nl2br($annotation['target'][0]['selector'][2]['exact']) !!} @markdown($annotation['text'])
            </p>
        </article>
      @endforeach
    </accordion-link>
    </section>
  @endif
