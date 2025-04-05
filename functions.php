<?php
/**
 * Helper functions for the Cultural Exchange Bot
 */

/**
 * Sanitize user input
 */
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

/**
 * Format date for display
 */
function formatDate($date) {
    return date('F j, Y', strtotime($date));
}

/**
 * Get country name from partial match
 */
function getCountryName($partial) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT DISTINCT country FROM cultural_info WHERE country LIKE ? LIMIT 1");
    $stmt->execute(["%$partial%"]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['country'] : null;
}

/**
 * Get language name from partial match
 */
function getLanguageName($partial) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT DISTINCT language FROM language_phrases WHERE language LIKE ? LIMIT 1");
    $stmt->execute(["%$partial%"]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['language'] : null;
}

/**
 * Get basic phrases in a specific language
 */
function getLanguagePhrases($language, $limit = 5) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT phrase, translation FROM language_phrases WHERE language = ? LIMIT ?");
    $stmt->execute([$language, $limit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get cultural information for a specific country and topic
 */
function getCulturalInfo($country, $topic) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT description FROM cultural_info WHERE country = ? AND topic = ?");
    $stmt->execute([$country, $topic]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['description'] : null;
}

/**
 * Get upcoming festivals
 */
function getUpcomingFestivals($limit = 5) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM festivals WHERE date >= CURDATE() ORDER BY date ASC LIMIT ?");
    $stmt->execute([$limit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Format festival information for display
 */
function formatFestivalInfo($festival) {
    return [
        'name' => $festival['name'],
        'country' => $festival['country'],
        'date' => formatDate($festival['date']),
        'description' => $festival['description']
    ];
}

/**
 * Check if the input is a question
 */
function isQuestion($input) {
    return preg_match('/\?$|^(what|who|where|when|why|how)/i', $input);
}

/**
 * Extract keywords from user input
 */
function extractKeywords($input) {
    $words = explode(' ', strtolower($input));
    $stopWords = ['the', 'a', 'an', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by'];
    return array_diff($words, $stopWords);
}
?> 