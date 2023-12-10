let input = document.querySelector("#word-input");
let button = document.querySelector("#word-submit");

button.addEventListener("click", function () {

    let woord = input.value;
    let formData = new FormData;
    formData.append('woord', woord);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'inc/word.php');
    xhr.onload = function () {
        let response = this.response;
        try {
            response = JSON.parse(response);
        } catch (e) {
            console.log(e)
            response = [0, 'Er is iets fout gegaan!']
        }

        if(response[0] === 1) {
            let bon = document.createElement('div');
            bon.classList.add('bon');
            bon.innerHTML = response[1];
            document.querySelector('.word-info').appendChild(bon);
        }else{
            alert(response[1]);
        }
    }

    xhr.send(formData);
});