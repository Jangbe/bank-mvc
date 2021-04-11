      <!-- Footer -->
      <footer class="footer pt-0 mt-2">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2021 Dibuat oleh <a href="#" class="font-weight-bold ml-1" target="_blank">Kelompok 2</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?= url() ?>assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?= url() ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= url() ?>assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="<?= url() ?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?= url() ?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="<?= url() ?>assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="<?= url() ?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <script src="<?= url() ?>assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="<?= url() ?>assets/vendor/select2/dist/js/select2.full.min.js"></script>
  <script src="<?= url() ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= url() ?>assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= url() ?>assets/js/moment.js"></script>
  <script src="<?= url() ?>assets/js/daterangepicker.js"></script>
  <!-- Argon JS -->
  <script src="<?= url() ?>assets/js/argon.js?v=1.2.0"></script>
  <script> 
    $('.table').DataTable({
      destroy: true,
      "bSort": false,
      "language": {
        "sEmptyTable":     "Data tidak tersedia di tabel",
        "sInfo":           "Menampilkan"+" _START_ "+"sampai"+" _END_ "+"dari"+" _TOTAL_ "+"baris",
        "sInfoEmpty":      "Menampilkan"+" 0 "+"sampai"+" 0 "+"dari"+" 0 "+"baris",
        "sInfoFiltered":   "("+"tersaring"+" "+"dari"+" _MAX_ "+"total"+" "+"baris"+")",
        "sInfoPostFix":    "",
        "sInfoThousands":  ".",
        "sLengthMenu":     "Tampilkan"+" _MENU_ "+"baris",
        "sLoadingRecords": "Tunggu...",
        "sProcessing":     "Sedang memproses...",
        "sSearch":         "Cari"+":",
        "sZeroRecords":    "Data tidak cocok",
        "oPaginate": {
            "sNext": "<i class='ni ni-bold-right'></i>",
            "sPrevious": "<i class='ni ni-bold-left'></i>"
        }
      }
    });
  </script>
  <?php getFlash('pesan', function($msg){ ?>
      <script>
        Swal.fire({
        position: 'top-end',
        type: '<?= $msg['type'] ?>',
        title: '<?= $msg['message'] ?>',
        showConfirmButton: false,
        timer: 2000
      })
      </script>
  <?php }); ?>
</body>

</html>
