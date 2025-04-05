<?php
header('Content-Type: application/json');
require_once 'db_config.php';
require_once 'functions.php';

try {
    // Get upcoming festivals
    $festivals = getUpcomingFestivals(5);
    
    // Format festival data
    $formattedFestivals = array_map('formatFestivalInfo', $festivals);
    
    // Return JSON response
    echo json_encode($formattedFestivals);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch festival data']);
}
?> 