<div class="login-box">
    <div class="login-logo">
        <a href="<?= base_url(); ?>"><b>Application </b> GAC</a>
    </div>
    <?= $this->session->flashdata('message'); ?>

    <div class="login-box-body">
        <h6>
            <p class="login-box-msg">Masuk sebagai Administrator.</p>
        </h6>
        <form action="<?= base_url('auth'); ?>" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="name" class="form-control" placeholder="User" onkeyup="this.value = this.value.toLowerCase();" value="<?= set_value('name') ?>" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" onkeyup="this.value = this.value.toLowerCase();" placeholder="Kata sandi" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <a href="<?= base_url(); ?>auth/tiketbaru" class="btn btn-danger btn-block btn-flat">Buka Tiket Baru</a>
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                </div>
                <div class="col-xs-6">
                    <a href="<?= base_url(); ?>InputLimbah/inputlimbah" class="btn btn-danger btn-block btn-flat" style="margin-top: 10px;">Input Limbah</a>
                </div>
            </div>
        </form>
    </div>
</div>