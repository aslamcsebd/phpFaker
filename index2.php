<?php
	
	//Big sql
	require_once 'vendor/autoload.php';
	$faker = Faker\Factory::create();
	$conn =mysqli_connect('localhost', 'userName', 'password', 'dbName');

	foreach (range(1, 50) as $value){
		$dob = $faker->date($format = 'Y-m-d', $max = '1995-01-01');
		$gender = $faker->randomElement(['Male', 'Female', 'Other']);
		$bloodGroup = $faker->randomElement(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-']);
		$education = $faker->randomElement(['SSC', 'HSC', 'CSE', 'EEE', 'BBA', 'Law', 'MBA', 'ENG']);
		$jobPost = $faker->randomElement([
			'Web Developer', 
			'Software Developer',
			'Database Administrator',
			'Systems Analyst',
			'Security Analyst',
			'Network Architect',
			'IT Project Manager'
		]);

		/*Create nice random password
		$faker->password;*/
		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$shuffled = str_shuffle($str);
		$password = substr($shuffled, 1, 8);

		$sql = "insert into employeeTable values (
			null,
			'$faker->name',
			'$dob',
			'$gender',
			'$faker->phoneNumber',
			'$faker->email',
			'$bloodGroup',
			'$education',
			'$faker->address',
			'$password',
			'$jobPost',
			''
		)";
		$result = mysqli_query($conn, $sql);
	}

	echo "Insert Successfully";
