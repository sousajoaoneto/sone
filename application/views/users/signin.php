<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignIn</title>
    <link href="public/css/style.css" rel="stylesheet"/>
</head>
<body>
<main id="signin">
    <div class="logScreen">
        <div class="top">
            <h1>Faça o Login para continuar</h1>
            <hr>
        </div>
        <div class="content">
            <form class="form-bottom" action="<?php echo base_url('/signin');?>" method="post">
                <?php if(isset($error)):?>
                    <div class="error">
                        <?=$error->message?>
                    </div>
                <?php endif;?>
                <input class="form-control" name="username" type="text" placeholder="Usuário" required pattern="^\w{0,20}$" />
                <input class="form-control" name="password" type="password" placeholder="Senha" required />
                <button type="submit" class="btn">Entrar</button>
            </form>
            <a href="signup"><button class="btn btn-danger">Registrar-se</button></a>
        </div>
    </div>
</main>
</body>
</html>