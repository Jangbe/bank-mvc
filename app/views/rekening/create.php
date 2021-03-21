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
    let pin = document.getElementById('pin');

    //validasi input harus angka
    pin.addEventListener('keydown', function(event){
        if(isNaN(event.key) && event.key !== 'Backspace'){
            event.preventDefault();
            return false;
        }
    });
});
</script>