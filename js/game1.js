document.addEventListener('DOMContentLoaded', function () {
    const bird = document.getElementById('flappy-bird');
    const scoreDisplay = document.getElementById('score');
    const recordDisplay = document.getElementById('record');
    const retryBtn = document.getElementById('retry-btn');
    const gameContainer = document.getElementById('game-container');

    let isGameOver = false;
    let score = 0;

    retryBtn.addEventListener('click', resetGame);

    function resetGame() {
        isGameOver = false;
        score = 0;
        bird.style.bottom = '50%';
        updateScore();
        hideGameOver();
        resetPipes();
        startGame();
    }

    function startGame() {
        document.addEventListener('click', jump);
        createPipes();
        gameLoop();
    }

    function jump() {
        if (!isGameOver) {
            bird.style.animation = 'jump 0.5s';
            setTimeout(() => {
                bird.style.animation = 'none';
            }, 500);
            bird.style.bottom = parseFloat(bird.style.bottom) + 50 + 'px'; // Simulate jump
        }
    }

    function createPipes() {
        for (let i = 0; i < 3; i++) {
            const pipeGap = 200;
            const pipeHeight = Math.random() * 300 + 50; // Random height between 50 and 350
            createPipe(pipeGap * i + 600, pipeHeight);
        }
    }

    function createPipe(left, height) {
        const pipe = document.createElement('div');
        pipe.classList.add('pipe');
        pipe.style.left = left + 'px';
        pipe.style.height = height + 'px';
        gameContainer.appendChild(pipe);
    }

    function movePipes() {
        const pipes = document.querySelectorAll('.pipe');
        pipes.forEach(pipe => {
            const left = parseFloat(pipe.style.left);
            pipe.style.left = left - 2 + 'px'; // Adjust the speed of pipes
            if (left <= -50) {
                pipe.remove();
                createPipe(850, Math.random() * 300 + 50);
            }

            // Check for collisions
            if (
                left < 50 &&
                left > 0 &&
                (parseFloat(bird.style.bottom) < pipe.style.height || parseFloat(bird.style.bottom) > pipe.style.height + 150)
            ) {
                gameOver();
            }

            // Update score
            if (left === 50) {
                score++;
                updateScore();
            }
        });
    }

    function resetPipes() {
        const pipes = document.querySelectorAll('.pipe');
        pipes.forEach(pipe => pipe.remove());
        createPipes();
    }

    function gameLoop() {
        const gravity = 1;
        let birdBottom = parseFloat(window.getComputedStyle(bird).getPropertyValue('bottom'));

        if (!isGameOver) {
            bird.style.bottom = birdBottom - gravity + 'px';
            movePipes();
        }

        if (birdBottom <= 0 || birdBottom >= gameContainer.clientHeight - 50) {
            gameOver();
        }

        requestAnimationFrame(gameLoop);
    }

    function gameOver() {
        isGameOver = true;
        showGameOver();
        updateRecord();
    }

    function showGameOver() {
        scoreDisplay.innerText = `Score: ${score}`;
        scoreDisplay.style.display = 'block';
        recordDisplay.style.display = 'block';
        retryBtn.style.display = 'block';
    }

    function hideGameOver() {
        scoreDisplay.style.display = 'none';
        recordDisplay.style.display = 'none';
        retryBtn.style.display = 'none';
    }

    function updateScore() {
        scoreDisplay.innerText = `Score: ${score}`;
    }

    function updateRecord() {
        const record = parseInt(localStorage.getItem('flappyBirdRecord')) || 0;

        if (score > record) {
            localStorage.setItem('flappyBirdRecord', score);
            recordDisplay.innerText = `New Record: ${score}`;
        } else {
            recordDisplay.innerText = `Record: ${record}`;
        }
    }

    resetGame(); // Start the game
});
