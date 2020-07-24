<script id="template-card-home" type="text/x-handlebars-template">
<a href="{{ url('apartments') }}/@{{apartmentID}}">
  <div class="card mb-5" style="width: 22rem;">
    <h4 class="position-absolute">
          <span class="badge badge-success p-2 m-2">@{{ sponsored }}</span>
    </h4>
    <img class="card-img-top" src="@{{ image }}" alt="@{{altImage }}">
      <div class="card-body">
          <h5 class="card-title">@{{ title }}</h5>
          <h6 class="card-title">@{{ apartmentCity }}, @{{ apartmentRegion }}, @{{apartmentProvince}}</h6>
          <label for="distance">Distanza dal luogo scelto</label>
          <span id="distance">@{{ distance }}</span>
          
      </div>
  </div>
</a>
</script>