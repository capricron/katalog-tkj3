const galeri = new Vue({
    el: '#menu',
    data: {
        nama: [
        '','Yusup','Aldika','Alpin','Fajar',
        'Asthon','Cikal','Dafa','Dewa',
        'Elisa','Elsa','Fatur','Ferza',
        'Umar','Ghani','Udin','Gilang',
        'Helsa','Novita','Imam','Arya',
        'Melinda','Budi','Iqbal','Rakha',
        'Ramzy','Natasya','Husni','Ayak',
        'Rangga','Andra','Ando','Roshan',
        'Asep','Shindu','Suci','Eris']
    },
    methods: {
        gambar(x){
            let hasil = `img/${x}.png`
            return hasil
        },
        url(x){
            let hasil = `biodata/?absen=${x}`
            return hasil
        },
        name(x){
            let hasil = this.nama[x]
            return hasil
        },
        mobile: function(){
            if(window.innerWidth > 1000){
                return true
            }else{
                return false
            }
        },

        desktop(){
            if(window.innerWidth > 1000){
                return true
            }else{
                return false
            }
        }
    }
})

const link = document.querySelectorAll('.link') 


link.forEach(function(element){
    element.addEventListener('mouseenter', function(e){
        if(e.target.class = "foto"){
            e.target.classList.add('bg-pudar')
            e.target.children[1].classList.add('muncul')
        }
    })

    element.addEventListener('mouseleave', function(e){
        if(e.target.class = "foto"){
            e.target.classList.remove('bg-pudar')
            e.target.children[1].classList.remove('muncul')
        }
    })
})


function change(){
    if(window.innerWidth < 1000){
        const mobile = document.querySelector('.mobile');  
        mobile.classList.add('col-md-3');
        mobile.innerHTML = '<h1 class="choose"> Choose Your Character </h1>'
    }    
    else if(window.innerWidth > 1000){
        const desktop = document.querySelector('.desktop');  
        desktop.classList.add('col-md-3');
        desktop.innerHTML = '<h1 class="choose"> Choose Your Character </h1>'
    }
}

change()