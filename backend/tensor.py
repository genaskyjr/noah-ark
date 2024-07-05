import tensorflow as tf
import numpy as np
import cv2

# Import the necessary libraries

# Load the trained model
model = tf.keras.models.load_model('/root/my_model.h5')

# Prepare the image for prediction
image = cv2.imread('2.jpg')
image = cv2.resize(image, (model.input_shape[1], model.input_shape[2]))
image = np.array(image)
image = image / 255.0

# Make a prediction
prediction = model.predict(image[np.newaxis, ...])

# Interpret the prediction
predicted_class = np.argmax(prediction)
classes = ["cat", "dog"]
print("Predicted class:", classes[predicted_class])
