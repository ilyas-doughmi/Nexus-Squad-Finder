# NEXUS | Squad Finder

![Project Status](https://img.shields.io/badge/status-active-success.svg)
![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1.svg)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.0-06B6D4.svg)

**Never Play Solo Q Again.**

Nexus is a dynamic Squad Finder platform designed for competitive gamers. It eliminates the randomness of matchmaking by allowing users to find teammates who match their rank, role, and communication preferences instantly.

---

## About the Project

Nexus serves as a central hub for gamers to:
- **Scout Players**: Find potential teammates based on detailed profiles.
- **Join Lobbies**: Enter existing squads looking for specific roles.
- **Create Squads**: Host your own lobby and filter for the perfect teammates.
- **Scrims**: (Planned) Organize practice matches against other squads.

The application features a modern, high-contrast "Neon/Dark" aesthetic tailored for the gaming community, utilizing a glassmorphism design system.

---

## Key Features

- **User Authentication**: Secure Login and Registration system with password hashing (`password_hash`).
- **Dynamic Profiles**: 
  - Customizable profiles with Rank, Role, and "Game Playing" indicators.
  - Avatar management.
- **Squad Management**:
  - Live matchmaking lobby system.
  - Slot-based squad system (e.g., specific roles like "Duelist" or "Controller").
- **Social Features**:
  - Friend Request system (Send/Accept/Reject).
  - Online status indicators.
- **Responsive Design**: Fully responsive interface built with TailwindCSS.

---

## Technology Stack

### Backend
- **PHP**: Core application logic using Object-Oriented Programming (OOP).
- **MySQL**: Relational database management.
- **PDO**: Secure database connections and queries.

### Frontend
- **HTML5 & CSS3**: Semantic markup and modern styling.
- **TailwindCSS**: Utility-first CSS framework for rapid UI development.
- **JavaScript**: Client-side interactivity and AJAX (where applicable).
- **Google Fonts**: Typography using 'Inter' and 'Rajdhani'.

---

## Getting Started

Follow these instructions to set up the project on your local machine.

### Prerequisites

- **XAMPP** or **WAMP** (or any generic PHP/MySQL environment).
- **Composer** (optional, if you plan to extend dependencies).

### Installation

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/yourusername/nexus-squad-finder.git
    cd nexus-squad-finder
    ```

2.  **Database Setup**
    - Open your MySQL administration tool (e.g., phpMyAdmin).
    - Create a new database named `ASTRAL`.
    - Import the `sql/install.sql` file provided in the repository to create the necessary tables (`users`, `friend_request`, `squad`, `squad_slot`).

3.  **Configure Connection**
    - Open `Class/connexion.php`.
    - Verify your database credentials. Default XAMPP settings are usually:
      ```php
      private $host = "localhost";
      private $db_name = "ASTRAL";
      private $user = "root";
      private $password = ""; // Or "root" for MAMP
      ```

4.  **Run the Application**
    - Move the project folder to `htdocs` (XAMPP) or `www` (WAMP).
    - Open your browser and navigate to:
      ```
      http://localhost/Nexus-Squad-Finder/index.php
      ```

---

## Database Schema

The `ASTRAL` database consists of the following key tables:

- **`users`**: Stores user credentials, profiles, ranks, and roles.
- **`friend_request`**: Manages friend relationships (Sender ID, Receiver ID, Status).
- **`squad`**: Stores active lobbies/squads info (Title, Game, Owner).
- **`squad_slot`**: Manages individual slots within a squad (Occupant ID or NULL).

---

## Project Structure

```bash
Nexus-Squad-Finder/
├── Class/              # PHP Classes (Business Logic)
│   ├── connexion.php   # Database connection
│   ├── User.php        # User management methods
│   ├── Lobby.php       # Lobby management methods
│   └── Friend.php      # Friend system methods
├── Includes/           # Reusable UI components (Navbar, Sidebar)
├── pages/              # View files
│   ├── login.php       # Login page
│   ├── register.php    # Registration page
│   └── profile.php     # User profile page
├── sql/                # SQL scripts (Schema)
├── index.php           # Landing page
└── readme.md           # Documentation
```
