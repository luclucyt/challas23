import { jsQR } from "https://code4fukui.github.io/jsQR-es/jsQR.js";

const video = document.getElementById("preview");
const canvas = document.createElement("canvas");
const ctx = canvas.getContext("2d");

video.style.backgroundColor = "black";
canvas.style.backgroundColor = "black";

async function getCameraSelection() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: "environment" } // Use the back camera
        });

        video.srcObject = stream;

        video.onloadedmetadata = () => {
            video.play();
            captureFrame();
        };

        console.log("Successfully accessed back camera.");
    } catch (err) {
        console.error("Error accessing camera:", err);
    }
}

// Call the function to get the back camera
getCameraSelection();

function captureFrame() {
    const targetWidth = 400; // Adjust the target width as needed
    canvas.width = targetWidth;
    canvas.height = video.videoHeight * (targetWidth / video.videoWidth);
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const code = jsQR(imageData.data, imageData.width, imageData.height);

    if(code){

        let formData = new FormData;
        formData.append('code', code.data)

        let xhr = XMLHttpRequest();
        xhr.open('POST', 'inc/qrScan', true);

        xhr.onload = function(){
            let response = this.response

            if(response[0] == 0){
                Swal.fire({
                    title: 'Error!',
                    text: response[1],
                    icon: 'error',
                    confirmButtonText: 'probeer opnieuw'
                })
            }else{
                Swal.fire({
                    title: 'Succes!',
                    text: response[1],
                    icon: 'success',
                    confirmButtonText: 'Ga naar de home pagina!'
                })
            }
        }

        xhr.send(formData)
    }

    if (code) {
        alert("QR Code found:", code.data);
    }

    // Repeat the process
    requestAnimationFrame(captureFrame);
}
