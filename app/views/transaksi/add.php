<form action="" method="post">
    <label for="norek">No Rekening</label>
    <input type="text" id="norek" class="int" name="norek"><br>
    <label for="jns_transaksi">Jenis Transaksi</label>
    <select name="jns_transaksi" id="jns_transaksi">
        <?php foreach(transaksi() as $k => $tr) : ?>
            <option value="<?= $k ?>"><?= $tr ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="nominal">Nominal</label>
    <input type="text" class="int" name="nominal" id="nominal"><br>
    <div id="tf">
        <label for="no_tf">No Rekening Transfer</label>
        <input type="text" id="no_tf" class="int" name="no_tf"><br>
        <label for="jns_pembayaran">Jenis Pembayaran</label>
        <input type="text" id="jns_pembayaran" name="jns_pembayaran"><br>
        <label for="keterangan">Keterangan</label>
        <input type="text" id="keterangan" name="keterangan"><br>
    </div>
    <button type="submit">Buat</button>
</form>

<script>
    let hide = function(elm) {
        elm.style.display = 'none';
    };
    let show = function(elm) {
        elm.style.display = 'block';
    }
    document.addEventListener('DOMContentLoaded', function(){
        let int = document.querySelectorAll('.int');
        int.forEach(function(nominal){
            nominal.addEventListener('keydown', function(e){
                if(e.key.length === 1 && e.key.match(/[a-z]/i)){
                    e.preventDefault();
                }
            });
        });
        let jns = document.getElementById('jns_transaksi');
        let tf = document.getElementById('tf');
        hide(tf);
        jns.addEventListener('change', function(){
            if(this.value == 'tf'){
                show(tf);
            }else{
                hide(tf);
            }
        })
    });
</script>