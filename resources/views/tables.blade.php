<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-4 mb-5">
                        <div class="full-background"
                            style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Collect your benefits 🔥</h3>
                            <p class="mb-4 font-weight-semibold">
                                Check all the advantages and choose the best.
                            </p>
                            <button type="button"
                                class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0">
                                <span class="btn-inner--icon">
                                    <svg width="14" height="14" viewBox="0 0 14 14"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="d-block me-2">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 14C10.866 14 14 10.866 14 7C14 3.13401 10.866 0 7 0C3.13401 0 0 3.13401 0 7C0 10.866 3.13401 14 7 14ZM6.61036 4.52196C6.34186 4.34296 5.99664 4.32627 5.71212 4.47854C5.42761 4.63081 5.25 4.92731 5.25 5.25V8.75C5.25 9.0727 5.42761 9.36924 5.71212 9.52149C5.99664 9.67374 6.34186 9.65703 6.61036 9.47809L9.23536 7.72809C9.47879 7.56577 9.625 7.2926 9.625 7C9.625 6.70744 9.47879 6.43424 9.23536 6.27196L6.61036 4.52196Z" />
                                    </svg>
                                </span>
                                <span class="btn-inner--text">Watch more</span>
                            </button>
                            <img src="../assets/img/3d-cube.png" alt="3d-cube"
                                class="position-absolute top-0 end-1 w-25 max-width-200 mt-n6 d-sm-block d-none" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid py-4 px-1">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Entry Data Dokumen') }}</h6>
                    </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        <div class="form-group">
                            <label for="objective_id" class="form-label">Objective Id</label>
                            <input name="objective_id" class="form-control" id="objective_id" value="" placeholder="Masukkan objective id dokumen">
                            @error('objective_id') <div class="alert text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="objective" class="form-label">Objective</label>
                            <div class="@error('objective')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Masukkan objective dokumen" id="objective" value="">
                            </div>
                            @error('kode_dosen_wali') <div class="alert text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="kebutuhan_dokumen" class="form-label">Kebutuhan Dokumen</label>
                            <div class="@error('kebutuhan_dokumen')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Masukkan Kebutuhan Dokumen" id="kebutuhan_dokumen" value="{{ old('kebutuhan_dokumen') }}">
                            </div>
                            @error('kebutuhan_dokumen') <div class="alert text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="form-control-label">Deskripsi</label>
                            <div class="@error('deskripsi')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Masukkan Deskripsi Dokumen" id="deskripsi" value="{{ old('deskripsi') }}">
                            </div>
                            @error('deskripsi') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="file" class="form-control-label">Upload Dokumen</label>
                            <div class="@error('file') border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Pilih Dokumen yang Ingin diupload" id="file"  value="{{ old('dile') }}">
                            </div>
                            @error('file') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Submit</button>
                    </div>

            </div>
        </div>
    </div>
</div>
        </div>
    </main>

</x-app-layout>
