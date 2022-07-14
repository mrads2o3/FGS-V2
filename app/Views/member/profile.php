<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card col-sm-8 col-lg-8 col-12 mx-auto mt-4">
    <div class="card-header bg-sec-fastgaming text-white text-center">
        <h4 class="mt-2">Ubah Password</h4>
    </div>
    <div class="card-body p-4">
        <div class="inp mb-2">
            <span>Password lama</span>
            <input type="password" class="form-control w-100" name="old_password" id="old_password" required>
        </div>

        <div class="inp mb-2">
            <span>Password baru</span>
            <input type="password" class="form-control w-100" name="new_password" id="new_password" required>
        </div>
        <div class="inp mb-2">
            <span>Ulangi password baru</span>
            <input type="password" class="form-control w-100" name="rep_new_password" id="rep_new_password" required>
        </div>
        <button class="btn bg-sec-fastgaming text-white w-100" id="saveButton">Simpan perubahan</button>
    </div>
</div>
<script>
$('#saveButton').click(function() {
    $.ajax({
        type: "POST",
        url: "<?= base_url('member/changepassword'); ?>",
        dataType: "JSON",
        data: {
            old_password: $("#old_password").val(),
            new_password: $("#new_password").val(),
            rep_new_password: $("#rep_new_password").val(),
        },
        success: function(data) {
            confirm(data.message);
            location.reload();
        }
    });
});
</script>
<?= $this->endSection(); ?>