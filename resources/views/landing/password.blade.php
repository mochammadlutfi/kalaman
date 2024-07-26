<x-landing-layout>
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="block block-rounded">
                    <div class="block-header bg-gd-dusk">
                        <h3 class="block-title text-white fw-semibold">Ubah Password</h3>
                        <div class="block-options">

                        </div>
                    </div>
                    <div class="block-content p-4">
                        <form method="POST" action="{{ route('profile.password') }}">
                            @csrf
                            <x-input-field type="password" id="old_password" name="old_password" label="Password Lama"/>
                            <x-input-field type="password" id="password" name="password" label="Password Baru"/>
                            <x-input-field type="password" id="password_conf" name="password_conf" label="Konfirmasi Password"/>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-lg btn-gd-main rounded-pill fw-medium w-100">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>