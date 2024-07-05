import sys




if __name__ == "__main__":
    # Check if all three parameters are provided
    if len(sys.argv) == 4:
        # Get the parameters from the command line arguments
        image = sys.argv[1]
        taken = sys.argv[2]
        image_type = sys.argv[3]

        # Print the received parameters
        #print(f"Image: {image}, Taken: {taken}, Type: {image_type}")
    #else:
        #print("Please provide three parameters: image, taken, type")



import matplotlib.pyplot as plt
import numpy as np
import PIL
import tensorflow as tf
from tensorflow import keras
from tensorflow.keras import layers
from tensorflow.keras.models import Sequential


batch_size = 1
img_height = 100
img_width = 100
epocs = 2
argucount = 2

# if image_type == 'Dog':
#     if taken == 'Dapdap':
#         data_dir = '/var/www/html/uploads/pets/dog/Dapdap'
#     elif taken == 'Atlu-Bola':
#         data_dir = '/var/www/html/uploads/pets/dog/Atlu-Bola'


# Sample values for image_type and taken (replace these with your actual values)
# image_type = 'Dog'
# taken = 'Dapdap'

# Dictionary mapping taken values to their respective data directories for Dog images
dog_locations = {
    'Atlu-Bola': '/var/www/html/uploads/pets/dog/Atlu-Bola',
    'Bical': '/var/www/html/uploads/pets/dog/Bical',
    'Bundagul': '/var/www/html/uploads/pets/dog/Bundagul',
    'Cacutud': '/var/www/html/uploads/pets/dog/Cacutud',
    'Calumpang': '/var/www/html/uploads/pets/dog/Calumpang',
    'Camachiles': '/var/www/html/uploads/pets/dog/Camachiles',
    'Dapdap': '/var/www/html/uploads/pets/dog/Dapdap',
    'Dau': '/var/www/html/uploads/pets/dog/Dau',
    'Dolores': '/var/www/html/uploads/pets/dog/Dolores',
    'Duquit': '/var/www/html/uploads/pets/dog/Duquit',
    'Lakandula': '/var/www/html/uploads/pets/dog/Lakandula',
    'Mabiga': '/var/www/html/uploads/pets/dog/Mabiga',
    'Macapagal Village': '/var/www/html/uploads/pets/dog/Macapagal Village',
    'Mamatitang': '/var/www/html/uploads/pets/dog/Mamatitang',
    'Mangalit': '/var/www/html/uploads/pets/dog/Mangalit',
    'Marcos Village': '/var/www/html/uploads/pets/dog/Marcos Village',
    'Mawaque (Mauaque)': '/var/www/html/uploads/pets/dog/Mawaque (Mauaque)',
    'Paralayunan': '/var/www/html/uploads/pets/dog/Paralayunan',
    'Poblacion': '/var/www/html/uploads/pets/dog/Poblacion',
    'San Francisco': '/var/www/html/uploads/pets/dog/San Francisco',
    'San Joaquin': '/var/www/html/uploads/pets/dog/San Joaquin',
    'Santa Ines': '/var/www/html/uploads/pets/dog/Santa Ines',
    'Santa Maria': '/var/www/html/uploads/pets/dog/Santa Maria',
    'Santo Rosario': '/var/www/html/uploads/pets/dog/Santo Rosario',
    'Sapang Balen': '/var/www/html/uploads/pets/dog/Sapang Balen',
    'Sapang Biabas': '/var/www/html/uploads/pets/dog/Sapang Biabas',
    'Tabun': '/var/www/html/uploads/pets/dog/Tabun'
}


cat_locations = {
    'Atlu-Bola': '/var/www/html/uploads/pets/cat/Atlu-Bola',
    'Bical': '/var/www/html/uploads/pets/cat/Bical',
    'Bundagul': '/var/www/html/uploads/pets/cat/Bundagul',
    'Cacutud': '/var/www/html/uploads/pets/cat/Cacutud',
    'Calumpang': '/var/www/html/uploads/pets/cat/Calumpang',
    'Camachiles': '/var/www/html/uploads/pets/cat/Camachiles',
    'Dapdap': '/var/www/html/uploads/pets/cat/Dapdap',
    'Dau': '/var/www/html/uploads/pets/cat/Dau',
    'Dolores': '/var/www/html/uploads/pets/cat/Dolores',
    'Duquit': '/var/www/html/uploads/pets/cat/Duquit',
    'Lakandula': '/var/www/html/uploads/pets/cat/Lakandula',
    'Mabiga': '/var/www/html/uploads/pets/cat/Mabiga',
    'Macapagal Village': '/var/www/html/uploads/pets/cat/Macapagal Village',
    'Mamatitang': '/var/www/html/uploads/pets/cat/Mamatitang',
    'Mangalit': '/var/www/html/uploads/pets/cat/Mangalit',
    'Marcos Village': '/var/www/html/uploads/pets/cat/Marcos Village',
    'Mawaque (Mauaque)': '/var/www/html/uploads/pets/cat/Mawaque (Mauaque)',
    'Paralayunan': '/var/www/html/uploads/pets/cat/Paralayunan',
    'Poblacion': '/var/www/html/uploads/pets/cat/Poblacion',
    'San Francisco': '/var/www/html/uploads/pets/cat/San Francisco',
    'San Joaquin': '/var/www/html/uploads/pets/cat/San Joaquin',
    'Santa Ines': '/var/www/html/uploads/pets/cat/Santa Ines',
    'Santa Maria': '/var/www/html/uploads/pets/cat/Santa Maria',
    'Santo Rosario': '/var/www/html/uploads/pets/cat/Santo Rosario',
    'Sapang Balen': '/var/www/html/uploads/pets/cat/Sapang Balen',
    'Sapang Biabas': '/var/www/html/uploads/pets/cat/Sapang Biabas',
    'Tabun': '/var/www/html/uploads/pets/cat/Tabun'
}

