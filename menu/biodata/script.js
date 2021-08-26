$(document).ready(function(){
    $('.ikon1').mouseenter(function(){
        $('.p1').addClass('muncul');
    })

    $('.ikon1').mouseleave(function(){
        $('.p1').removeClass('muncul');
    })

    $('.ikon2').mouseenter(function(){
        $('.p2').addClass('muncul');
    })

    $('.ikon2').mouseleave(function(){
        $('.p2').removeClass('muncul');
    })

    $('.orang').hover(function(){
        $('orang').css({
            'transform' : 'scale(1.3)'
        })
    })

    $(window).on('load',(function(){
        $('.orang').addClass('orang-muncul');
        $('.biodata').addClass('load');
        $('.identitas').addClass('load');
        })
    );
});