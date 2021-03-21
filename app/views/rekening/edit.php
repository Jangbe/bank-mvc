<form action="" method="post">
<table>
    <tr>
        <td>No Rekening</td>
        <td>:</td>
        <td><input type="text" name="norek" value="<?= $rekening['no_rekening'] ?>" readonly></td>
    </tr>
    <tr>
        <td>PIN Lama</td>
        <td>:</td>
        <td><input type="password" name="pin_old" class="pin"></td>
    </tr>
    <tr>
        <td>PIN Baru</td>
        <td>:</td>
        <td><input type="password" name="pin_new" class="pin"></td>
    </tr>
    <tr>
        <td>Nasabah</td>
        <td>:</td>
        <td>
            <select name="id_nasabah" id="" readonly>
                <option value="<?= $rekening['id_nasabah'] ?>"><?= $rekening['nm_nasabah'] ?></option>
            </select>
        </td>
    </tr>
</table>
<button type="submit">Edit Rekening</button>
</form>

<script>
document.addEventListener("DOMContentLoaded", function(){
    let pin = document.querySelectorAll('.pin');

    //validasi input harus angka
    pin.forEach(function(v){
        v.addEventListener('keydown', function(event){
            if(isNaN(event.key) && event.key !== 'Backspace'){
                event.preventDefault();
                return false;
            }
        });
    });
});
</script>