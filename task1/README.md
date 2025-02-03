# **Dockerized LAMP Stack**

## **Objective**

This project demonstrates how to create a **Dockerized version of a LAMP stack** (Linux, Apache, MySQL, PHP). The stack consists of:
- **Nginx** as the web server.
- **PHP-FPM** for PHP support.
- **MySQL** as the database.

The application connects to MySQL and displays a message such as **"Hello, World! Your MySQL connection is successful."**

---

## **Folder Structure**
```
task1
├── README.md
├── docker-compose.yml
├── mysql
│   └── init.sql
├── nginx
│   ├── Dockerfile
│   └── default.conf
└── php
    ├── Dockerfile
    └── index.php
```
---

## **Setup Instructions**

### **Prerequisites**
Before proceeding, ensure you have **Docker** and **Docker Compose** installed on your machine.

### **Step 1: Build the Docker Containers**
Navigate to the root of the project directory and run the following command to build the Docker containers:

```bash
docker-compose build
```
### **Step 2: Run the Containers**
After building the containers, run the following command to start the containers in detached mode:

```bash
docker-compose up -d
```

This will start the Nginx, PHP, and MySQL containers. The MySQL container is initialized with the init.sql script, which sets up the lamp_db database.

### **Step 3: Access the Application**
Once the containers are up and running, open your browser and navigate to:

```bash
http://13.234.238.227:80
```
You should see the message:
"Connected successfully to MySQL!"

This confirms that the PHP application is successfully connecting to the MySQL database.

