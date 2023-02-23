<?php

use Database\DBConnection;

require_once __DIR__ . '/../vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

$db = new DBConnection('spies', 'localhost', 'root', 'root');

$db->getPDO()->exec('SET FOREIGN_KEY_CHECKS = 0');

//$db->getPDO()->exec('TRUNCATE TABLE admin');
//$db->getPDO()->exec('TRUNCATE TABLE agents');
//$db->getPDO()->exec('TRUNCATE TABLE contacts');
//$db->getPDO()->exec('TRUNCATE TABLE targets');
//$db->getPDO()->exec('TRUNCATE TABLE hideouts');
//$db->getPDO()->exec('TRUNCATE TABLE status');
//$db->getPDO()->exec('TRUNCATE TABLE specialities');
//$db->getPDO()->exec('TRUNCATE TABLE types_hideouts');
//$db->getPDO()->exec('TRUNCATE TABLE types_missions');
$db->getPDO()->exec('TRUNCATE TABLE missions');
$db->getPDO()->exec('TRUNCATE TABLE country_mission');
$db->getPDO()->exec('SET FOREIGN_KEY_CHECKS = 1');


$missions = [];

for ($i = 0; $i < 30; $i++) {
    $db->getPDO()->exec("INSERT INTO missions SET 
                         title = '$faker->word, $faker->word',
                         description = '$faker->paragraph(3)',
                         nickname = '$faker->userName',
                         created_at = '$faker->date',
                         closed_at = '$faker->date' ");
    $missions[] = $db->getPDO()->lastInsertId();
}
foreach ($missions as $mission) {
    $randomMissions = $faker->randomElements($missions, rand(1, 2));
    foreach ($randomMissions as $randomMission) {
        $db->getPDO()->exec("INSERT INTO country_mission SET mission_id=$mission, country_id=$randomMission");
    }
}

$password = password_hash('admin', PASSWORD_BCRYPT);
$db->getPDO()->exec("INSERT INTO users SET lastname='Doe', firstname='John', email='john@doe.com', password='$password', created_at='$faker->date'");
