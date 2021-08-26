const galeri = new Vue({
    
    el: "#galeri",
    data:{
        index: 1
    },
    methods:{
        thumb(x){
            let hasil =  `img/thumb/${x}.png`
            return hasil
        },
        ref(x){
            let hasil = `#gambar${x}`
            return hasil
        },
        gambar(x){
            let hasil = `gambar${x}`
            return hasil
        },
        galeri(x){
            let hasil =  `img/galeri/${x}.jpg`
            return hasil
        }
    }
})