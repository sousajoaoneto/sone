<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<aside id="buddyList">
    <div id="titleBuddy">
        <h3>Membros</h3>
    </div>
    <div class="list">
        <?php for( $i = 0; $i < sizeof($users); $i++ ):?>
        <?php if( $users[$i]->username != $me->username ):?>
                <?php
                //letras
                $f = substr($users[$i]->firstname,0,1);
                $f = ucwords($f);
                $l = substr($users[$i]->lastname,0,1);
                $l = ucwords($l);
                ?>
        <a href="<?=str_replace('@', '', $users[$i]->username);?>" class="">
            <div class="alignthumb">
                <div class="buddyThumb" style="background: <?php if(isset($colorUserThumb[$f]))echo $colorUserThumb[$f];?>">
                    <?php echo $f.$l?>
                </div>
                <p class="buddyDetails"><?=$users[$i]->firstname.' '.$users[$i]->lastname?></p>
            </div>
        </a>
        <?php endif;?>
        <?php endfor;?>
        <a href="#" class="">
            <div class="alignthumb">
                <div class="buddyThumb" style="background: <?php if(isset($colorUserThumb['J']))echo $colorUserThumb['J'];?>">JD</div>
                <p class="buddyDetails">Jhon Doe</p>
            </div>
        </a>
    </div>
</aside>