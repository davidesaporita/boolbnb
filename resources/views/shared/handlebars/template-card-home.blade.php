<script id="template-card-home" type="text/x-handlebars-template">
  <div class="card mb-5" style="width: 22rem;">
  <img class="card-img-top" src="@{{ image }}" alt="@{{altImage }}">
    <div class="card-body">
        <h5 class="card-title">@{{ title }}</h5>
        <h6 class="card-title">@{{ apartmentCity }}, @{{ apartmentRegion }}, @{{apartmentProvince}}</h6>
        <p class="card-text">@{{ apartmentDescription }}</p>
        <a class="btn btn-primary" href="{{ url('guest') }}/@{{apartmentID}}">Show</a>
    </div>
</div>
</script>