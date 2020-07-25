<script id="template-card-home" type="text/x-handlebars-template">
<a href="{{ url('apartments') }}/@{{apartmentID}}">
  <div class="card-search">
    <h4 class="position-absolute">
          <span class="badge badge-success p-2 m-2">@{{ sponsored }}</span>
    </h4>
    <img class="card-img-top" src="@{{ image }}" alt="@{{altImage }}">
      <div class="card-body">
          <h5 class="card-title">@{{ title }}</h5>
          <h6 class="card-title">@{{ apartmentCity }}, @{{ apartmentRegion }}, @{{apartmentProvince}}</h6>
          <label for="distance">Distanza dal luogo scelto</label>
          <span id="distance">@{{ distance }}</span>
          <a class="btn btn-primary" href="{{ url('apartments' ) }}/@{{apartmentID}}">Show</a>
      </div>
  </div>
</a>

<a href="{{ url('apartments') }}/@{{apartmentID}}" class="card-desktop-view">
  <div class="card mb-3">
    <div class="row no-gutters card-desktop">
        <div class="col-md-4 img-container">
          <img src="@{{ image }}" alt="@{{altImage }}" class="card-img" alt="@{{altImage }}">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">@{{ title }}</h5>
            <h5 class="card-title">@{{ apartmentCity }}, @{{ apartmentRegion }}, @{{apartmentProvince}}</h5>
            <label for="distance">Distanza dal luogo scelto</label>
            <span id="distance">@{{ distance }}</span>
          </div>
        </div>
      </div>
    </div>
</a>
</script>