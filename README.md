# ZIP Download Activity Plugin for Moodle

This repository contains a custom Moodle activity module for distributing individualized lab files to students, 
along with example files and sample solutions for demonstration and testing.

---

## Features

- Teachers upload a ZIP template containing `.c` files and a `Makefile` when creating the activity.
- When students access the activity, the plugin generates and downloads a personalized ZIP with their name and student ID inserted into the files.
- The plugin can adjust placeholders in `.c` files (e.g., `@author TODO`, `"00000"`)
- The Makefile's `PORT` value is updated according to the student's chosen platform (Lab, Win, Mac).

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
│   └── led_tasks.zip
│
├── sample_solutions/          # Example downloaded ZIP templates for demonstration
│   └── Templates-27955-Win.zip      # The filename format: Templates-StudentID-Platform.zip
│
└── README.md
```


## Installation

1. A. Copy the `zipdownload` folder into your Moodle `mod` directory:/path/to/moodle/mod/
   B. Log in as admin and go to **Site Administration > Plugins > Install Plugins > Drop ZIP Plugin Folder in the Upload Form
2. Log in as admin and go to **Site Administration > Notifications** to complete the installation.

---

## Usage

1. In your Moodle course, turn editing on and **add an activity**.
2. Choose **ZIP Download**.
3. Upload your ZIP template containing `.c` files and a `Makefile`. ( in example led_tasks.zip )
4. Select a default platform for Makefiles: "Lab", "Mac", or "Windows".
5. Optionally add a description if needed.
6. Save and return to the course.
7. Students open the activity, select their platform, and instantly receive a personalized ZIP. ( in example Templates-27955-Win.zip )

---

## Example Files

-**`examples/led_tasks.zip`** — ZIP file with two C code templates for lab tasks
- **`sample_solutions/Templates-27955-Win.zip`** — Sample downloaded template files with student name and ID replaced. Name: Tangat Baktybergen , ID: 27955, Platform: Windows

---

## Authors

- Ivan Volosyak
- Tangat Baktybergen

---

## License

GNU GPL v3 or later

---

*Developed for bachelor’s thesis at Hochschule Rhein-Waal.*



