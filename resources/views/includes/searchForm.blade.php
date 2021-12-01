{{ \Form::open(['url' => url('search/results'),'method' => 'GET', 'class' => 'bg-light-green mw7 center pa4 br2-ns ba b--black-10']) }}

<form class="bg-light-green mw7 center pa4 br2-ns ba b--black-10">
  <fieldset class="cf bn ma0 pa0">
    <legend class="pa0 f5 f4-ns mb3 black-80">Search Most Sacred Things</legend>
    <div class="cf"><label class="clip">Search Most Sacred Things</label>
      <input type="text" class="f6 f5-l input-reset bn fl black-80 bg-white pa3 lh-solid w-100 w-75-m w-80-l br2-ns br--left-ns" placeholder="What do you want to search?" name="query" id="query" value="">
      <input type="submit" class="f6 f5-l button-reset fl pv3 tc bn bg-animate bg-black-70 hover-bg-black white pointer w-100 w-25-m w-20-l br2-ns br--right-ns" value="Search">
    </div>
  </fieldset>
</form>
