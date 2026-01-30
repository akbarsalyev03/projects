# CSV Editor (PHP + Docker)

A simple **CSV Editor** built with **PHP** that allows you to **edit**, **add/remove rows**, and **add/remove columns** in CSV files.

The project runs entirely in a **Docker** environment and is built on **Nginx + PHP**.

---

## 📁 Project Structure

```
csv-editor/
├── docker/
│   ├── nginx/
│   │   └── default.conf      # Nginx configuration
│   └── php/
│       └── Dockerfile        # Dockerfile for PHP image
│
├── src/
│   ├── uploads/              # Uploaded CSV files
│   ├── check.php             # CSV validation (if available)
│   ├── funk.php              # Helper functions
│   ├── index.php             # Main page
│   └── view.php              # View and edit CSV
│
├── .dockerignore
├── .gitignore
├── docker-compose.yml        # Docker services configuration
└── README.md
```

---

## ⚙️ Technologies

* **Backend:** PHP
* **Web Server:** Nginx
* **Containerization:** Docker, Docker Compose
* **Frontend:** HTML / CSS (minimal)
* **Data Format:** CSV

---

## 📦 Requirements

* Docker
* Docker Compose

> No need to install PHP or Nginx locally — everything runs inside Docker.

---

## 🚀 Installation and Setup

### 1️⃣ Clone the repository

```bash
git clone https://github.com/akbarsalyev03/projects.git
cd project/csv-editor
```

### 2️⃣ Start Docker containers

```bash
docker-compose up -d --build
```

### 3️⃣ Open in browser

```text
http://localhost
```

If a different port is specified in `docker-compose.yml`, use the appropriate port.

---

## 🧑‍💻 Usage

1. Upload a CSV file
2. View the CSV in table format
3. Edit the data as needed
4. Save the modified CSV file

---

## ⚠️ Limitations

* ❌ No filtering or sorting
* ❌ Limited automatic validation

This project is designed for **simple and educational purposes**.

---

## 🛠 Future Enhancements

* [ ] Undo / Redo functionality
* [ ] CSV validation
* [ ] Optimization for large files
* [ ] UI improvements

---

## 👤 Author

* **Akbar**
* GitHub: `@akbarsalayev03`
