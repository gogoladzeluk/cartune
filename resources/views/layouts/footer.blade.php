<footer class="d-flex flex-wrap justify-content-start align-items-center mt-auto py-3 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"></svg>
        </a>
        <span class="text-muted">© {{ sprintf('%s %s', now()->year, config('app.name')) }}</span>
    </div>

    <ul class="nav col-md-4 justify-content-center list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="https://www.facebook.com/CarTuuune/" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a></li>
        <li class="ms-3"><a class="text-muted" href="https://www.linkedin.com/company/cartune0/" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
    </ul>

    <div class="col-md-4 d-flex justify-content-center">
        <span class="text-muted">{{ __('Contact') }}: +995 555 29 02 70</span>
    </div>
</footer>
