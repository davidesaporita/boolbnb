<script id="template-card-home" type="text/x-handlebars-template"> 

<div class="card-search card-search-mobile">
    <h4 class="position-absolute">
          <span class="badge badge-success p-2 m-2">@{{ sponsored }}</span>
    </h4>
    <a href="{{ url('apartments') }}/@{{apartmentID}}">
      <img class="card-img-top" src="@{{ image }}" alt="@{{altImage }}">
    </a>
    <div class="card-body">
      <a href="{{ url('apartments') }}/@{{apartmentID}}">
        <h4 class="card-title">@{{ title }}</h4>
      </a>
      <h5 class="card-title">@{{ apartmentCity }}, @{{ apartmentRegion }}</h5>
      <span  style="display: block">@{{ apartmentAddress }}</span>
      <label for="distance">Distanza: </label>
      <span id="distance">@{{ distance }} Km</span> 
    </div>
</div>

<a href="{{ url('apartments') }}/@{{apartmentID}}" class="card-desktop-view">
  <div class="card mb-3 card-desktop-view">
    <div class="row no-gutters card-desktop">
        <div class="col-md-4 img-container">
          <img src="@{{ image }}" alt="@{{altImage }}" class="card-img" alt="@{{altImage }}">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h4 class="card-title">@{{ title }}</h4>
            <h5 class="card-title">@{{ apartmentCity }}, @{{ apartmentRegion }}</h5>
            <span  style="display: block">@{{ apartmentAddress }}</span>
            <label for="distance">Distanza: </label>
            <span id="distance">@{{ distance }} Km</span> 
          </div>
        </div>
      </div>
    </div>
</a>
</script>