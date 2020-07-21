@include('shared.header')

<div class="container">

    
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Reviews<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Your Clients</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Statistics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Terms of service</a>
              </li>
          </ul>
        </div>
      </nav>

      <div class="jumbotron ">
        <h1 class="display-4">Bentornata {{ Auth::user()->first_name }}</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>Hai 6 dei messaggi non letti</p>
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="#" role="button">Leggi messaggi</a>
        </p>
      </div>

    <div id="carouselExampleIndicators" class="carousel slide pb-10" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/v748-toon-131_1_1.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=c03f4e1df88801665806cbdbaef503d4" alt="First slide">
            <div class="carousel-caption d-none d-md-block text-white">
                <h5>Casa nel bosco</h5>
                <h6>Carlo dice:</h6>
                <p>Ci è piaciuta molto è veramente bella</p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://images.squarespace-cdn.com/content/v1/57e38eac46c3c4b30fb01f60/1540770673639-40TXHKSVXKBUX2GB65EF/ke17ZwdGBToddI8pDm48kNvT88LknE-K9M4pGNO0Iqd7gQa3H78H3Y0txjaiv_0fDoOvxcdMmMKkDsyUqMSsMWxHk725yiiHCCLfrh8O1z5QPOohDIaIeljMHgDF5CVlOqpeNLcJ80NK65_fV7S1USOFn4xF8vTWDNAUBm5ducQhX-V3oVjSmr829Rco4W2Uo49ZdOtO_QXox0_W7i2zEA/maxresdefault.jpg?format=2500w" alt="Second slide">
            <div class="carousel-caption d-none d-md-block text-white">
                <h5 >Casa nella campagna</h5>
                <p>Ci è piaciuta molto è veramente bella</p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://i.dlpng.com/static/png/6804527_preview.png" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="d-flex justify-content-center mt-12">
    <a href="{{ route('admin.apartments.create') }}">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Aggiungi un appartamento</h5>
          <p class="card-text">Here you can add your first accomodation, or add another one.</p>
        </div>
      </div>
    </a>
      <a href="{{ route('admin.apartments.index') }}">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Visiona i tuoi appartamenti</h5>
          <p class="card-text">Clicca qui per vedere i tuoi appartamenti</p>
        </div>
      </div>
    </a>
    <a href="">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Le tue recensioni</h5>
          <p class="card-text">Guarda le recensioni dei tuoi clienti</p>
        </div>
      </div>
    </a>
    </div>


    <img class="d-block w-100" src="https://cdn-skill.splashmath.com/panel-uploads/GlossaryTerm/0053540d59ee4824b70187bce47ef0e4/1551236725_Drawing-a-bar-graph-to-represent-the-data.png" alt="">
</div>
</main>
</div>




@include('shared.footer')
