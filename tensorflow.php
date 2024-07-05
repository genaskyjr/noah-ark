<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dog or Cat Classifier</title>
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest"></script>

  <style>
    #image-preview {
      width: 224px;
      height: 224px;
      border: 1px solid #ccc;
    }

    #prediction {
      font-size: 16px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Dog or Cat Classifier</h1>

  <p>Select an image to classify:</p>
  <input type="file" id="image-file" accept="image/*">

  <div>
    <img id="image-preview" src="">
    <p id="prediction"></p>
  </div>

  <script>
    // Load the pre-trained model
    async function loadModel() {
      const model = await tf.loadModel('model.json');
      return model;
    }

    // Classify an image
    async function classifyImage(image) {
      // Preprocess the image
      const tensor = tf.image.resizeBilinear(tf.expandDims(image, 0), [224, 224]);
      const normalizedTensor = tf.cast(tensor, 'float32') / 255.0;

      // Make a prediction
      const prediction = await model.predict(normalizedTensor);
      const probability = prediction.dataSync()[0];
      const label = probability > 0.5 ? 'Dog' : 'Cat';

      // Update the prediction display
      document.getElementById('prediction').textContent = `Prediction: ${label} (Probability: ${probability.toFixed(2)})`;
    }

    // Load the model and handle file selection
    loadModel().then(model => {
      const imageFile = document.getElementById('image-file');
      imageFile.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = () => {
          const image = new Image();
          image.onload = () => {
            document.getElementById('image-preview').src = image.src;
            classifyImage(tf.image.toTensor(image));
          };
          image.src = reader.result;
        };
        reader.readAsDataURL(file);
      });
    });
  </script>
</body>
</html>
