<details>
   <summary>1) Create Table</summary>
   
      CREATE TABLE `userTable` (
        `id` int(10) NOT NULL,
        `name` varchar(100) NOT NULL,
        `gender` varchar(100) NOT NULL,
        `phone` varchar(100) NOT NULL
      )
      
      ENGINE=InnoDB DEFAULT CHARSET=latin1;

      ALTER TABLE `userTable`
      ADD PRIMARY KEY (`id`);

      ALTER TABLE `userTable`
      MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;   
</details>

<details>
	<summary>2) Create project folder [Run this command]</summary>

	composer require fzaninotto/faker
</details>

<details>
	<summary>3) Insert this code on [index.php]</summary>

	<?php
		require_once 'vendor/autoload.php';
		$faker = Faker\Factory::create();
		$conn =mysqli_connect('localhost','root','','hrm');

		foreach (range(1, 10) as $value){
			$gender = $faker->randomElement(['Male', 'Female', 'Other']);
			$sql ="insert into userTable values (null,'$faker->name','$gender','$faker->phoneNumber')";
			$result = mysqli_query($conn, $sql);
		}
</details>

<details>
	<summary>Code Source</summary>
		<a href="https://github.com/fzaninotto/Faker">Github link</a>
		<br>
		<a href="https://www.youtube.com/watch?v=sSDh1zfz-5s&ab_channel=1BestCsharpblog">Youtube link</a>
</details>
