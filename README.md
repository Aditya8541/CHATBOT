# Cultural Exchange Bot

A web-based chatbot that facilitates cultural exchange between users by providing information about traditions, languages, and festivals from different countries.

## Features

- Interactive chat interface with real-time responses
- Information about different cultures, traditions, and festivals
- Basic language phrases in multiple languages
- Upcoming cultural festivals calendar
- Modern and responsive design

## Technology Stack

- Frontend: HTML, CSS, JavaScript (AJAX, Fetch API)
- Backend: PHP
- Database: MySQL
- Hosting: XAMPP (Local Development), cPanel (Live Deployment)

## Setup Instructions

1. **Install XAMPP**
   - Download and install XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
   - Start Apache and MySQL services

2. **Clone the Repository**
   ```bash
   git clone [repository-url]
   cd cultural-exchange-bot
   ```

3. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `cultural_exchange_bot`
   - Import the `cultural_data.sql` file to create tables and sample data

4. **Configure Database Connection**
   - Open `db_config.php`
   - Update the database credentials if needed:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'cultural_exchange_bot');
     ```

5. **Project Setup**
   - Copy all project files to your XAMPP's `htdocs` directory
   - Access the project through: `http://localhost/cultural-exchange-bot`

## Project Structure

```
CulturalExchangeBot/
│── index.html          # Main Chat Interface
│── style.css           # Styling for chatbot UI
│── script.js           # Handles frontend interactions
│── chatbot.php         # Main bot logic (backend)
│── db_config.php       # Database connection
│── functions.php       # Helper functions for chatbot responses
│── cultural_data.sql   # Database schema for cultural info
│── events.php          # Displays cultural events
│── about.php           # About the project
└── contact.php         # Contact form for user feedback
```

## Usage

1. Open the application in your web browser
2. Start chatting with the bot by typing your questions
3. Ask about:
   - Cultures and traditions of specific countries
   - Upcoming cultural festivals
   - Basic phrases in different languages
   - Traditional foods and customs

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contact

Your Name - [your-email@example.com]
Project Link: [https://github.com/yourusername/cultural-exchange-bot](https://github.com/yourusername/cultural-exchange-bot) 