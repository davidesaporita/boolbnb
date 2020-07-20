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

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Winchester_House_Front.jpg/1200px-Winchester_House_Front.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block bg-dark text-white">
                <h5>Casa nel bosco</h5>
                <h6>Carlo dice:</h6>
                <p>Ci è piaciuta molto è veramente bella</p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://www.collater.al/wp-content/uploads/2019/12/House-in-the-Landscape-Collater.al-2.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block bg-dark text-white">
                <h5 >Casa nella campagna</h5>
                <p>Ci è piaciuta molto è veramente bella</p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://www.marketingjournal.it/wp-content/uploads/2020/02/1villa.jpg" alt="Third slide">
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
      


<main class="py-4">

    <div class="container text-center">
        <a class="btn btn-lg btn-primary w-50 mt-5" href="{{ route('admin.apartments.create') }}">
            Add a new apartment
        </a>
        <a class="btn btn-lg btn-danger w-50 mt-5" href="{{ route('admin.apartments.index') }}">
            Your apartments
        </a>
    </div>

    <img class="d-block w-100" src="https://cdn-skill.splashmath.com/panel-uploads/GlossaryTerm/0053540d59ee4824b70187bce47ef0e4/1551236725_Drawing-a-bar-graph-to-represent-the-data.png" alt="">
</div>
</main>




@include('shared.footer')
