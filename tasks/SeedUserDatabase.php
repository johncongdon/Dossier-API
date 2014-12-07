<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once "phing/Task.php";

class SeedUserDatabase extends Task
{
	private $numUsers;

    private $faker;

    public function setNumUsers($num)
    {
        $this->numUsers = intval($num);
    }

    public function init()
    {
        Dotenv::load(__DIR__ . '/../');
        $this->faker = Faker\Factory::create();
		$this->pdo = new \PDO(
            'mysql:hostname='.getenv('DB_HOST') . ';dbname='.getenv('DB_NAME'),
            getenv('DB_USER'),
            getenv('DB_PASSWORD')
        );

		$this->numUsers = 50;
    }

    public function main()
    {
        $this->populateUsers();
    }

    private function populateUsers()
    {
		print "Populating Users\n";
        for ($i = 0; $i < $this->numUsers; $i++) {
            $userDetails = [
                'id' => $this->createHash(),
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'email' => $this->faker->email,
                'password' => password_hash("P@ssw0rd", PASSWORD_DEFAULT)
            ];
            $query = "INSERT INTO `speakers` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES (:id, :first_name, :last_name, :email, :password)";
            $statement = $this->pdo->prepare($query);
            $statement->execute($userDetails);
        }
    }

    private function createHash()
    {
        $parts = md5(uniqid('', TRUE));
        $parts .= md5(microtime());
        $parts .= md5(rand());
        for ($i=0; $i < 16; $i++) {
            $parts = str_shuffle($parts);
        }

        return substr($parts, 0, 10);
    }
}
