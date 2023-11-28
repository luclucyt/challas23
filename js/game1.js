let ctx, canvasWidth, canvasHeight;
let volgende;
let image;
let sprite1;
const fps = 60;
const interval = 1000 / fps;
canvasHeight = 914;
canvasWidth = 412;

function start() {
    (function gameloop(timestamp){
        
        if (volgende === undefined) {
            volgende = timestamp;
        }
        const verschil = timestamp - volgende;
        if (verschil > interval) {
            volgende = timestamp - (verschil % interval);
            update();
            draw();
        }
        requestAnimationFrame(gameloop);
    })();
}

function init() {
    const canvas = document.getElementById('myCanvas');
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;
    ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvasWidth, canvasHeight);
    image = new Image();
    image.src = '../IMG/spaceship.png';
    sprite1 = new Sprite(300, 650, 5, 0, 50, 75, '../IMG/spaceship.png');
    start();
}

function update() {
    sprite1.update();
    if(sprite1.X > canvasWidth){
        sprite1.X = -50;
    
    }

}

function draw() {
    ctx.clearRect(0, 0, canvasWidth, canvasHeight);
    sprite1.draw(ctx);
}