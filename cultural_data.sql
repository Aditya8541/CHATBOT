-- Create database
CREATE DATABASE IF NOT EXISTS cultural_exchange_bot;
USE cultural_exchange_bot;

-- Create cultural_info table
CREATE TABLE IF NOT EXISTS cultural_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    country VARCHAR(100) NOT NULL,
    topic ENUM('culture', 'traditions', 'festivals', 'food') NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create festivals table
CREATE TABLE IF NOT EXISTS festivals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    country VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create language_phrases table
CREATE TABLE IF NOT EXISTS language_phrases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    language VARCHAR(100) NOT NULL,
    phrase VARCHAR(200) NOT NULL,
    translation TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data for cultural_info
INSERT INTO cultural_info (country, topic, description) VALUES
('Japan', 'culture', 'Japanese culture is known for its emphasis on harmony, respect, and tradition. The concept of "wa" (harmony) is central to Japanese society.'),
('India', 'traditions', 'Indian traditions are diverse and rich, with practices varying across regions. Common traditions include yoga, meditation, and various religious ceremonies.'),
('Mexico', 'food', 'Mexican cuisine is famous for its bold flavors and variety. Key ingredients include corn, beans, chili peppers, and various spices.'),
('France', 'festivals', 'France celebrates numerous cultural festivals, including Bastille Day (July 14) and various wine and food festivals throughout the year.');

-- Insert sample data for festivals
INSERT INTO festivals (name, country, date, description) VALUES
('Cherry Blossom Festival', 'Japan', '2024-03-20', 'Celebration of spring with cherry blossoms, traditional performances, and cultural activities.'),
('Diwali', 'India', '2024-11-12', 'Festival of lights celebrating the victory of light over darkness.'),
('Day of the Dead', 'Mexico', '2024-11-01', 'Traditional celebration honoring deceased loved ones with altars, food, and festivities.'),
('Bastille Day', 'France', '2024-07-14', 'National celebration marking the French Revolution with parades and fireworks.');

-- Insert sample data for language_phrases
INSERT INTO language_phrases (language, phrase, translation, category) VALUES
('Japanese', 'こんにちは', 'Hello', 'Greetings'),
('Hindi', 'नमस्ते', 'Hello', 'Greetings'),
('Spanish', 'Hola', 'Hello', 'Greetings'),
('French', 'Bonjour', 'Hello', 'Greetings'),
('Japanese', 'ありがとう', 'Thank you', 'Courtesy'),
('Hindi', 'धन्यवाद', 'Thank you', 'Courtesy'),
('Spanish', 'Gracias', 'Thank you', 'Courtesy'),
('French', 'Merci', 'Thank you', 'Courtesy'); 