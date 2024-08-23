<?php
// users.php

function getUsersList() {
    // Example array of users with hashed passwords
    // In a real-world scenario, these would be fetched from a database
    return [
        'user1' => '$2y$10$exampleHash1', // Hashed password for user1
        'user2' => '$2y$10$exampleHash2', // Hashed password for user2
        // Add more users as needed
    ];
}
?>