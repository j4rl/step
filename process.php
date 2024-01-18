<?php
// Anslut till din databas här

// Hämta valda användare från POST-data
$selectedUsers = $_POST['selected_users'] ?? [];

// Skapa en array för att lagra unika userid
$selectedUserIds = [];

// Loopa igenom valda användare och lägg till deras userid i arrayen
foreach ($selectedUsers as $userId) {
    $selectedUserIds[] = (int)$userId; // Förhindra SQL-injektion genom att konvertera till heltal
}

// Stäng anslutningen till databasen

// Visa resultatet
echo '<h1>Valda användar-IDs:</h1>';
echo '<pre>';
print_r($selectedUserIds);
echo '</pre>';
?>
