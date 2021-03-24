      <!-- Footer -->
      <footer class="footer pt-0 mt-5">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2021 <a href="#" class="font-weight-bold ml-1" target="_blank">Kelompok 2</a>
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
  <!-- Argon JS -->
  <script src="<?= url() ?>assets/js/argon.js?v=1.2.0"></script>
  <script>
      setInterval(() => {
          $('.alert').fadeOut();
      }, 3000);
  </script>
</body>

</html>
