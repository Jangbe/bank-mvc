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
                <li class="breadcrumb-item active">Dashboards</li>
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
                        <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                        <i class="fas fa-dollar-sign"></i>
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
    <div class="col-xl-12">
        <div class="card bg-default">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
            <div class="col">
                <h6 class="text-light text-uppercase ls-1 mb-1">Statistik Transaksi</h6>
                <h5 class="h3 text-white mb-0">Bulan <?= date('F') ?></h5>
            </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Chart -->
            <div class="chart">
            <!-- Chart wrapper -->
            <canvas id="line-chart" class="chart-canvas"></canvas>
            </div>
        </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('#dashboard').addClass('active');

            var BarsChart = (function() {

            var $chart = $('#line-chart');
            var id_nasabah = "<?= level('id'); ?>";
            function initChart($chart) {

                $.ajax({
                    url: "http://localhost/bank-mvc/public/ajax_statistic_nasabah",
                    method: 'POST',
                    data: {id_nasabah:id_nasabah},
                    success: function(result){
                        result = JSON.parse(result);
                        console.log(result);
                        // Create chart
                        var ordersChart = new Chart($chart, {
                            type: 'line',
                            data: {
                                labels: result.days,
                                datasets: [{
                                    label: 'Jumlah',
                                    data: result.statis
                                }]
                            }
                        });

                        // Save to jQuery object
                        $chart.data('chart', ordersChart);
                    }
                });
            }


            // Init chart
            if ($chart.length) {
                initChart($chart);
            }

            })();

        });
    </script>