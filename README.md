# Obscenity Content Detection Browser Extension - KavachGuard Extension

**Table of Contents**
- [Overview](#overview)
- [Technical Stack](#technical-stack)
- [Machine Learning Model](#machine-learning-model)
- [Data Clustering](#data-clustering)
- [Profanity Filtering](#profanity-filtering)
- [Data Scraping](#data-scraping)
- [Conversion to TensorFlow.js](#conversion-to-tensorflowjs)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Contributors](#contributors)

## Overview

The Obscenity Content Detection Browser Extension, named KavachGuard, is designed to enhance the user browsing experience by identifying and filtering out obscenity content within web pages. The extension employs a combination of technologies including HTML, CSS, JavaScript, and machine learning techniques to achieve its goals.

## Technical Stack

The extension is built using the following technologies:

- HTML: Defines the structure and layout of the extension popup and user interface.
- CSS: Adds styling and presentation to the extension components for an appealing design.
- JavaScript: Implements interactive behaviors, communicates with web pages, and integrates the machine learning model.
- Chrome Extension: Utilized to create a browser extension compatible with Google Chrome.
- TensorFlow.js: Integrated to incorporate machine learning models for in-browser content detection.

## Machine Learning Model

The core machine learning model used in this extension is based on MobileNet, chosen for its efficiency and accuracy in front-end prediction. TensorFlow.js is utilized to seamlessly integrate this model into the extension, enabling real-time content analysis within the browser.

## Data Clustering

To optimize data processing and improve performance, the extension employs K-Means clustering for data grouping. This approach ensures similar data is processed together, enhancing the efficiency of web page content analysis.

## Profanity Filtering

Profanity filtering is achieved by masking out offensive words with asterisks (*). This ensures that offensive language is concealed from the user's view, creating a more pleasant browsing experience.

## Data Scraping

Java's RipMe is used for data scraping to collect the dataset required for training the machine learning module. The gathered data is then prepared and utilized for model training and validation.

## Conversion to TensorFlow.js

Python's TensorFlow is used to create and train the machine learning model. The trained model is then converted into TensorFlow.js format, enabling smooth integration with the browser extension.

## Installation

To install and utilize the extension, follow these steps:

1. Download or clone this repository from [here](https://github.com/Venkatesh-KCET/KavachGuard-Extension).
2. Open Google Chrome.
3. Access the Extensions page by clicking the three dots in the upper-right corner, selecting "More tools," and then choosing "Extensions."
4. Enable "Developer mode" using the toggle switch in the top-right corner.
5. Click "Load unpacked" and select the directory where you downloaded the repository.

## Usage

Once the extension is installed, follow these steps:

1. Navigate to a web page.
2. Click the extension icon in the browser toolbar.
3. The extension popup will appear, indicating the presence of obscenity content.
4. You can opt to apply profanity filtering or hide offensive content by interacting with the extension popup.

## Project Structure

The repository contains the following folders:

- **admin-panel**: A PHP program providing a comprehensive dashboard for analyzing data related to the extension's usage. This dashboard allows real-time statistics monitoring, trend visualization, and user behavior insights.
- **chrome-extension**: NSFW Filter browser extension designed to block NSFW images using TensorFlowJS. Operates locally in the browser, ensuring user privacy.
- **dataset**: Contains a categorized dataset for MobileNetV2 training on NSFW content classification.
- **nsfw_classification**: Python code guide for training a MobileNetV2 model to identify NSFW content using a dataset of images.

## Contributors

- [Santhi Priya K - Mentor](https://github.com/spbaskaran)

- [Venkatesh S](https://github.com/Venkatesh-KCET)
- [Kannan T](https://github.com/Kannan7122)
- [Jeevitha Raj D](https://github.com/Jeevith-Raj)
- [Aravind Narayanan G](https://github.com/aravindnaanaa)
- [Srinithi S](https://github.com/Iris-adroit)
- [Mariumbei S](https://github.com/marium777)

This project was developed for an Indian government hackathon and has been selected for the final round. It aims to provide users with a safer browsing experience by filtering out obscenity content using advanced technologies and machine learning techniques.
