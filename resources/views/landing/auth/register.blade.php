<x-landing-layout>

    <div class="content content-full overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Header -->
                <div class="py-4 text-center">
                    <h1 class="h3 fw-bold mt-2 mb-2">Buat Akun</h1>
                    <h4 class="h5 fw-medium mt-2 mb-2">Sudah Punya Akun ? <a
                            href="{{ route('login') }}">Masuk</a></h4>
                </div>
                <!-- END Header -->
        
                <div class="block block-rounded">
                    <div class="block-content">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
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
                                <button type="submit" class="btn btn-lg btn-gd-main rounded-pill fw-medium w-100">
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
</x-landing-layout>