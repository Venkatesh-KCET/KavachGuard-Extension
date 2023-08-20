# KavachGuard Extension - NSFW Filter Browser Extension

NSFW Filter is a browser extension designed to block NSFW (Not-Safe-For-Work) images from web pages that you load using TensorFlowJS. This extension operates locally in your browser and does not collect or send any user data to external servers. All image processing is done on your device, ensuring your privacy is maintained. NSFW Filter currently supports Google Chrome and is in the process of being ported to Safari.

## Table of Contents

- [Usage](#usage)
- [Development](#development)
  - [Adding to Chrome](#adding-to-chrome)
- [Contribute](#contribute)

## Usage

Once you've added the NSFW Filter extension to your browser, it will become active every time you load a compatible website. The extension's main function is to hide all images on a page and only display images that have been classified as **NOT NSFW** by the AI-powered algorithm.

To control the extension's behavior, you can toggle it on or off from the `chrome://extensions` page in Google Chrome. Additionally, you can open the popup window to access and modify NSFW Filter settings.

## Development

### Adding to Chrome

Follow these steps to add the NSFW Filter extension to Google Chrome:

1. Open Google Chrome and navigate to `chrome://extensions` or open the Settings menu and click on "Extensions" from the bottom left.

2. Enable Developer Mode by toggling the switch next to "Developer mode."

3. Click the "Load Unpacked" button and select the extension directory (`.../dist`).

4. The NSFW Filter extension is now installed and ready to be used.
