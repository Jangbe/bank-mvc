<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Log Transaksi</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?= url('admin') ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active"><a href="#">Transaksi</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button id="generateLaporan" data-toggle="modal" data-target="#generateModal" class="btn btn-sm btn-neutral">
                        <i class="fas fa-file-pdf"></i>
                        Generate Laporan
                    </button>
                    <button id="buatRekening" class="btn btn-sm btn-neutral">
                        <i class="fas fa-plus"></i>
                        Buat Baru
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>