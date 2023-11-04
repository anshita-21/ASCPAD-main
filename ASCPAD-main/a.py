import cv2
import easyocr

# Open the camera
cap = cv2.VideoCapture(0)

# Check if the camera was opened successfully
if not cap.isOpened():
    print("Error opening video capture")
    exit()

# Prompt the user to click a picture
print("Press SPACE to click a picture")
while True:
    # Capture a frame from the camera
    ret, frame = cap.read()

    # Display the frame
    cv2.imshow("Camera", frame)

    # Check if the user pressed SPACE
    if cv2.waitKey(1) & 0xFF == ord(' '):
        break

# Release the camera
cap.release()

# Convert the captured frame to grayscale
gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

# Apply a threshold to the grayscale image to make it binary
thresh = cv2.threshold(
    gray, 0, 255, cv2.THRESH_BINARY_INV + cv2.THRESH_OTSU)[1]

# Find contours in the binary image
contours, hierarchy = cv2.findContours(
    thresh, cv2.RETR_TREE, cv2.CHAIN_APPROX_SIMPLE)

# Sort the contours by area in descending order
contours = sorted(contours, key=cv2.contourArea, reverse=True)[:10]

# Loop over the contours
for contour in contours:
    # Get the bounding box of the contour
    x, y, w, h = cv2.boundingRect(contour)

    # Check if the bounding box has the aspect ratio of a number plate
    aspect_ratio = w / float(h)
    if aspect_ratio > 2.5 and aspect_ratio < 5.0:
        # Crop the image to the bounding box
        plate_image = frame[y:y+h, x:x+w]

        # Convert the cropped image to grayscale
        plate_gray = cv2.cvtColor(plate_image, cv2.COLOR_BGR2GRAY)

        # Apply a threshold to the cropped image to make it binary
        plate_thresh = cv2.threshold(
            plate_gray, 0, 255, cv2.THRESH_BINARY_INV + cv2.THRESH_OTSU)[1]

        # Use EasyOCR to recognize the text in the cropped image
        reader = easyocr.Reader(['en'])
        result = reader.readtext(plate_thresh)

        # Print the recognized text
        print(result[0][1])

# Close all windows
cv2.destroyAllWindows()