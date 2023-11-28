

//--------------------VARIABLES--------------------\\
let kong = document.getElementById("kong");
let banana = document.getElementById("banana");
let scoreText = document.getElementsByTagName("h1")[0];
let positionX = 412;
let positionY = 914;
let score = 0;
let speed = -10;
let positionBanna = -10;
let heathPoints = 10;

let direction = "";
let mode = "manual";

let pauze = true;

//--------------------ONLOAD--------------------\\
function init(){
    document.addEventListener('keydown', controls);
    kong.style.left = positionX + "px";
    scoreText.innerText = "0";
    gameEngine(); //direct starten
    setInterval(gameEngine, 25); // herhaal 120 ms
    generateBanana();
}

//--------------------LOOP--------------------\\
function gameEngine(){
    if(pauze == false){
        //  bounding box
        let kongbox = getBoundingBox(kong);
        let bananbox = getBoundingBox(banana);
        
        // maak hier onder de fuctie om de hoogte te pakkes shit ja cool
        if(kongbox.left < bananbox.right && kongbox.right > bananbox.left && kongbox.top < bananbox.bottom && kongbox.bottom > bananbox.bottom){
            console.log("hebbes");
            generateBanana();
            addScore()
            positionBanna = -10;
        }

        if(direction == "left"){
            moveLeft();
        }
        if(direction == "right"){
            moveRight();
        }
        if(direction == "down"){
            moveDown();
        }
        if(direction == "up"){
            moveUp();
        }


        //make the speed of the banana increase over time acroding to the score
        if(score > 0 && score % 10 == 0){
            speed -= 1;
        }
        //give the speed a cap
        if(speed < -15){
            speed = -15;
        }


        //move banana down until it hits the ground 
        if(positionBanna < 914){
            banana.style.top = positionBanna + "px";
            positionBanna -= speed;
        }
        else{
            positionBanna = -10;
            generateBanana();
            heathPoints--;
            banana.style.top = positionBanna + "px";
            updateHeathPoints();
        }

        //if heathpoints are 0, reset heathpoints and score
        if(heathPoints == 0){
            for(let i = 1; i < 11; i++){

            }     
            alert("Game over");
            heathPoints = 10;
            score = 0;
            scoreText.innerText = score;
        }     
    }

    //if mode is auto, move kong automatically 
  
    //check if kong is out of bounds, if so teleport him to the other side
    if(positionX < -412){
        positionX = 412;
        kong.style.left = positionX + "px";
    }
    if(positionX > 412){
        positionX = -412;
        kong.style.left = positionX + "px";
    }
    if(positionY > -914){
        positionY = 914;
        kong.style.up = positionY + "px";
    }
    if(positionY > 914){
        positionY = -914;
        kong.style.up = positionY + "px";
    }



}

//--------------------INPUT HANDLING--------------------\\
function controls(event) {
    let key = event.key;
    if(mode == "manual"){
        
        //todo op basis van keycode , links of rechts aanroepen
        if(key == "a" || key == "ArrowLeft" || key == "A" || direction == "left"){  
            moveLeft();
        }

        if(key == "d" || key == "ArrowRight" || key == "D" || direction == "right"){
            moveRight();
        }

        if(key == "s" || key == "ArrowDown" || direction == "down"){
            moveDown();
        }
        if(key == "w" || key == "ArrowUp" || direction == "up"){
            moveUp();
        }
    }

    if(key == " " || key ==""){
        if(mode == "auto"){
            mode = "manual";
            console.log("manual");
            stop();

            score = 0;
            scoreText.innerText = score;
            heathPoints = 10;

            for(let i = 1; i < 11; i++){
                let heathPointDiv = document.getElementById("bar" + i);
                heathPointDiv.style.backgroundColor = "#00ff08ee";
            }

        } 
        
    }

    if(key == "p"){
        if(pauze == false){
            pauze = true;
            
        }else{
            pauze = false;
        }
    }
    else{
        if(pauze == true){
            pauze = false;
        }
    }
}

//--------------------MOVEMENT--------------------\\
function moveLeft(){
    if(pauze == false){
        positionX -= 15;
        kong.style.left = positionX + "px";
        kong.style.transform = "scaleX(-1)";
        direction = "left";
    }
}

function moveRight(){
    if(pauze == false){
        positionX += 15;
        kong.style.left = positionX + "px";
        kong.style.transform = "scaleX(+1)";
        direction = "right";
    }
}
function moveUp(){
    if(pauze == false){
        positionY += 15;
        kong.style.left = positionY + "px";
        kong.style.transform = "scaleX(+1)";
        direction = "up";
    }
}
function moveDown(){
    if(pauze == false){
        positionY += 15;
        kong.style.left = positionY + "px";
        kong.style.transform = "scaleX(+1)";
        direction = "down";
    }
}





function generateBanana(){
    banana.style.opacity = 1;
    
    // banaan mag niet buiten de stage staan 1000px
    // maak er tientallen van met *10 
    let bananaSpawn = Math.floor(Math.random() * 40)*10 + "px";
    banana.style.left = bananaSpawn;
};

function addScore(){
    score++;
    scoreText.innerText = score;
}

// DO NOT TOUCH THIS FUNCTION EVER EVER EVER!
function getBoundingBox(element){
    let rect = element.getBoundingClientRect();
    let left = rect.left - 1;
    let right = rect.left + rect.width - 1;
    let top = rect.top;
    let bottom = rect.top + rect.height - 1;
    
    return {"left":left, "right":right, "top":top, "bottom":bottom};
}



//switch between modes (auto/manual) 
function MoveControls(){
    let kongbox = getBoundingBox(kong);
    let bananbox = getBoundingBox(banana);

    if(mode == "manual"){
        // manual mode
        if(direction == "left"){
            moveLeft();
        }
        if(direction == "right"){
            moveRight();
        }
        if(direction == "down"){
            moveDown();
        }
        if(direction == "up"){
            moveUp();
        }
    }
}

function updateHeathPoints(){
    let heathPointDiv = document.getElementById("bar" + (heathPoints + 1));
    heathPointDiv.style.backgroundColor = "red";
}
init();