console.log("hi");

/* Image Upload in register */
let file = document.getElementById("pfp");
let img = document.getElementById("uploaded-img");
let popup = document.getElementById("img-handling");

// Initialize variables for dragging
let isDragging = false;
let initialX;
let initialY;
let at_start_x;
let at_start_y;

file.onchange = () => {
    const selectedFile = file.files[0];
    let loaded_file = file.files[0];
    popup.style.display = "block";

    // Set the image source and initial position
    img.src = URL.createObjectURL(loaded_file);
};

popup.addEventListener("mousedown", function (e) {
    if (e.target === img) {
        isDragging = true;
        initialX = e.clientX;
        initialY = e.clientY;
        at_start_x = parseFloat(getComputedStyle(img).left);
        at_start_y = parseFloat(getComputedStyle(img).top);
    }
});

window.addEventListener("mousemove", function (eb) {
    if (isDragging) {
        let endX = at_start_x + (eb.clientX - initialX);
        let endY = at_start_y + (eb.clientY - initialY);

        // Set the new position of the img element
        img.style.left = endX + "px";
        img.style.top = endY + "px";
    }
});

popup.addEventListener("mouseup", function (c) {
    isDragging = false;
    console.log("mouse up");
});

let square = document.getElementById("square");
let scale = 1.0;

function handleMouseWheel(event) {
    // Calculate the new scale based on the mouse wheel delta
    const delta = event.deltaY || event.detail || event.wheelDelta;
    scale += delta > 0 ? -0.1 : 0.1; // Adjust the zoom speed as needed

    // Limit the minimum and maximum scale factors if needed
    scale = Math.max(0.1, Math.min(2.0, scale));

    // Calculate the new dimensions of the image
    const newImageWidth = img.naturalWidth * scale;
    const newImageHeight = img.naturalHeight * scale;

    // Set the image's dimensions and scale transform
    img.style.width = `${newImageWidth}px`;
    img.style.height = `${newImageHeight}px`;
}

// Add the wheel event listener to the square
popup.addEventListener("wheel", handleMouseWheel);

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    // Add a submit event listener to the form
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Ensure that the image is properly positioned and scaled within the popup
        captureAndSetEditedImage();

        // Submit the form
        form.submit();
    });
});

// Function to capture and set the edited image
function captureAndSetEditedImage() {
    const square = document.getElementById("square");

    // Create a new canvas element with the same dimensions as the square
    const canvas = document.createElement("canvas");
    canvas.width = square.clientWidth;
    canvas.height = square.clientHeight;
    const ctx = canvas.getContext("2d");

    // Calculate the offset of the square relative to the scaled image
    const squareRect = square.getBoundingClientRect();
    const imageRect = img.getBoundingClientRect();
    const offsetX = (squareRect.left - imageRect.left) / scale; // Adjust for scale
    const offsetY = (squareRect.top - imageRect.top) / scale; // Adjust for scale

    // Calculate the dimensions of the square on the scaled image
    const scaledSquareWidth = square.clientWidth / scale; // Adjust for scale
    const scaledSquareHeight = square.clientHeight / scale; // Adjust for scale

    // Draw the content within the square onto the canvas
    ctx.drawImage(img, offsetX, offsetY, scaledSquareWidth, scaledSquareHeight, 0, 0, canvas.width, canvas.height);

    // Convert the canvas data to a data URL (Base64)
    const editedImageData = canvas.toDataURL("image/jpeg"); // Change format as needed

    // Set the value of the hidden input field with the edited image data
    document.getElementById("edited_image").value = editedImageData;
}
// ... (your existing code)

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");

    // Add a submit event listener to the form
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Ensure that the image is properly positioned and scaled within the popup
        captureAndSetEditedImage();

        // Submit the form
        form.submit();
    });

    // Function to capture and set the edited image
    function captureAndSetEditedImage() {
        const square = document.getElementById("square");

        // Clear the canvas
        canvas.width = square.clientWidth;
        canvas.height = square.clientHeight;

        // Calculate the offset of the square relative to the scaled image
        const squareRect = square.getBoundingClientRect();
        const imageRect = img.getBoundingClientRect();
        const offsetX = (squareRect.left - imageRect.left) / scale; // Adjust for scale
        const offsetY = (squareRect.top - imageRect.top) / scale; // Adjust for scale

        // Calculate the dimensions of the square on the scaled image
        const scaledSquareWidth = square.clientWidth / scale; // Adjust for scale
        const scaledSquareHeight = square.clientHeight / scale; // Adjust for scale

        // Draw the content within the square onto the canvas
        ctx.drawImage(
            img,
            offsetX,
            offsetY,
            scaledSquareWidth,
            scaledSquareHeight,
            0,
            0,
            canvas.width,
            canvas.height
        );

        // Convert the canvas data to a data URL (Base64)
        const editedImageData = canvas.toDataURL("image/jpeg"); // Change format as needed

        // Set the value of the hidden input field with the edited image data
        document.getElementById("edited_image").value = editedImageData;
    }
});
