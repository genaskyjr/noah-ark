import torch
import sys
import os


# Model
model = torch.hub.load('ultralytics/yolov5', 'yolov5s', pretrained=True)
imgs = sys.argv[1]
results = model(imgs)
email = sys.argv[2]
results.crop(save_dir=email)


if os.path.isdir(f"/var/www/html/backend/{email}/crops/dog"):
    Imagepath = os.path.join(f"/var/www/html/backend/{email}/crops/dog", os.listdir(f"/var/www/html/backend/{email}/crops/dog")[0])
elif os.path.isdir(f"/var/www/html/backend/{email}/crops/cat"):
    Imagepath = os.path.join(f"/var/www/html/backend/{email}/crops/cat", os.listdir(f"/var/www/html/backend/{email}/crops/cat")[0])
else:
    Imagepath = 'no detected dog or cat'

# Print the image path
print(Imagepath)












