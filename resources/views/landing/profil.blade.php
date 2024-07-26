<x-landing-layout>
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="block block-rounded">
                    <div class="block-header bg-gd-dusk">
                        <h3 class="block-title text-white fw-semibold">Profil Saya</h3>
                        <div class="block-options">

                        </div>
                    </div>
                    <div class="block-content p-4">
                        <form method="POST" action="{{ route('profile.edit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-field type="text" id="nama" name="nama" label="Nama Lengkap" value="{{ $data->nama }}"/>
                                </div>
                                <div class="col-md-6">
                                    <x-input-field type="text" id="perusahaan" name="perusahaan" label="Nama Perusahaan" value="{{ $data->perusahaan }}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-field type="email" id="email" name="email" label="Alamat Email" value="{{ $data->email }}"/>
                                </div>
                                <div class="col-md-6">
                                    <x-input-field type="text" id="hp" name="hp" label="No Handphone" value="{{ $data->hp }}"/>
                                </div>
                            </div>
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