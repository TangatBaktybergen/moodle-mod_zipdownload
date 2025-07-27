# ZIP Download Activity Plugin for Moodle

**Personalized Code Distribution for Lab-Based Programming Courses**

This Moodle activity plugin allows teachers to upload a ZIP template containing `.c` and `.h` files (including subfolders) and one or more `Makefile`s. When a student accesses the activity, a personalized ZIP file is generated and downloaded. The plugin automatically replaces placeholders like `@author` and `00000` with the student’s full name and ID.

It is ideal for courses that require distributing lab starter code, such as embedded systems, robotics, or microcontroller programming.

---

## What It Does

- Teachers upload a ZIP template when creating the activity.
- The ZIP may include subfolders, `.c`/`.h` files, and one or more `Makefile`s.
- On student access:
  - `@ Firstname Lastname` is inserted where `@Author TODO` was used.
  - `"00000"` is replaced with the student’s ID.
  - `Makefile`s are modified based on the student’s platform selection.
  - A personalized ZIP is generated instantly for download.

---

## Platform Selection

When the student clicks the activity:
- They are prompted to select their platform:
  - **Lab** → `PORT=/dev/ttyUSB_MySmartUSB`
  - **Windows** → `PORT=COM3`
  - **Mac** → `PORT=/dev/tty.SLAB_USBtoUART`
- All `Makefile` files are automatically updated with the selected `PORT` value.
- The generated ZIP file is renamed to reflect the student and platform:
  - `Templates-12345-Lab.zip`
  - `Templates-12345-Win.zip`
  - `Templates-12345-Mac.zip`

---

## Installation

1. Unzip this plugin into the `mod` directory of your Moodle installation: /path/to/moodle/mod/zipdownload
2. Visit **Site Administration > Notifications** to complete installation.

---

## Creating the Activity

1. In your Moodle course, turn editing on and **Add an activity**.
2. Choose **ZIP Download**.
3. Upload your ZIP template containing `.c`/`.h` files and `Makefile`s.
4. Save and return to the course.

---

## Student View

- Students click the activity and select their platform.
- The plugin processes the uploaded ZIP template:
- Replaces author and ID placeholders
- Edits `Makefile`s with platform-specific ports
- A personalized ZIP file is downloaded immediately.

---

##  Authors

Ivan Volosyak  
Tangat Baktybergen

---

## License

GNU GPL v3 or later

---

**Developed at Rhine-Waal University of Applied Sciences (HSRW), Kleve, Germany.**

