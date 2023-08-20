**NSFW Dataset - Readme**

This folder contains a categorized dataset for training a machine learning model, specifically MobileNetV2, on NSFW (Not Safe For Work) content classification. The dataset is organized into four categories: "hentai," "neutral," "pornographic," and "sexy." Each category has its corresponding folder containing relevant images.

**Dataset Categories:**

1. "hentai": Explicit and suggestive anime-style content.
2. "neutral": Neutral and non-explicit images.
3. "pornographic": Explicit adult content.
4. "sexy": Images with suggestive or sexualized content.

**Instructions for Data Collection:**

1. Run a web search on Google or Bing for each of the above categories.
2. Scroll through the search results until no more content is available for each category.
3. After scrolling completion, manually save the resulting web page as an HTML file. Use **Ctrl + S** (or **Cmd + S** on Mac) to save the page.
4. In the saved HTML file, delete any CSS and JS files while retaining other files in an unknown format.

**Using "change.py" for Data Processing:**

1. In the parent directory, there is a Python script named "change.py" provided.
2. Open "change.py" in a text editor and locate the `folder_path` variable.
3. Replace `"path_to_respective_folder"` with the actual path to each category's respective folder (e.g., "hentai," "neutral," "pornographic," "sexy").
4. Run the modified "change.py" script using a Python interpreter. This script automatically converts unknown formats to the image format and organizes files.
5. Unwanted and irrelevant images are deleted, and the relevant images are copied to the appropriate category folder.

**Note:**

- This dataset is intended for educational and research purposes only and must not be used for any unethical or illegal activities.
- Ensure responsible usage of the dataset and adhere to content guidelines and legal restrictions.
- The provided Python script "change.py" simplifies the process of organizing and converting the files, but please review and understand the script's functionality before running it.
- Respect the terms of use of the search engines and websites from which the data is collected.

**Disclaimer:**
Using and distributing explicit or adult content may have ethical and legal implications. Make sure to handle such content responsibly and comply with the applicable laws and regulations.

*Remember to use this dataset and associated scripts responsibly and in accordance with the law and ethical guidelines.*