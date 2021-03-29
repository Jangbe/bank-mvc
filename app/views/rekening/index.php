<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Rekening</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?= url('admin') ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active"><a href="#">Rekening</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button id="buatRekening" class="btn btn-sm btn-neutral">Buat Baru</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
    <div class="col">
        <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">Daftar Rekening</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <th width="2%">No</th>
                <th>No Rekening</th>
                <th>Saldo</th>
                <th width="50%">Nasabah</th>
                <th>Aksi</th>
            </thead>
            <tbody class="list">
                <?php $i=0; foreach($rekening as $rek): $i++ ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $rek['no_rekening'] ?></td>
                        <td><?= $rek['saldo'] ?></td>
                        <td><?= $rek['nm_nasabah'] ?></td>
                        <td>
                            <button class="btn btn-success edit-rekening" data-norek="<?= $rek['no_rekening'] ?>">
                                <i class="fas fa-edit"></i>
                                <span class="d-none d-md-inline">
                                    Edit
                                </span>
                            </button> 
                            <form style="display: inline" action="<?= url('admin/rekening/delete/').$rek['no_rekening'] ?>" method="post">
                                <button type="button" class="btn btn-danger delete-user">
                                    <i class="fas fa-trash"></i>
                                    <span class="d-none d-md-inline">
                                    Hapus
                                    </span>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="createRekening" tabindex="-1" role="dialog" aria-labelledby="createRekeningLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="modalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRekeningLabel">Buat Rekening Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="norek">No Rekening</label>
                        <input type="text" class="form-control" name="norek" value="<?= $norek ?>"  id="norek" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pin">PIN Rekening</label>
                        <input type="password" class="form-control pin" name="pin" id="pin">
                    </div>
                    <div class="form-group">
                        <label for="pin_old">PIN Old</label>
                        <input type="password" class="form-control pin" name="pin_old" id="pin_old">
                    </div>
                    <div class="form-group">
                        <label for="pin_new">PIN New</label>
                        <input type="password" class="form-control pin" name="pin_new" id="pin_new">
                    </div>
                    <div class="form-group">
                        <label for="id_nasabah">Nasabah</label>
                        <select class="custom-select" name="id_nasabah" id="id_nasabah">
                            <?php foreach($nasabah as $nsbh) : ?>
                            <option value="<?= $nsbh['id_nasabah'] ?>"><?= $nsbh['nm_nasabah'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        $('#rekening').addClass('active');

        $('.delete-user').on('click', function(){
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Rekening akan terhapus selamanya!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak'
            }).then(result => {
                if (result.value) {
                    this.form.submit();
                }
            });
        });

        //validasi input pin harus angka
        $('.pin').on('keydown', function(e){
            if(e.key.length === 1 && e.key.match(/[a-z]/i)){
                e.preventDefault();
            }
        });

        $('#buatRekening').click(function(){
            $('#norek').val('<?= $norek ?>');
            $('#pin').val('').parent().show();
            $('#pin_old').parent().hide();
            $('#pin_new').parent().hide();
            $('#id_nasabah').val('');
            $('#id_nasabah option').attr('disabled', false);
            
            $('#modalForm').attr('action', "<?= url($_SESSION['user']['level'].'/rekening/create') ?>");
            $('#createRekeningLabel').text('Buat Rekening Baru');
            $('#createRekening').modal('show');
        });

        $('.edit-rekening').click(function(e){
            let norek = $(this).data('norek');
            $.ajax({
                url: "<?= url('ajax_rekening') ?>",
                method: "post",
                data: {norek, norek},
                success: function(result){
                    result = JSON.parse(result);
                    $('#norek').val(result.no_rekening);
                    $('#pin').parent().hide();
                    $('#pin_old').parent().show();
                    $('#pin_new').parent().show();
                    $('#id_nasabah').val(result.id_nasabah);
                    $('#id_nasabah option:not(:selected)').attr('disabled', true);

                    $('#modalForm').attr('action', "<?= url($_SESSION['user']['level'].'/rekening/edit/') ?>"+result.no_rekening);
                    $('#createRekeningLabel').text('Edit Rekening '+result.id_nasabah).css('textTransform', 'capitalize');
                    $('#createRekening').modal('show');
                }
            });
        })
    });
</script>