<main id="profile">
    <div class="card sticky">
        <?php
        //letras
        $mf = substr($me->firstname,0,1);
        $mf = ucwords($mf);
        $ml = substr($me->lastname,0,1);
        $ml = ucwords($ml);
        ?>
        <div class="userThumb" style="background: <?php if(isset($colorUserThumb[$mf]))echo $colorUserThumb[$mf];?>">
            <?php echo $mf.$ml?>
        </div>
        <?php if(isset($message)):?>
            <div>
                <?=$message?>
            </div>
        <?php endif;?>

        <form action="profile" method="post">
            <textarea name="message" placeholder="Escreva algo..." required></textarea>
            <input type="hidden" name="userTo" value="<?=$user->id?>" required />
            <input type="hidden" name="username" value="<?=$user->username?>" required />
            <button type="submit" class="btn">Publicar para <strong><?=$user->username?></strong></button>
        </form>
        <div id="linkFechar" class="linkFechar">
            <button type="button" class="btn">X</button>
        </div>
        <div class="botaoOculto" id="botaoOculto">
            <button type="button" class="btn">Publicar algo para <strong><?=$user->username?></strong></button>
        </div>
    </div>

    <?php if(sizeof($scraps)>0):?>
    <?php for( $i = sizeof($scraps)-1; $i >= 0; $i=$i-1 ):?>
            <?php
            //letras
            $f = substr($scraps[$i]->firstname,0,1);
            $f = ucwords($f);
            $l = substr($scraps[$i]->lastname,0,1);
            $l = ucwords($l);
            ?>
    <div class="cardPub"<?php if( $me->id == $scraps[$i]->userFrom || $me->id == $scraps[$i]->userTo ):?> data-id="<?=$scraps[$i]->id?>"<?php endif;?>>
        <div class="buddyPub">
            <span class="opt">
                <?php if( $me->id == $scraps[$i]->userFrom || $me->id == $scraps[$i]->userTo ):?>
                <i class="fa fa-angle-down"></i>
                <ul>
                    <?php if( $me->id == $scraps[$i]->userFrom ):?>
                        <li><a href="#" class="edit-scrap" >Editar</a></li>
                    <?php endif;?>
                    <li><a href="<?=base_url('delete/'.$scraps[$i]->id)?>" class="del-scrap">Excluir</a></li>
                </ul>
                <?php endif;?>
            </span>
            <a href="<?=base_url($scraps[$i]->username)?>">
            <div class="buddyThumb" style="background: <?php if(isset($colorUserThumb[$f]))echo $colorUserThumb[$f];?>">
                <?php echo $f.$l?>
            </div>
            </a>
            <ul class="buddyInfo">
                <li class="userName"><a href="<?=base_url($scraps[$i]->username)?>"><?=$scraps[$i]->firstname.' '.$scraps[$i]->lastname?></a></li>
                <li>Postado em <?=$scraps[$i]->createdAt?></li>
                <?php if( $scraps[$i]->updatedAt != '0000-00-00 00:00:00' ):?>
                    <li>Editado</li>
                <?php endif;?>
            </ul>
        </div>
        <div class="publication">
            <p class="pubContent"><?=$scraps[$i]->message?></p>
        </div>
    </div>
    <?php endfor;?>
    <?php else:?>
    <div class="cardPub">
        Seja o primeiro a publicar aqui
    </div>
    <?php endif;?>
</main>
<div class="editScreen pop">
    <div class="top">
        <h1>Editar</h1>
        <hr>
    </div>
    <div class="content">
        <form class="form-bottom" action="editscrap" method="post">
            <textarea typeof="text" name="message" class="messageEdit"></textarea>
            <input type="hidden" name="scrapId" class="scrapId" />
            <input type="hidden" name="username" class="username" value="<?=$user->username?>" />
            <button type="submit" class="btn">Concluir</button>
            <button class="btn btn-danger cancel">Cancelar</button>
        </form>
    </div>
</div>
<div class="overlay pop"></div>