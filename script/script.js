if(window.innerWidth > 1000){

    // $('#biodata').mouseenter(function(){
    //     $('.ket1').fadeIn('1000', function(){})
    //     $('#biodata').css({ "transform": 'scale(1.2)', "transition": "all .8s", 'border-color': 'red', 'border-style' : 'solid'})
    // })
    // $('#galeri').mouseenter(function(){
    //     $('.ket2').fadeIn('1000', function(){})
    //     $('#galeri').css({ "transform": 'scale(1.2)', "transition": "all .8s", 'border' : '2px solid white' });
    // })
    // $('#cooming').mouseenter(function(){
    //     $('.ket3').fadeIn('1000', function(){})
    //     $('#cooming').css({ "transform": 'scale(1.2)', "transition": "all .8s", 'border' : '2px solid white' });
    // })

    // $('#biodata').mouseleave(function(){
    //     $('.ket1').fadeOut('1000', function(){})
    //     $('#biodata').css({ "transform": 'scale(1)', "transition": "all .8s", 'border' : 'none'});
    // })
    // $('#galeri').mouseleave(function(){
    //     $('.ket2').fadeOut('1000', function(){})
    //     $('#galeri').css({ "transform": 'scale(1)', "transition": "all .8s", 'border' : 'none'});
    // })
    // $('#cooming').mouseleave(function(){
    //     $('.ket3').fadeOut('1000', function(){})
    //     $('#cooming').css({ "transform": 'scale(1)', "transition": "all .8s", 'border' : 'none'});
    // }) 
    
    $('#biodata').mouseenter(function(){
        $('.ket1').css({  'right' : '45%' })
    })
    $('#galeri').mouseenter(function(){
        $('.ket2').css({  'left' : '45%' })
    
    })
    $('#cooming').mouseenter(function(){
        $('.ket3').fadeIn('1000', function(){})
        $('#cooming').css({ "transform": 'scale(1.2)', "transition": "all .8s", 'border' : '2px solid white' });
    })

    $('#biodata').mouseleave(function(){
        $('.ket1').css({  'right' : '0' })
    })
    $('#galeri').mouseleave(function(){
        $('.ket2').css({  'left' : '0' })
    })
    $('#cooming').mouseleave(function(){
        $('.ket3').fadeOut('1000', function(){})
        $('#cooming').css({ "transform": 'scale(1)', "transition": "all .8s", 'border' : 'none'});
    })

}

const side = document.querySelectorAll('.sidenav');
M.Sidenav.init(side);




$('.scroll').on('click', function(e) {

    var tujuan = $(this).attr('href');
   
    var elemenTujuan = $(tujuan);
   
    $('html , body').animate({
     scrollTop: elemenTujuan.offset().top
    },2000,'easeInOutExpo');
   
    e.preventDefault();
});

$('.home').on('click',function(){
    $('html , body').animate({
        scrollTop: $('#home').offset().top
       },2000,'easeInOutExpo');
})


