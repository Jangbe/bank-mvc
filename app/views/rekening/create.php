<form action="" method="post">
<table>
    <tr>
        <td>No Rekening</td>
        <td>:</td>
        <td><input type="text" name="norek" value="<?= $norek ?>" readonly></td>
    </tr>
    <tr>
        <td>PIN Rekening</td>
        <td>:</td>
        <td><input type="password" name="pin" id="pin"></td>
    </tr>
    <tr>
        <td>Nasabah</td>
        <td>:</td>
        <td>
            <select name="id_nasabah" id="">
                <?php foreach($nasabah as $nsbh) : ?>
                <option value="<?= $nsbh['id_nasabah'] ?>"><?= $nsbh['nm_nasabah'] ?></option>
                <?php endforeach ?>
            </select>
        </td>
    </tr>
</table>
<button type="submit">Buat Rekening</button>
</form>

<script>
document.addEventListener("DOMContentLoaded", function(){
    $('#rekening').addClass('active');

    //validasi input pin harus angka
    $('#pin').on('keydown', function(e){
        if(e.key.length === 1 && e.key.match(/[a-z]/i)){
            e.preventDefault();
        }
    });
});
</script>