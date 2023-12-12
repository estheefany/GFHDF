<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!--REFERENCIA DO BOOTSTRAP AO JAVASCRIPT-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <!-- CSS PESSOAL -->
    <link rel="stylesheet" href="<?=assets("css/home.css")?>" />

    <!-- BOOSTRAP ICONES-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="shortcut icon" href="public/imgs/faviconn.ico" type="image/x-icon">


    <title>MED.ONLINE - Agendamentos de Consultas Médicas</title>

</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- CONTAINER -->
        <div class="container-sm">
            <nav><a href="index.html">
                    <img id="logoInicio" src="public/imgs/logoo.png" alt="logo" width="40" height="32"
                        viewBox="0 0 118 94">
                    <ul class="ul">
                        <div class="login">
                             <button><a id="btn1" href="<?=route('autenticacao/index')?>">LOGIN</a></button>
                        </div>
                    </ul>
            </nav>

            <section class="banner">
                <div class="banner-text">
                    <h1>MED.ONLINE</h1>
                    <p>Software de Agendamentos de Consultas Médicas</p>
                </div>
            </section>
        </div>
        
        <!-- END CONTAINER-->
    </header>
    <br><br><br><br><br><br>
    <!-- END HEADER-->
    <!-- MED 1.0-->
    <section class="agenda">
        <!-- CONTAINER -->
        <div class="container">
            <div class="agenda-text">
                <h3>Agendamentos de Consultas Médicas de forma online</h3>
                <p>Sem precisar sair de casa! Agende pelo celular ou pelo computador</p>
            </div>
            <div class="agenda-img">
            <img src="public/imgs/agendaa.png" alt="agenda-img">
            </div>
        </div>
        <!-- END CONTAINER -->
    </section>
    <!-- END MED 1.0-->
    <!-- MED 2.0-->
    <section class="agenda">
        <!-- CONTAINER -->
        <div class="container">
            <div class="agenda-img">
                <img src="public/imgs/papeel.png" alt="agenda-img">
            </div>
            <div class="agenda-text">
                <h3>Praticidade no atendimento</h3>
                <p>Sem a necessidade de meios manuais ou uso do papel.
                    Aproveite a tecnologia, acelere o processo e ganhe mais qualidade e praticidade em seus atendimentos
                    médicos</p>
            </div>
        </div>
        <!-- END CONTAINER -->
    </section>
    <!-- END MED 2.0-->
    <!-- COMO EU AGENDO???-->
    <section class="passo-a-passo">
        <div class="container">
            <h3>Como agendar uma consulta?</h3>
            <p id="seguirpassos">Siga o passo a passo abaixo:</p>
            <div class="cards">
                <div class="card-item">
                    <i class="bi bi-box-arrow-in-right" style="color: #82dcff;"></i>
                    <p>Vá em uma Unidade básica de Saúde e realize seu cadastro na plataforma</p>
                </div>

                <div class="card-item">
                    <i class="bi bi-calendar3" style="color: #82dcff;"></i>
                    <p>Após isso, voce terá acesso ao sistema podendo assim escolher dentre os horários
                     e especialidades disponíveis na sua UBS 
                    </p>
                </div>

                <div class="card-item">
                    <i class="bi bi-check2" style="color: #82dcff;"></i>
                    <p>Após a escolha, sua consulta estará agendada.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- END | COMO EU AGENDO???-->
    <section class="informações">
        <div class="container">
            <hr>
            <!--<div class="name-Page">
                <img id="logo" src="public/imgs/medEndPage.png" alt="">
                <p></p>
            </div>-->
            <div class="login">
                <button><a id="btn2" href="<?=route('autenticacao/index')?>">Login do Profissional da Saúde</a></button>
            </div>
        </div>
    </section>
    <script src="js/script.js"></script>
</body>

</html>