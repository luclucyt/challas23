// import { jsQR } from "https://code4fukui.github.io/jsQR-es/jsQR.js";

// const canvas = document.createElement("canvas");
// const ctx = canvas.getContext("2d");
// const img = new Image();

// img.src = "IMG/qr.png";

// img.onload = () => {
//     console.log("Image loaded successfully");
//     const targetWidth = 400; // Adjust the target width as needed
//     const scaleFactor = targetWidth / img.width;

//     canvas.width = targetWidth;
//     canvas.height = img.height * scaleFactor;
//     ctx.drawImage(img, 0, 0, targetWidth, img.height * scaleFactor);

//     const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);

//     const code = jsQR(imageData.data, imageData.width, imageData.height);

//     if (code) {
//         console.log("QR Code found:", code.data);
//     }
// };

// img.onerror = (error) => {
//     console.error("Error loading image:", error);
// };


import { jsQR } from "https://code4fukui.github.io/jsQR-es/jsQR.js";

const video = document.getElementById("preview");
const canvas = document.createElement("canvas");
const ctx = canvas.getContext("2d");

async function getCameraSelection() {
   const stream = await navigator.mediaDevices.getUserMedia({ video: true });

   video.srcObject = stream;
}

// Request access to the camera
navigator.mediaDevices
    .getUserMedia({ video: true })
    .then((stream) => {
        video.srcObject = stream;

        video.onloadedmetadata = () => {
            video.play();
            captureFrame();
        };
    })
    .catch((error) => {
        console.error("Error accessing camera:", error);
    });

function captureFrame() {
    const targetWidth = 400; // Adjust the target width as needed
    canvas.width = targetWidth;
    canvas.height = video.videoHeight * (targetWidth / video.videoWidth);
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const code = jsQR(imageData.data, imageData.width, imageData.height);

    if (code) {
        console.log("QR Code found:", code.data);
    }

    // Repeat the process
    requestAnimationFrame(captureFrame);
}
