/**
 * Created by Joao Sousa on 16/10/2015.
 */
/*
    var server = {
        get: function (cep) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open('GET','http://viacep.com.br/ws/'+cep+'/json');
            xmlhttp.send();
            return xmlhttp.responseText;
        }
    };
*/
$(window).scroll(function(){
    var sticky = $('.sticky'),
        scroll = $(window).scrollTop();

    if (scroll >= 50){
        sticky.addClass('fixed');
        $('#botaoOculto').removeClass('botaoOculto');
        $('#linkFechar').addClass('linkFechar');
    } else {
        sticky.removeClass('fixed');
        $('#botaoOculto').addClass('botaoOculto');
        $('#linkFechar').addClass('linkFechar');
    }
});
$(document).ready( function(){
	$('.card #botaoOculto').on('click', function() {
		$('.sticky').removeClass('fixed');
		$('#botaoOculto').addClass('botaoOculto');
		$('#linkFechar').removeClass('linkFechar');
		$('.card form textarea').focus();
		console.log('Entrou no campo');
	});

	$('.card #linkFechar').on('click', function() {
		$('.sticky').addClass('fixed');
		$('#botaoOculto').removeClass('botaoOculto');
		$('#linkFechar').addClass('linkFechar');
		console.log('Saiu do campo');
	});
    $('.overlay').on('click',function(){
        $('.editScreen').css('display','none');
        $(this).css('display','none');
        return false;
    });
    $('.cancel').on('click',function(){
        $('.pop').css('display','none');
        $('.pop').css('display','none');
        return false;
    });
    $('.del-scrap').on('click',function(){
        if(confirm('Excluir mesmo de verdade o scrap?')) return true;
        return false;
    });
    $('.edit-scrap').on('click',function(){
        $('.editScreen').css('display','block');
        $('.overlay').css('display','block');

        var msg = $(this).closest('.cardPub').find('.pubContent').html();
        $('.messageEdit').val(msg);
        var id = $(this).closest('.cardPub').data('id');
        $('.scrapId').val(id);
        return false;
    });
});
$(window).resize(function(){
    $h = $(this).height();
    console.clear();
    console.log($h);

    //$('.editScreen').height($h*0.8);
});
