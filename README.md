# EKRANAS - Hospital Staff Management Web Application

EKRANAS is a web application developed using Symfony, designed to provide an easy-to-use interface for managing and displaying information about hospital staff.

### Acknowledgments
We thank the entire development team and users who contributed their valuable suggestions during the testing phase of EKRANAS. Specially David Romaní Also and the members of IT HCA (Hospital Comarcal d'Amposta); José Antonio Subirats, Óscar Anton Sanchez and Víctor Nicaforo Otalora.
## Features

- **Intuitive Display:** Allows users to easily view up-to-date information about doctors.
- **Doctor Data Editing:** Quick and intuitive editing functionality for authorized users.
- **Automatic Schedule Updates:** A system that updates doctors' schedules according to their working shifts.
- **Data Security:** Robust protection for sensitive data stored in the application.

## Technologies Used

- Symfony
- PHP
- MySQL
- HTML/CSS
- JavaScript

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- Symfony
- Node.js and npm (for front-end package management)

## Installation

1. Clone the repository:
   ```bash
   git clone https://example.com/ekranas.git
   ```
2. Install Composer dependencies:
   ```bash
   composer install
   ```
3. Configure the `.env` file with database details and other necessary environment variables.
4. Run the database migrations:
   ```bash
   php bin/console doctrine:migrations:migrate
   ```
5. (Optional) Install front-end dependencies:
   ```bash
   npm install
   npm run build
   ```

## Usage

After installation and configuration, you can run the application locally with:

```bash
symfony server:start
```

Visit `http://localhost:8000` in your browser to access EKRANAS.

## Contributions

Contributions are welcome. If you wish to contribute to the project, please open a pull request with a detailed description of your proposed changes.

## Support

For any technical issues or queries, please open an issue in this repository.


---

*EKRANAS Project - Intuitive Connection and Management of Medical Information. - done by Kizumi19(Júlia Krukonis Beltri)*

---

