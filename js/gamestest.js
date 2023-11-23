function test(num, event) {
    // Get the clicked element
    var clickedElement = event.target;

    // Get the color of the pixel where the user clicked
    var pixelColor = getPixelColor(clickedElement, event);

    // Check if the pixel color is red (you might need to adjust the color comparison)
    if (pixelColor === "red") {
        console.log(num);
    }
}

function getPixelColor(element, event) {
    var x = event.clientX - element.getBoundingClientRect().left;
    var y = event.clientY - element.getBoundingClientRect().top;

    // Create a transparent overlay
    var overlay = document.createElement("div");
    overlay.style.position = "absolute";
    overlay.style.width = "100%";
    overlay.style.height = "100%";
    overlay.style.pointerEvents = "none"; // Allow events to go through the overlay
    overlay.style.top = "0";
    overlay.style.left = "0";
    
    // Append the overlay to the body
    document.body.appendChild(overlay);

    // Get the color of the pixel under the cursor
    var pixelColor = getComputedStyle(document.elementFromPoint(event.clientX, event.clientY)).backgroundColor;
    
    console.log(pixelColor); // For testing purposes, log the color to the console

    // Remove the overlay
    document.body.removeChild(overlay);

    // Now you can use the color for further comparison
}