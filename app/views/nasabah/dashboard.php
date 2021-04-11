<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
    <div class="header-body">
        <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Nasabah</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nasabah</li>
            </ol>
            </nav>
        </div>
        </div>
        <!-- Card stats -->
        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Rekening</h5>
                        <span class="h2 font-weight-bold mb-0"><?= count($rekening) ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Saldo</h5>
                        <span class="h2 font-weight-bold mb-0">Rp. <?= number_format($total_saldo,0,',','.') ?>,00</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
    <div class="col-xl-8">
        <div class="card bg-default">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
            <div class="col">
                <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                <h5 class="h3 text-white mb-0">Sales value</h5>
            </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Chart -->
            <div class="chart">
            <!-- Chart wrapper -->
            <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
            </div>
        </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
            <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                <h5 class="h3 mb-0">Total orders</h5>
            </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Chart -->
            <div class="chart">
            <canvas id="chart-bars" class="chart-canvas"></canvas>
            </div>
        </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('#dashboard').addClass('active');
        });
    </script>