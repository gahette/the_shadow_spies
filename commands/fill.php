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
$db->getPDO()->exec('SET FOREIGN_KEY_CHECKS = 1');


for ($i = 0; $i < 30; $i++) {
    $db->getPDO()->exec("INSERT INTO missions SET 
                         title = '$faker->word',
                         description = '$faker->paragraph',
                         nickname = '$faker->userName',
                         created_at = '$faker->date',
                         closed_at = '$faker->date' ");
}