const dino  = document.getElementById('dino');
const cactus = document.getElementById('cactus');


function jump(){
    if(dino.classList != 'jump'){
        dino.classList.add("jump");
        
        setTimeout(function(){
            dino.classList.remove('jump');
        },300)
    }
}

let isAlive = setInterval(() => {
    //nilai y dino
    let dinoTop = parseInt(window.getComputedStyle(dino).getPropertyValue('top'));
    
    //nilai x cactus
    let cactusLeft = parseInt(window.getComputedStyle(cactus).getPropertyValue("left"));

    if(cactusLeft < 50 && cactusLeft > 0 && dinoTop >= 140){
       console.log('nabrak')
    }
}, 10);

document.addEventListener('keydown',function(event){
    jump();
});