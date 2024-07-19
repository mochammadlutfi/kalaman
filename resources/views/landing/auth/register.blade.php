<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Daftar - Infotech Global Indonesia</title>

    <meta name="description" content="Infotech Global Indonesia">
    <meta name="robots" content="noindex, nofollow">
    <!-- Stylesheets -->
    <!-- Codebase framework -->
    <link rel="stylesheet" id="css-main" href="/css/codebase.min.css">
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/js/plugins/flatpickr/flatpickr.min.css">
    @vite(['resources/sass/main.scss', 'resources/js/codebase/app.js',
    'resources/js/app.js'])
</head>

<body>
    <div id="page-container" class="main-content-boxed">

        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="bg-image" style="background-image: url('/images/bgfutsal.jpg');">
                <div class="row mx-0 justify-content-center">
                    <div class="col-lg-4 col-xl-4 d-flex hero-static justify-content-center">
                        <div class="my-auto">
                            <img src="/images/logo.png" width="200px" class="">
                        </div>
                    </div>
                    <div class="hero-static col-lg-6 col-xl-6">
                        <div class="content content-full overflow-hidden">
                            <!-- Header -->
                            <div class="py-4 text-center">
                                <h1 class="h3 fw-bold mt-2 mb-2">Daftar Sekarang</h1>
                                <h4 class="h5 fw-medium mt-2 mb-2">Sudah Punya Akun ? <a
                                        href="{{ route('login') }}">Login Sekarang</a></h4>
                            </div>
                            <!-- END Header -->

                            <div class="block block-rounded">
                                <div class="block-content">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label class="form-label" for="val-nama">Nama Lengkap<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                                        id="val-nama" name="nama" placeholder="Masukan Nama Lengkap"
                                                        value="{{ old('nama') ?? '' }}">
                                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="val-email">Alamat Email
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                        id="val-email" name="email" placeholder="Masukan Email"
                                                        value="{{ old('email') ?? '' }}">
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="val-tmp_lahir">Tempat Lahir<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('tmp_lahir') ? 'is-invalid' : '' }}"
                                                        id="val-tmp_lahir" name="tmp_lahir"
                                                        placeholder="Masukan Tempat Lahir"
                                                        value="{{ old('tmp_lahir') ?? '' }}">
                                                    <x-input-error :messages="$errors->get('tmp_lahir')" class="mt-2" />
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="val-instansi">Instansi
                                                    </label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('instansi') ? 'is-invalid' : '' }}"
                                                        id="val-instansi" name="instansi" placeholder="Masukan Instansi"
                                                        value="{{ old('instansi') ?? '' }}">
                                                    <x-input-error :messages="$errors->get('instansi')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label class="form-label" for="val-hp">No HP/Wa<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('hp') ? 'is-invalid' : '' }}"
                                                        id="val-hp" name="hp" placeholder="Masukan No HP"
                                                        value="{{ old('hp') ?? '' }}">
                                                    <x-input-error :messages="$errors->get('hp')" class="mt-2" />
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="val-jk">Jenis Kelamin<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select
                                                        class="form-select {{ $errors->has('jk') ? 'is-invalid' : '' }}"
                                                        id="field-jk" style="width: 100%;" name="jk">
                                                        <option value="L" {{ old('jk' == 'L') ? 'selected' : '' }}>
                                                            Laki-Laki</option>
                                                        <option value="P" {{ old('jk' == 'P') ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('jk')" class="mt-2" />
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="val-tgl_lahir">Tanggal Lahir<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('tgl_lahir') ? 'is-invalid' : '' }}"
                                                        id="val-tgl_lahir" name="tgl_lahir"
                                                        placeholder="Masukan Tempat Lahir"
                                                        value="{{ old('tgl_lahir') ?? '' }}">
                                                    <x-input-error :messages="$errors->get('tgl_lahir')" class="mt-2" />
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="val-jabatan">Jabatan
                                                    </label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }}"
                                                        id="val-jabatan" name="jabatan" placeholder="Masukan Jabatan"
                                                        value="{{ old('jabatan') ?? '' }}">
                                                    <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="val-alamat">Alamat<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}"
                                                id="val-alamat" name="alamat" placeholder="Masukan Alamat"
                                                value="{{ old('nama') ?? '' }}">
                                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="val-password">Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="password"
                                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                id="val-password" name="password" placeholder="Masukan password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-lg btn-alt-primary fw-medium w-100">
                                                Daftar
                                            </button>
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
    <script src="/js/jquery.min.js"></script>
    <script src="/js/plugins/flatpickr/flatpickr.min.js"></script>
    <script src="/js/plugins/flatpickr/l10n/id.js"></script>
    <script src="/js/plugins/ckeditor5-classic/build/ckeditor.js"></script>
    <script>
        $("#val-tgl_lahir").flatpickr({
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "Y-m-d",
            locale : "id",
        });
    </script>
</body>

</html>