@include('shared.header')

<div class="container">
<main class="py-4">
    <nav class=" navbar-light bg-light">
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Statistics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Inbox</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Calendar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Your profile</a>
              </li>
          </ul>
      </nav>
    <div class="container text-center">
        <a class="btn btn-lg btn-primary w-50 mt-5" href="{{ route('admin.apartments.create') }}">
            Add a new apartment
        </a>
        <a class="btn btn-lg btn-danger w-50 mt-5" href="{{ route('admin.apartments.index') }}">
            Your apartments
        </a>
    </div>
    
</main>
</div>


@include('shared.footer')
