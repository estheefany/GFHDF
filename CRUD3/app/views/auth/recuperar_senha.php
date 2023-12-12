<?php include 'app/views/layout-top.php' ?>

<form method='POST' action='<?=route('autenticacao/recuperar_senha_send_email/')?>'>

    <label class='col-md-4'>
        Digite o seu E-mail
        <input type="text" class="form-control" name="email" value="<?=old("email")?>" >
    </label>

    <button class='btn btn-primary col-12 col-md-3 mt-3'>Recuperar senha</button>

</form>

<?php include 'app/views/layout-bottom.php' ?>
