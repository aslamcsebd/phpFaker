<?php

	require_once 'vendor/autoload.php';
	$faker = Faker\Factory::create();
	//$conn =mysqli_connect('localhost', 'root', '', 'hrm');
	$conn =mysqli_connect('localhost', 'userName', 'password', 'dbName');	

	$loop = 1;
	foreach (range(1, 10) as $value){
		$gender = $faker->randomElement(['Male', 'Female', 'Other']);
		$sql ="insert into userTable values (null,'$faker->name','$gender','$faker->phoneNumber')";
		$result = mysqli_query($conn, $sql);

		if ($loop==1 && $result){
			echo "Insert Successfully...";
		}elseif($loop==1 && !$result){
			echo "Insert Fail...";
		}
		$loop++;
	}