@include('shared.header')

<main class="py-4">
    <div class="container text-center">
        <a class="btn btn-lg btn-primary w-50 mt-5" href="{{ route('admin.apartments.create') }}">
            Add a new apartment
         </a>
        <a class="btn btn-lg btn-danger w-50 mt-5" href="{{ route('admin.apartments.index') }}">
            Your apartments
         </a>
    </div>
    
</main>


@include('shared.footer')
