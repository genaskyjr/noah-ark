import torch
import sys
import os


# Model
model = torch.hub.load('ultralytics/yolov5', 'yolov5s', pretrained=True)

#my new pre trained model that dog and cat only

# Image
imgs = sys.argv[1]  # batch of images


# Inference
results = model(imgs)


# Crop the detections and save them to a directory
results.crop(save_dir='cropped_images')




import os


# Check if the directory /var/www/html/backend/cropped_images/crops/dog exists
if os.path.isdir("/var/www/html/backend/cropped_images/crops/dog"):
  # If the directory exists, get the image in the directory
  Imagepath = os.path.join("/var/www/html/backend/cropped_images/crops/dog", os.listdir("/var/www/html/backend/cropped_images/crops/dog")[0])
else:
  # If the directory does not exist, check if the directory /var/www/html/backend/cropped_images/crops/cat exists
  if os.path.isdir("/var/www/html/backend/cropped_images/crops/cat"):
    # If the directory exists, get the image in the directory
    Imagepath = os.path.join("/var/www/html/backend/cropped_images/crops/cat", os.listdir("/var/www/html/backend/cropped_images/crops/cat")[0])
  else:
    # If neither directory exists, get the image in the directory /var/www/html/backend/cropped_images/
    Imagepath = 'python no detected'


# Print the image path
print(Imagepath)










