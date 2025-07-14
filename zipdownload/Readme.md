# ZIP Download Activity Plugin for Moodle

This Moodle activity plugin allows teachers to upload a ZIP template containing `.c` files. When a student opens the activity, a personalized ZIP file is generated and downloaded. The plugin automatically replaces specific placeholders in `.c` files with the student's personal information.

##  What It Does
- Teacher uploads a ZIP template when creating the activity.
- ZIP may contain one or more `.c` source files and a `Makefile`.
- The plugin searches each `.c` file and replaces:
  - `@author TODO` → `@ Firstname Lastname`
  - `"00000"` → `"StudentID"` (from Moodle ID number or user ID)
- It also edits the `Makefile` to update the `PORT` value depending on student selection.

##  Platform Selection
When the student clicks the activity:
- They are prompted to select their platform:
  - **Lab** → `PORT=/dev/ttyUSB_MySmartUSB`
  - **Win** → `PORT=COM3`
  - **Mac** → `PORT=/dev/tty.SLAB_USBtoUART`
- The plugin edits the `PORT=` line in the `Makefile` accordingly.
- The generated ZIP is renamed to:
  - `Templates-12345-Lab.zip`
  - `Templates-12345-Win.zip`
  - `Templates-12345-Mac.zip`

## 📦 Installation
1. Unzip this plugin into the `mod` directory of your Moodle installation:
   ```
   /path/to/moodle/mod/zipdownload
   ```
2. Go to **Site Administration > Notifications** to complete the installation.

##  Creating the Activity
1. In a course, turn editing on and **Add an activity**.
2. Choose **ZIP Download**.
3. Upload your `.zip` template containing `.c` files and a `Makefile`.
4. Save and return to course.

## Student View
- When a student clicks the activity:
  - They are asked to choose their platform (Lab/Win/Mac).
  - The ZIP is extracted.
  - `.c` files and `Makefile` are processed.
  - A personalized ZIP is downloaded instantly.


## Authors
Ivan Volosyak, Tangat Baktybergen

## License
GNU GPL v3 or later

*Developed for Hochschule Rhein-Waal (HSRW) PDF form automation project.*
