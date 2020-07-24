<script id="template-card-home" type="text/x-handlebars-template">
  <div class="card mb-5" style="width: 22rem;">
    <h4 class="position-absolute">
          <span class="badge badge-success p-2 m-2">@{{ sponsored }}</span>
    </h4>
    <img class="card-img-top" src="@{{ image }}" alt="@{{altImage }}">
      <div class="card-body">
          <h5 class="card-title">@{{ title }}</h5>
          <h6 class="card-title">@{{ apartmentCity }}, @{{ apartmentRegion }}, @{{apartmentProvince}}</h6>
          <p class="card-text">@{{ apartmentDescription }}</p>
          <label for="distance">Distanda dal luogo scelto</label>
          <span id="distance">@{{ distance }}</span>
          <a class="btn btn-primary" href="{{ url('apartments' ) }}/@{{apartmentID}}">Show</a>
      </div>
  </div>
</script>