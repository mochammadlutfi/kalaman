<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <title>Login - Infotech Global Indonesia</title>

        <meta name="description" content="Infotech Global Indonesia">
        <meta name="robots" content="noindex, nofollow">
        <!-- Stylesheets -->
        <!-- Codebase framework -->
        <link rel="stylesheet" id="css-main" href="/css/codebase.min.css">
        @vite(['resources/sass/main.scss', 'resources/js/codebase/app.js',
        'resources/js/app.js'])
    </head>

    <body>
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->

                <div class="row mx-0 justify-content-center">
                    <div class="col-lg-4 col-xl-4 d-flex hero-static justify-content-center">
                        <div class="my-auto">
                            <img src="/images/logo.png" width="200px" class="">
                        </div>
                    </div>
                    <div class="hero-static col-lg-6 col-xl-5">
                        <div class="content content-full overflow-hidden">
                            <!-- Header -->
                            <div class="py-4 text-center">
                                <h1 class="h3 fw-bold mt-4 mb-2">Login Sekarang</h1>
                                <h4 class="h5 fw-medium mt-4 mb-2">Belum Punya Akun ?
                                    <a href="{{ route('register') }}">Daftar Sekarang</a>
                                </h4>
                            </div>
                            <!-- END Header -->

                            <div class="block block-rounded">
                                <div class="block-content">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label" for="val-email">Alamat Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="text"
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                id="val-email"
                                                name="email"
                                                placeholder="Masukan Email">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="val-password">Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="password"
                                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                id="val-password"
                                                name="password"
                                                placeholder="Masukan password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 d-sm-flex align-items-center push">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="login-remember-me"
                                                        name="login-remember-me">
                                                    <label class="form-check-label" for="login-remember-me">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 text-sm-end push">
                                                <button type="submit" class="btn btn-lg btn-alt-primary fw-medium">
                                                    Login Sekarang
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END Sign Up Form -->
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </body>
</html>