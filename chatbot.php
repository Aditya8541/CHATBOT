<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_config.php';
require_once 'functions.php';
require_once 'api_functions.php';

// Get POST data
$input = file_get_contents('php://input');
error_log("Received input: " . $input);

$data = json_decode($input, true);
$message = isset($data['message']) ? trim($data['message']) : '';

if (empty($message)) {
    echo json_encode(['error' => 'No message provided']);
    exit;
}

// Process the message and generate response
try {
    $response = processMessage($message);
    echo json_encode(['response' => $response]);
} catch (Exception $e) {
    error_log("Error processing message: " . $e->getMessage());
    echo json_encode(['error' => 'Internal server error']);
}

function processMessage($message) {
    // Convert message to lowercase for easier matching
    $message = strtolower($message);
    error_log("Processing message: " . $message);
    
    // Check for greetings
    if (preg_match('/^(hi|hello|hey|greetings)/', $message)) {
        return "Hello! I'm here to help you learn about different cultures. What would you like to know about?";
    }
    
    // Check for country-specific queries with more flexible pattern
    if (preg_match('/(what is|tell me about|describe|explain|about|japanese|indian|mexican|french) (.*?)(culture|traditions|festivals|food)/', $message, $matches)) {
        $country = trim($matches[2]);
        $topic = $matches[3];
        
        // If country is empty, try to extract it from the first match
        if (empty($country)) {
            if (preg_match('/(japanese|indian|mexican|french)/', $message, $countryMatch)) {
                $country = $countryMatch[1];
            }
        }
        
        error_log("Extracted country: " . $country . ", topic: " . $topic);
        
        // Get cultural information from API
        $culturalInfo = getCulturalInfo($country);
        
        if ($culturalInfo && isset($culturalInfo[$topic])) {
            return $culturalInfo[$topic];
        } else {
            // Try to get basic country information from REST Countries API
            $countryInfo = getCountryInfo($country);
            if ($countryInfo && !empty($countryInfo)) {
                return "I found some information about $country: " . 
                       "It's located in " . $countryInfo[0]['region'] . 
                       " and has a population of " . number_format($countryInfo[0]['population']) . 
                       " people. The capital is " . $countryInfo[0]['capital'][0] . ".";
            } else {
                return "I'm sorry, I don't have specific information about $topic in $country. Would you like to know about another country or topic?";
            }
        }
    }
    
    // Check for festival queries with more flexible pattern
    if (preg_match('/(upcoming|festival|celebration|holiday)/', $message)) {
        $festivals = getFestivalInfo();
        
        if ($festivals) {
            $response = "Here are the cultural festivals:\n";
            foreach ($festivals as $festival) {
                $date = date('F j, Y', strtotime($festival['date']));
                $response .= "- {$festival['name']} in {$festival['country']} on {$date}\n";
            }
            return $response;
        } else {
            return "I don't have information about festivals at the moment. Would you like to know about something else?";
        }
    }
    
    // Check for language queries
    if (preg_match('/(language|speak|say|translate)/', $message)) {
        // Try to extract language from the query
        if (preg_match('/(japanese|french|hindi|spanish)/', $message, $matches)) {
            $language = $matches[1];
            $phrases = getLanguagePhrases($language);
            if ($phrases) {
                $response = "Here are some basic phrases in $language:\n";
                foreach ($phrases as $phrase) {
                    $response .= "- {$phrase['phrase']}: {$phrase['translation']}\n";
                }
                return $response;
            }
        }
        return "I can help you learn basic phrases in different languages! What language would you like to learn about? (Japanese, French, Hindi, or Spanish)";
    }
    
    // Default response for unrecognized queries
    return "I'm not sure I understand. You can ask me about:\n- Cultures and traditions of specific countries\n- Upcoming cultural festivals\n- Basic phrases in different languages\n- Traditional foods and customs\nWhat would you like to know about?";
}

try {
    $stmt = $conn->query("SELECT * FROM cultural_info");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log("Data in cultural_info: " . print_r($result, true));
} catch(PDOException $e) {
    error_log("Database error: " . $e->getMessage());
}
?> 