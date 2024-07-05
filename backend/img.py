from PIL import Image
import os
import sys
import numpy as np
import cv2

data_dir = '../uploads/pets'
image_exts = {'.jpeg', '.jpg', '.png'}

# Define Color Histogram Similarity
def color_histogram_similarity(image1_path, image2_path):
    hist_size = [256, 256, 256]
    hist_range = [0, 256, 0, 256, 0, 256]
    image1 = cv2.imread(image1_path)
    image2 = cv2.imread(image2_path)

    hist1 = cv2.calcHist([image1], [0, 1, 2], None, hist_size, hist_range)
    hist2 = cv2.calcHist([image2], [0, 1, 2], None, hist_size, hist_range)

    similarity = cv2.compareHist(hist1, hist2, cv2.HISTCMP_CORREL)
    return similarity

# Define Image Matching Function
def target_image(target_path):
    best_match = None
    best_similarity = float('-inf')

    for root, dirs, files in os.walk(data_dir):
        for file in files:
            if os.path.splitext(file)[-1].lower() in image_exts:
                image_path = os.path.join(root, file)
                input_similarity = color_histogram_similarity(target_path, image_path)

                if input_similarity > best_similarity:
                    best_similarity = input_similarity
                    best_match = image_path

    return best_match

# Testing
image_path = sys.argv[1]

best_match = target_image(image_path)
print(f"{best_match}")
