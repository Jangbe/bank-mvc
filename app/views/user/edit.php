<form action="" method="post">
<table>
    <tr>
        <td>Username</td>
        <td>:</td>
        <td><input type="text" name="username" id="" value="<?= $user['username'] ?>"></td>
    </tr>
    <tr>
        <td>New Password</td>
        <td>:</td>
        <td><input type="password" name="password" id=""></td>
    </tr>
    <tr>
        <td>Level</td>
        <td>:</td>
        <td>
            <select name="level" id="level">
                <?php foreach($level as $k => $v) : ?>
                <option value="<?= $k ?>" <?= $k == $user['level'] ? 'selected' : '' ?>><?= $v ?></option>
                <?php endforeach ?>
            </select>
        </td>
    </tr>
</table>
<br><br>
<table id="tingkat">
    <tr>
        <td>Nama Pegawai/Nasabah</td>
        <td>:</td>
        <td><input type="text" name="nm" value="<?= $pangkat['nm_nasabah'] ?? $pangkat['nm_pegawai'] ?? '' ?>"></td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>
            <select name="jk" id="">
                <option value="L" <?= isset($pangkat['jk']) && $pangkat['jk'] == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
                <option value="P" <?= isset($pangkat['jk']) && $pangkat['jk'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>No Hp</td>
        <td>:</td>
        <td><input type="text" name="no_hp" value="<?= $pangkat['no_hp'] ?? '' ?>"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td><input type="email" name="email" value="<?= $pangkat['email'] ?? '' ?>"></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><textarea name="alamat" id="" cols="30" rows="10"> <?= $pangkat['alamat'] ?? '' ?></textarea></td>
    </tr>
</table>
<button type="submit">Edit</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        let hide = function(elm) {
            elm.style.display = 'none';
        };
        let show = function(elm) {
            elm.style.display = 'block';
        }

        let id = document.getElementById('level');
        let tingkat = document.getElementById('tingkat');
        if(id.value == 'admin'){
            hide(tingkat);
        }
        // console.log(tingkat);   
        id.addEventListener('change', function(e){
            let level = id.value;
            if(level == 'admin'){
                hide(tingkat);
            }else{
                show(tingkat);
            }
        });
    })
</script>