import os

def change_extension(folder_path, old_extension, new_extension):
    for filename in os.listdir(folder_path):
        if filename.endswith(old_extension):
            old_path = os.path.join(folder_path, filename)
            new_filename = filename + new_extension
            new_path = os.path.join(folder_path, new_filename)
            
            try:
                os.rename(old_path, new_path)
                print(f"Renamed: {old_path} -> {new_path}")
            except Exception as e:
                print(f"Error renaming {old_path}: {e}")

if __name__ == "__main__":
    folder_path = "hentai"
    old_extension = ""  # Specify the old extension to change from
    new_extension = ".png"  # Specify the new extension to change to
    
    change_extension(folder_path, old_extension, new_extension)
