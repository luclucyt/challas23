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
    }
});