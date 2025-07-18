# Individual ZIP Download Activity Plugin for Moodle

## Short Description

Moodle plugin for generating individual zip templates, automatically replacing @author and student ID placeholders in C code with personalized student data. It was designed specifically for the Microcontroller course utilizing the ATmega microcontrollers programmed in C. With typically over 50 small programs to be created during the semester by each student, this plugin will save significant time by automating the inclusion of student IDs and their names in each file.

Designed as an activity module, this plugin allows teachers to upload a ZIP template containing placeholders (@author to be replaced by the full name of each student and 00000 to be replaced by the student ID). Students can download a personalized ZIP with their name and ID automatically filled across over 50 files of source code and specific Makefiles depending on the operating system selection.

---

This Moodle activity plugin allows teachers to upload a ZIP template containing many subfolders containing C files (`.c` and `.h`) and a `Makefile`. When a student opens the activity and select the platform, a personalized ZIP file is generated on-the-fly and downloaded.

---

##  What It Does
- Teacher uploads a ZIP template when creating the activity.
- ZIP may contain subfolders with one or more `.c` source files and a `Makefile`.
- The plugin searches each `.c` file and replaces:
  - `@author TODO` → `@author Firstname Lastname`
  - `"00000"` → `"StudentID"` (from Moodle ID number or user ID)
- It also edits each `Makefile` to update the `PORT` value based on student platform selection.

---

##  Platform Selection
When the student clicks the activity:
- They are prompted to select their platform (used operating system):
  - **Lab** → `PORT=/dev/ttyUSB_MySmartUSB` (default)
  - **Win** → `PORT=COM3`
  - **Mac** → `PORT=/dev/tty.SLAB_USBtoUART`
- The plugin edits the `PORT=` line in every available `Makefile` accordingly.
- The generated ZIP offered for download is named to reflect the student and platform, for example:
  - `Templates-12345-Lab.zip`
  - `Templates-12345-Win.zip`
  - `Templates-12345-Mac.zip`
  
---

## Folder Structure

```
/
├── zipdownload/               # Moodle plugin code
│   ├── lang/en
│      └── zipdownload.php
│   ├── db
│      └── upgrade.php
│      └── install.xml
│      └── access.php
│   ├── pix
│      └── icon.svg
│   ├── version.php
│   ├── view.php
│   ├── mod_form.php
│   ├── lib.php
│   ├── Readme.md
│
├── examples/                  # Example ZIP templates for testing
│   └── Templates.zip
│
├── sample_solutions/          # Example downloaded ZIP templates for demonstration
│   └── Templates-27955-Win.zip      # The filename format: Templates-StudentID-Platform.zip
│
└── README.md
```

---

##  Installation

1. Unzip this plugin into the `mod` directory of your Moodle installation:
2. Go to **Site Administration > Notifications** to complete the installation.

---
##  Creating the Activity

1. In a course, turn editing on and **Add an activity**.
2. Choose **ZIP Download**.
3. Upload your `.zip` template containing `.c` files and a `Makefile`.
4. Save and return to course.

---

## Student View
- When students click the activity, they are asked to choose their platform (Lab/Win/Mac).
- The ZIP uploaded by the teacher is extracted and automatically processed.
- A personalized ZIP is available for download instantly.

---
 
## Authors

Ivan Volosyak, Tangat Baktybergen

---

## License

GNU GPL v3 or later

---

*Developed at Rhine-Waal University of Applied Sciences (Hochschule Rhein-Waal, HSRW), Kleve, Germany.*
