
$(document).ready(function() {
    if(readCookie("adSeen")){
        $('html').show()
        $('#preloader').hide()
    }
    else if (!readCookie("adSeen")) {

    (function( $ ) {   
        $(window).on('load', function(){
            $('#preloader').show()
            $('html').show()
            $('#konten').hide()
            $('.kedua').hide()
            $('.ketiga').hide()
            $('.keempat').hide()
            $('.kelima').hide()
            setTimeout(()=> {
                    // $('.pertama').fadeIn(1000,function(){})
                    $('.pertama').fadeOut(1000,function(){})
                    setTimeout(() => {
                        $('.kedua').show()
                        new Typed('#typed',{
                            strings : ["Katalog ini adalah versi digital dari buku katalog pada umumnya. Kami tim developers membuat ini agar kita khusus nya kelas TKJ 3 tidak lupa dan selalu mengenang teman seperjuangannya masa SMK di SMKN 8 SEMARANG. Segala kekurangan mohon di maklumi karena tim kami hanya sedikit. Jika menemukan bug atau membutuhkan bantuan silahkan hubungi kami tim developers"],
                            typeSpeed : 30,
                            delaySpeed : 30,
                            loop : false
                          });
                          setTimeout(() => {
                            $('.kedua').fadeOut(3000,function(){})
                            setTimeout(() => {
                                $('.ketiga').fadeIn(3000,function(){})
                                $('.ketiga').show()
                                $('.ketiga').fadeOut(3000,function(){})
                                setTimeout(() => {
                                    $('.ketiga').hide()
                                    $('.keempat').fadeIn(3000,function(){})
                                    $('.keempat').show()
                                    $('.keempat').fadeOut(3000,function(){})
                                    setTimeout(() => {
                                        $('.keempat').hide()
                                        $('.kelima').show()
                                        setTimeout(function() {
                                            $('#preloader').fadeOut('5000',function(){
                                            $(this).hide();
                                            $('#konten').fadeIn('3000',function(){})
                                            $('#konten').show();})
                                        }, 10000);
                                    },6500);
                                }, 6500);
                            }, 6500);
                          }, 17000);
                    },3000);
            },2000)
    
        });
    })(jQuery); 
    createCookie("adSeen", "1", 1000);
    }
});

   function createCookie(name, value, days) {
       if (days) {
           var date = new Date();
           date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
           var expires = "; expires=" + date.toGMTString();
       } else var expires = "";
       document.cookie = name + "=" + value + expires + "; path=/";
   }

   function readCookie(name) {
       var nameEQ = name + "=";
       var ca = document.cookie.split(';');
       for (var i = 0; i < ca.length; i++) {
           var c = ca[i];
           while (c.charAt(0) == ' ') c = c.substring(1, c.length);
           if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
       }
       return null;
   }



// // $('#konten').show()
// // $('html').show()
// // $('#preloader').hide()
// // $('.pertama').hide()
// // $('.kedua').hide()
// // $('.ketiga').hide()
// // $('.keempat').hide()
// // $('.kelima').show()
