<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="public/css/style.css" rel="stylesheet"/>
</head>
<body>
<main id="signup">

    <div class="logScreen">
        <div class="top">
            <h1>Faça seu cadastro!</h1>
            <hr>
        </div>
        <div class="content">
            <form class="form-bottom" action="<?php echo base_url('/signup');?>" method="post">
                <?php if(isset($error)):?>
                    <div class="error">
                        <?=$error->message?>
                    </div>
                <?php endif;?>
                <input class="form-control " name="firstname" type="text" placeholder="Nome" required pattern="^[a-zA-Z]{0,20}$" title="Máximo 20 Caracteres | Somente Letras" value="<?php if(isset($USER_DATA->firstname)) echo $USER_DATA->firstname;?>" />
                <input class="form-control" name="lastname" type="text" placeholder="Sobrenome" required pattern="^[a-zA-Z]{0,20}$"  value="<?php if(isset($USER_DATA->lastname)) echo $USER_DATA->lastname;?>" />
                <input class="form-control <?php if(isset($USER_DATA->username)) echo 'erro'?>" name="email" type="email" placeholder="E-mail" required value="<?php if(isset($USER_DATA->email)) echo $USER_DATA->email;?>" />
                <input class="form-control <?php if(isset($USER_DATA->email)) echo 'erro'?>" name="username" type="text" placeholder="Nome de Usuário" required pattern="^\w{0,20}$" value="<?php if(isset($USER_DATA->username)) echo $USER_DATA->username;?>" />
                <input class="form-control" name="password" type="password" placeholder="Senha" required />
                <button type="submit" class="btn">Registrar-se</button>
            </form>
            Já tem uma conta?
            <a href="signin"><button class="btn btn-danger">Entrar</button></a>
        </div>
    </div>
</main>
</body>
</html>