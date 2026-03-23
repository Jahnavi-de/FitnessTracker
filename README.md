# 🏋️‍♀️ Fitness Tracker Web App

## 📌 Project Overview

This is a web-based Fitness Tracker application that allows users to record their workout activities and get insights about their health. The system takes user input such as number of exercises, repetitions, and duration, and calculates important fitness metrics like weight, BMI, and calories burned.

---

## 🚀 Features

* 🔐 User Registration & Login (Secure Authentication)
* 🏃 Track Workout Details:

  * Number of exercises
  * Repetitions (reps)
  * Duration of each exercise
* ⚖️ Calculate:

  * Body Weight (based on inputs)
  * BMI (Body Mass Index)
  * Calories Burned
* 📊 Dashboard to view results
* 🔒 Passwords stored securely using hashing

---

## 🛠️ Tech Stack

* **Frontend:** HTML, CSS, Bootstrap, JavaScript, jQuery
* **Backend:** PHP
* **Database:** MySQL
* **Server:** InfinityFree (Free Hosting)

---

## 📂 Project Structure

```
/project-folder
│── login.html
│── register.html
│── dashboard.php
│── login.php
│── register.php
│── config.php
│── database.sql
```

---

## ⚙️ How It Works

1. User registers using email and password
2. Password is securely stored using hashing
3. User logs in using credentials
4. User inputs:

   * Number of exercises
   * Repetitions
   * Duration
5. System calculates:

   * BMI
   * Calories burned
   * Estimated weight metrics
6. Results are displayed on dashboard

---

## 🧪 How to Run Locally (XAMPP)

1. Install XAMPP
2. Move project folder to:

   ```
   C:/xampp/htdocs/
   ```
3. Start Apache & MySQL
4. Import `database.sql` in phpMyAdmin
5. Open browser:

   ```
   http://localhost/project-folder/login.html
   ```

---

## 🎥 Demo Video

[https://drive.google.com/file/d/1lzHMwIyDpsqk7OaQ5Sj7kreaZgRzkW5y/view?usp=drivesdk]

---

## 🌐 Live Demo

[https://fitness-tracker.infinityfreeapp.com/]

---

## ⚠️ Note

This project is hosted on free hosting (InfinityFree).
In some browsers, login functionality may not work properly due to hosting security limitations.
For best results, please refer to the demo video or run the project locally.

---

## 🔒 Security

* Passwords are hashed using `password_hash()`
* Login verification uses `password_verify()`

---

## 📌 Future Improvements

* Add progress tracking graphs
* Add personalized workout suggestions
* Improve UI/UX
* Add mobile responsiveness

---

## 👩‍💻 Author

**Jahnavi Srivastava**

---
