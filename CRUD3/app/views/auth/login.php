<?php include 'app/views/layout-top.php' ?>

<?php if (isset($msg) && $msg != "") : ?>
    <div class="alert alert-danger" role="alert">
    <?=$msg?>
    </div>
<?php endif; ?>

<!-- CSS PESSOAL -->
<link rel="stylesheet" href="<?=assets("css/login.css")?>" />

<form method='POST' action='<?=route('autenticacao/logar/')?>'>

<section>
        <div class="container-sm">
            <div class="form-value">
                <form action="">
                    <h2>LOGIN</h2>
                    <div class="inputbox">
                        <i id="icon" class="bi bi-file-medical"></i>
                        <input type="text" name = "email"required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <i id="icon" class="bi bi-lock"></i>
                        <input type="password" name ="senha" required>
                        <label for="">Senha</label>
                    </div>
                    <button>Entrar</button>
                </form>
            </div>
        </div>
    </section>
</form>

<?php
#adaptacao para ver o e-mail que foi enviado
if (_v($_GET,'show_last_email') == 1){
    print "<script>
    window.open('./sent/".get_last_email_sent()."','targetWindow','resizable=yes,width=500,height=300');
    </script>";
}

?>

<?php include 'app/views/layout-bottom.php' ?>