<?php
/**
 * API Functions for Cultural Exchange Bot
 */

function getCountryInfo($country) {
    $url = "https://restcountries.com/v3.1/name/" . urlencode($country);
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function getCulturalInfo($country) {
    // Sample cultural information (in a real project, this would come from a cultural API)
    $culturalData = [
        'japan' => [
            'culture' => 'Japanese culture is known for its emphasis on harmony, respect, and tradition. The concept of "wa" (harmony) is central to Japanese society.',
            'traditions' => 'Traditional Japanese customs include tea ceremonies, flower arranging (ikebana), and calligraphy.',
            'food' => 'Japanese cuisine features sushi, tempura, and ramen, with emphasis on fresh ingredients and presentation.',
            'festivals' => 'Major festivals include Cherry Blossom Festival, Tanabata, and Obon.'
        ],
        'india' => [
            'culture' => 'Indian culture is one of the oldest and most diverse in the world, with rich traditions in art, music, and philosophy.',
            'traditions' => 'Traditional practices include yoga, meditation, and various religious ceremonies.',
            'food' => 'Indian cuisine is known for its spices, curries, and diverse regional dishes.',
            'festivals' => 'Major festivals include Diwali, Holi, and Eid.'
        ],
        'mexico' => [
            'culture' => 'Mexican culture is a vibrant blend of indigenous and Spanish influences.',
            'traditions' => 'Traditional celebrations include Day of the Dead, Quinceañera, and various religious festivals.',
            'food' => 'Mexican cuisine features tacos, enchiladas, and mole, with emphasis on corn and chili peppers.',
            'festivals' => 'Major festivals include Day of the Dead, Cinco de Mayo, and Independence Day.'
        ],
        'france' => [
            'culture' => 'French culture is known for its art, fashion, cuisine, and intellectual traditions.',
            'traditions' => 'Traditional customs include wine tasting, cheese making, and various cultural festivals.',
            'food' => 'French cuisine is famous for its pastries, cheeses, and fine dining traditions.',
            'festivals' => 'Major festivals include Bastille Day, Cannes Film Festival, and Tour de France.'
        ]
    ];

    $country = strtolower($country);
    return isset($culturalData[$country]) ? $culturalData[$country] : null;
}

function getFestivalInfo() {
    // Sample festival data (in a real project, this would come from a festival API)
    return [
        [
            'name' => 'Chinese New Year',
            'country' => 'China',
            'date' => '2024-02-10',
            'description' => 'The most important traditional festival in China, celebrating the beginning of the lunar new year.'
        ],
        [
            'name' => 'Cherry Blossom Festival',
            'country' => 'Japan',
            'date' => '2024-03-20',
            'description' => 'Celebration of spring with cherry blossoms, traditional performances, and cultural activities.'
        ],
        [
            'name' => 'Bastille Day',
            'country' => 'France',
            'date' => '2024-07-14',
            'description' => 'National celebration marking the French Revolution with parades and fireworks.'
        ],
        [
            'name' => 'Oktoberfest',
            'country' => 'Germany',
            'date' => '2024-09-21',
            'description' => 'The world\'s largest beer festival and traveling funfair.'
        ],
        [
            'name' => 'Day of the Dead',
            'country' => 'Mexico',
            'date' => '2024-11-01',
            'description' => 'Traditional celebration honoring deceased loved ones with altars and festivities.'
        ],
        [
            'name' => 'Diwali',
            'country' => 'India',
            'date' => '2024-11-12',
            'description' => 'Festival of lights celebrating the victory of light over darkness.'
        ]
    ];
}

function getLanguagePhrases($language) {
    // Sample language phrases (in a real project, this would come from a language API)
    $phrases = [
        'japanese' => [
            ['phrase' => 'こんにちは', 'translation' => 'Hello'],
            ['phrase' => 'ありがとう', 'translation' => 'Thank you'],
            ['phrase' => 'さようなら', 'translation' => 'Goodbye']
        ],
        'french' => [
            ['phrase' => 'Bonjour', 'translation' => 'Hello'],
            ['phrase' => 'Merci', 'translation' => 'Thank you'],
            ['phrase' => 'Au revoir', 'translation' => 'Goodbye']
        ],
        'hindi' => [
            ['phrase' => 'नमस्ते', 'translation' => 'Hello'],
            ['phrase' => 'धन्यवाद', 'translation' => 'Thank you'],
            ['phrase' => 'अलविदा', 'translation' => 'Goodbye']
        ],
        'spanish' => [
            ['phrase' => 'Hola', 'translation' => 'Hello'],
            ['phrase' => 'Gracias', 'translation' => 'Thank you'],
            ['phrase' => 'Adiós', 'translation' => 'Goodbye']
        ]
    ];

    $language = strtolower($language);
    return isset($phrases[$language]) ? $phrases[$language] : null;
}
?> 