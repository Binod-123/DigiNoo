<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}" />
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">DigiNoo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/product') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/pricing') }}">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="#" class="btn btn-outline-light btn-login">Login</a>
                    <a href="#" class="btn btn-primary btn-member">Become a Member</a>
                </div>
            </div>
        </div>
    </nav>
    <header>
        <div class="hero-content text-white">
            <h1>Creating a Beautiful <br />& Useful Solution</h1>
            <p>We know how large objects will act, but things on a small scale just do not act that way.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="btn btn-primary">Get Quote Now</a>
                <a href="trans_plaid_amount" class="btn btn-outline-light">Learn More</a>
            </div>
        </div>
    </header>

    <section class="service-cards container">
        <div class="row">

            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon">
                        <img src="{{ asset('assets/images/icn-md-1.png') }}" alt="icn" />
                    </div>
                    <h5>Investment Trading</h5>
                    <p>The quick fox jumps over the lazy dog</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon">
                        <img src="{{ asset('assets/images/icn-md-1.png') }}" alt="icn" />
                    </div>
                    <h5>Raising Funds</h5>
                    <p>The quick fox jumps over the lazy dog</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card bg-primary text-white">
                    <div class="icon">
                        <img src="{{ asset('assets/images/icn-md-2.png') }}" alt="icn" />
                    </div>
                    <h5>Financial Analysis</h5>
                    <p>The quick fox jumps over the lazy dog</p>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-7LCdQ7jxAvpHTjV9pSgAV5X5UZZt+IEqYglIqG4h+27gyN8F6eRejSN/cHHEmpaZ" crossorigin="anonymous"></script>
</body>
</html>
