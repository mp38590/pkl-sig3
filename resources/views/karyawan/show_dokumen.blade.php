<x-app-layout>
<!-- VIEW -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px; absolute; top: 50%; left: 50%; transform: translate(-49%);">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Dokumen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="header font-weight-bold" style="font-size: 20px; color: black;">
                @foreach($detail_dokumen as $data)
                Tahun <span style="margin-left: 10px;"> : {{ $data->tahun }} <br> </span>
                Versi <span style="margin-left: 22px;"> : {{ $data->versi }} </span>
                @endforeach
            </div>
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 mt-5">
                    <thead>
                        <tr>
                            <!-- <span class="d-flex align-items-center py-3 px-4 text-sm"> -->
                                <!-- <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault">
                                </div> -->
                                <th class="text-info text-s font-weight-semibold ps-3" style="text-align: center;">No.</th>
                                <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Nama Dokumen</th>
                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Inserted By</th>
                                <th class="text-info text-s font-weight-semibold ps-1" style="text-align: center;">Updated By</th>
                                <th class="text-info text-s font-weight-semibold ps-2" style="text-align: center;">Action</th>
                            <!-- </span> -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detail_dokumen as $index => $data)
                            <tr>
                                <th class="font-weight-normal text-sm text-dark ps-3">{{ $index + 1 }}</th>
                                <th class="font-weight-normal text-sm text-dark ps-0 me-4">{{ $data->nama_dokumen }}</th>
                                <th class="font-weight-normal text-sm text-dark ps-1">{{ $data->inserted_by }}</th>
                                <th class="font-weight-normal text-sm text-dark ps-1">{{ $data->updated_by }}</th>
                                <th class="text-secondary text-xs font-weight-semibold ps-2">
                                <button type="button" class="btn btn-primary btn-sm position-relative mt-1 mb-1" style="width: 30px; height: 30px;">
                                    <a href="{{ route('lihat_file', ['id' => $data->id]) }}" style="text-decoration: none; color: inherit;" target="_blank">
                                        <img src="../assets/img/small-logos/dokumen.png" alt="Logo" class="position-absolute start-50 top-50 translate-middle" style="width: 17px; height: 17px;">
                                    </a>
                                </button>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ 'Tidak Ada Data yang ditampilkan' }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
</x.app.layout>