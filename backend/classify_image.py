import torch
import torch.nn as nn
import torchvision.transforms as transforms
from torchvision import models
from PIL import Image
from pathlib import Path
import sys
import requests

# Function to load the ResNet model without classification layer
def load_resnet_model():
    model = models.resnet18(pretrained=True)
    # Remove the final classification layer
    model = nn.Sequential(*list(model.children())[:-1])
    return model

# Define the paths
image_path = sys.argv[1]  # Get the image path from command line argument
test_image_path = Path(image_path)

# Modify the transformation for the images
class CutOffPercentage(object):
    def __init__(self, cutoff_percentage):
        self.cutoff_percentage = cutoff_percentage

    def __call__(self, img):
        width, height = img.size
        cut_width = int(width * self.cutoff_percentage)
        cut_height = int(height * self.cutoff_percentage)
        img = img.crop((cut_width, cut_height, width - cut_width, height - cut_height))
        return img

transform = transforms.Compose([
    CutOffPercentage(0.2),  # Cut off 20%
    transforms.Resize((224, 224)),
    transforms.ToTensor(),
    transforms.Normalize(mean=[0.485, 0.456, 0.406], std=[0.229, 0.224, 0.225])
])

# Load pre-trained ResNet model
model = load_resnet_model()
model.eval()

# Load and preprocess the test image
test_image = Image.open(test_image_path).convert('RGB')  # Convert to RGB if not already
test_image = transform(test_image)
test_image = torch.unsqueeze(test_image, 0)  # Add batch dimension

# Compute feature vector for the test image
with torch.no_grad():
    test_feature = model(test_image)

# Retrieve target image paths from the JSON response
response = requests.get('https://rvpn.site/backend/classify_image_json.php')
json_response = response.json()

# Extract image and fullname paths from the JSON data
image_paths = [Path(entry["pet_img"]) for entry in json_response]
fullname_paths = [Path(entry["fullname"]) for entry in json_response]
petname_paths = [Path(entry["petname"]) for entry in json_response]

# Use all image paths
target_image_paths = image_paths
target_fullname_paths = fullname_paths
target_petname_paths = petname_paths


# (Previous code remains unchanged)

best_match = None
best_distance = float('inf')
best_fullname = None
best_petname = None

# Iterate through target images and compute their feature vectors
for idx, target_image_path in enumerate(target_image_paths):
    target_image = Image.open(target_image_path).convert('RGB')
    target_image = transform(target_image)
    target_image = torch.unsqueeze(target_image, 0)

    with torch.no_grad():
        target_feature = model(target_image)
    
    # Compute L2 distance between test and target feature vectors
    distance = torch.norm(test_feature - target_feature)

    if distance < best_distance:
        best_distance = distance
        best_match = target_image_path
        best_fullname = target_fullname_paths[idx]  # Get the corresponding fullname
        best_petname = target_petname_paths[idx]

# Calculate inverted distance percentage
max_distance = 100.0  # Set a maximum distance (adjust this according to your needs)
inverted_distance_percentage = 100 - (best_distance / max_distance) * 100

# Prepare output JSON
output_json = f'''
{{
  "bestmatch": "{best_match}",
  "distance": "{inverted_distance_percentage:.2f}%",
  "fullname": "{best_fullname}",
  "pet_name": "{best_petname}"
}}
'''

print(output_json)

