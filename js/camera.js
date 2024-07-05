document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const capturedImage = document.getElementById('capturedImage');
    const startButton = document.getElementById('startButton');
    const captureButton = document.getElementById('captureButton');
    const fileInput = document.getElementById('fileInput');
    let mediaStream;

    startButton.addEventListener('click', () => {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                mediaStream = stream;
                video.srcObject = stream;
                video.play();
                startButton.disabled = true;
                captureButton.disabled = false;
                fileInput.disabled = false;
            })
            .catch((error) => {
                console.error('Error accessing the camera:', error);
            });
    });

    captureButton.addEventListener('click', () => {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        capturedImage.src = canvas.toDataURL('image/jpeg');
        capturedImage.style.display = 'block';
        fileInput.style.display = 'block';
    });

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            const dataURL = reader.result;
            capturedImage.src = dataURL;
        }

        reader.readAsDataURL(file);
    });
});