# Logic to determine data_dir based on image_type and taken for Dog images
if image_type == 'Dog':
    # Check if the taken value exists in the dog_locations dictionary
    if taken in dog_locations:
        data_dir = dog_locations[taken]


# Logic to determine data_dir based on image_type and taken for Dog images
if image_type == 'Cat':
    # Check if the taken value exists in the dog_locations dictionary
    if taken in cat_locations:
        data_dir = cat_locations[taken]



# train
train_ds = tf.keras.utils.image_dataset_from_directory(
    data_dir, # the location
    labels='inferred', # label = from subdirectory
    label_mode='int', # word
    class_names=None, # idont know
    color_mode='rgb',   # color of image will be load
    batch_size=batch_size,  # batch by batch
    image_size=(img_height, img_width),
    shuffle=True,
    seed=123, #optional for shuffling and transformations.
    validation_split=None,
    subset=None,
    interpolation='bilinear',
    follow_links=False,
    crop_to_aspect_ratio=False,
)

class_names = train_ds.class_names
#print(class_names)

import sys
import json
if len(class_names) <= 5:
    sys.exit()



#Configure the dataset for performance
AUTOTUNE = tf.data.AUTOTUNE
train_ds = train_ds.cache().shuffle(1000).prefetch(buffer_size=AUTOTUNE)

#Standardize the data
normalization_layer = layers.Rescaling(1./255)

# def crop_and_normalize(x, y):
#   x = tf.image.central_crop(x, 0.90)
#   x = normalization_layer(x)
#   return x, y


# cropped_and_normalized_ds = train_ds.map(crop_and_normalize)

normalized_ds = train_ds.map(lambda x, y: (normalization_layer(x), y))
image_batch, labels_batch = next(iter(normalized_ds))
first_image = image_batch[0]

# Notice the pixel values are now in `[0,1]`.
#print(np.min(first_image), np.max(first_image))



data_augmentation = keras.Sequential([
    layers.RandomFlip("horizontal",
                       input_shape=(img_height,
                                   img_width,
                                   3)),
    layers.RandomZoom(0.1), #zoomed oin ut by a maximum of 20% and zoomed in by a maximum of 60%.
    layers.RandomRotation(0.1)
])



for images, _ in train_ds.take(1):
  for i in range(argucount):
    augmented_images = data_augmentation(images)
    #print('data_augmentation')
  


num_classes = len(class_names)

model = Sequential([
  data_augmentation,
  layers.Rescaling(1./255),
  layers.Conv2D(16, 3, padding='same', activation='relu'),
  layers.MaxPooling2D(),
  layers.Conv2D(32, 3, padding='same', activation='relu'),
  layers.MaxPooling2D(),
  layers.Conv2D(64, 3, padding='same', activation='relu'),
  layers.MaxPooling2D(),
  layers.Dropout(0.2),
  layers.Flatten(),
  layers.Dense(128, activation='relu'),
  layers.Dense(num_classes, name="outputs")
])


#compile the model
model.compile(optimizer='adam',
              loss=tf.keras.losses.SparseCategoricalCrossentropy(from_logits=True),
              metrics=['accuracy'])


epochs=epocs
history = model.fit(
  train_ds,
  epochs=epochs
)


# sunflower_path = image

# img = tf.keras.utils.load_img(sunflower_path, target_size=(img_height, img_width))
# img_array = tf.keras.utils.img_to_array(img)
# img_array = tf.expand_dims(img_array, 0)  # Create a batch

# predictions = model.predict(img_array)
# top_classes = 5  # Number of top classes to retrieve

# top_k_indices = tf.argsort(predictions[0], direction='DESCENDING')[:top_classes]
# top_k_probabilities = tf.nn.softmax(predictions[0][top_k_indices])



# for i in range(top_classes):
#     class_index = top_k_indices[i].numpy()
#     class_probability = top_k_probabilities[i].numpy()
#     class_name = class_names[class_index]
#     print(f"{class_name}: {100 * class_probability:.2f}% confidence")

    


    # Append the dictionary to the list


#print(image)
# Convert the list of dictionaries to JSON
import json

sunflower_path = image

img = tf.keras.utils.load_img(sunflower_path, target_size=(img_height, img_width))
img_array = tf.keras.utils.img_to_array(img)
img_array = tf.expand_dims(img_array, 0)  # Create a batch

predictions = model.predict(img_array)
top_classes = 5  # Number of top classes to retrieve

top_k_indices = tf.argsort(predictions[0], direction='DESCENDING')[:top_classes]
top_k_probabilities = tf.nn.softmax(predictions[0][top_k_indices])

# Initialize an empty list to store the top 5 predictions as dictionaries
result_list = []

for i in range(top_classes):
    class_index = top_k_indices[i].numpy()
    class_probability = top_k_probabilities[i].numpy()
    class_name = class_names[class_index]

    # Create a dictionary with class name and confidence
    result_data = {
        "class_name": class_name,
        "confidence": round(100 * class_probability, 2)  # Rounding to two decimal places
    }

    # Append the dictionary to the result list
    result_list.append(result_data)

# Convert the list of dictionaries to JSON
json_output = json.dumps(result_list)

# Return the JSON output
print(json_output)
