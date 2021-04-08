<?php

require __DIR__ . '/vendor/autoload.php';

use Faker\Factory;
use Source\Models\User;

$faker = Factory::create("pt-br");
$users = (new User())->find()->fetch(true);

if(!$users):
    for($i=0; $i < 2; $i++):
        $user = new User();
        $user->first_name = $faker->firstName;
        $user->last_name = $faker->lastName;
        $user->email = $faker->email;
        $user->passwd = password_hash($faker->password, PASSWORD_DEFAULT);
        $user->save();
    endfor;
    
    echo "<h3>{$i} usuários cadastrados!</h3>";
else:
    echo "<h3>Usuários:</h3>";

    foreach ($users as $user):
        $user->first_name = $faker->firstName;
        $user->last_name = $faker->lastName;
        $user->save();
        var_dump($user->data());
    endforeach;
    
    $userSave = new User();
    $userSave->first_name = "Cristovão";
    $userSave->last_name = "Lira Braga";
    $userSave->email = "ml.manutencaolira@gmail.com";
    $userSave->passwd = password_hash($faker->password, PASSWORD_DEFAULT);
    $save = $userSave->save();
    
    if($save):
        var_dump($userSave);
    else:
        echo "<h1>{$userSave->fail()->getMessage()}</h1>";
    endif;
    
endif;