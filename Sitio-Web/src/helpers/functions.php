<?php 
    $config = require __DIR__.'/../config/config.php';
    define('BASE_PATH', $config['base_url']);
    define('ASSETS_PATH', $config['assets_url']);
    define('SRC_PATH', $config['src_url']);

    function getNewArt() {
        return [
            [
                'image' => 'newArtItem (1).png',
                'description' => 'Bufanda delgada de ojos, Algodón.',
                'price' => '$100.00 MXN'
            ],
            [
                'image' => 'newArtItem (2).png',
                'description' => 'Cajita organizadora, Algodón.',
                'price' => '$55.00 MXN'
            ],
            [
                'image' => 'newArtItem (3).png',
                'description' => 'Moño pequeño azul, Algodón.',
                'price' => '$40.00 MXN'
            ],
            [
                'image' => 'newArtItem (4).png',
                'description' => 'Sombrero con diseño, Algodón.',
                'price' => '$70.00 MXN'
            ],
            [
                'image' => 'newArtItem (5).png',
                'description' => 'Rosa individual, Algodón.',
                'price' => '$55.00 MXN'
            ],
            [
                'image' => 'newArtItem (3).png',
                'description' => 'Moño pequeño azul, Algodón.',
                'price' => '$40.00 MXN'
            ],
            [
                'image' => 'newArtItem (3).png',
                'description' => 'Moño pequeño azul, Algodón.',
                'price' => '$40.00 MXN'
            ]
        ];
    }

    function getBestSellingArt() {
        return [
            [
                'image' => 'bestSellingArt (1).png',
                'description' => 'Set de guantes para horno, Algodón.',
                'price' => '$70.00 MXN'
            ],
            [
                'image' => 'bestSellingArt (2).png',
                'description' => 'Amigurumi de Coraje, Algodón.',
                'price' => '$72.00 MXN'
            ],
            [
                'image' => 'bestSellingArt (3).png',
                'description' => 'Organizador de cables de manzana, Algodón.',
                'price' => '$45.00 MXN'
            ],
            [
                'image' => 'bestSellingArt (4).png',
                'description' => 'Amigurumi de Mike Wazowski, Algodón.',
                'price' => '$78.00 MXN'
            ],
            [
                'image' => 'bestSellingArt (5).png',
                'description' => 'Porta botellas con lazo, Algodón.',
                'price' => '$55.00 MXN'
            ],
            [
                'image' => 'bestSellingArt (3).png',
                'description' => 'Organizador de cables de manzana, Algodón.',
                'price' => '$45.00 MXN'
            ],
            [
                'image' => 'bestSellingArt (3).png',
                'description' => 'Organizador de cables de manzana, Algodón.',
                'price' => '$45.00 MXN'
            ]
        ];
    }

    function getSeasonalArt() {
        return [
            [
                'image' => 'seasonArtItem (1).png',
                'description' => 'Ramo de tulipanes y flores, Algodón.',
                'price' => '$85.00 MXN'
            ],
            [
                'image' => 'seasonArtItem (2).png',
                'description' => 'Bolsa de estrella de rayas, Algodón.',
                'price' => '$150.00 MXN'
            ],
            [
                'image' => 'seasonArtItem (3).png',
                'description' => 'Bolsa cangurera, Algodón.',
                'price' => '$60.00 MXN'
            ],
            [
                'image' => 'seasonArtItem (4).png',
                'description' => 'Funda de laptop, Algodón.',
                'price' => '$50.00 MXN'
            ],
            [
                'image' => 'seasonArtItem (5).png',
                'description' => 'Bolsa tejida a rayas, Algodón.',
                'price' => '$120.00 MXN'
            ],
            [
                'image' => 'seasonArtItem (2).png',
                'description' => 'Bolsa cangurera, Algodón.',
                'price' => '$60.00 MXN'
            ],
            [
                'image' => 'seasonArtItem (2).png',
                'description' => 'Bolsa cangurera, Algodón.',
                'price' => '$60.00 MXN'
            ]
        ];
    }
?>