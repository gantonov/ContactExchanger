<?php
require 'config/globals.php';
$con = mysql_connect(_DB_SERVER_,_DB_USERNAME_,_DB_PASSWORD_);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
else echo "login successful <br>";

mysql_select_db(_DB_, $con);

$QUERIES[] = "CREATE TABLE "._DB_PREFIX_."user
(
	id_user int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id_user),
	name varchar(30) NOT NULL,
	email varchar(50) NOT NULL UNIQUE,
	password varchar(40) NOT NULL
) ENGINE=InnoDB
";

$QUERIES[] = "CREATE TABLE "._DB_PREFIX_."contact_group
(
	id_contact_group int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id_contact_group),
	name varchar(30) NOT NULL
) ENGINE=InnoDB
";

$QUERIES[] = "CREATE TABLE "._DB_PREFIX_."shareing
(
	id_user int NOT NULL,
	FOREIGN KEY (id_user) REFERENCES "._DB_PREFIX_."user(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
	id_contact_group int NOT NULL,
	FOREIGN KEY (id_contact_group) REFERENCES "._DB_PREFIX_."contact_group(id_contact_group) ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY (id_user,id_contact_group),
	permissions int(2) NOT NULL
) ENGINE=InnoDB
";

$QUERIES[] = "CREATE TABLE "._DB_PREFIX_."contact
(
	id_contact int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id_contact),
	first_name varchar(30) NOT NULL,
	last_name varchar(30)
) ENGINE=InnoDB
";

$QUERIES[] = "CREATE TABLE "._DB_PREFIX_."contact_in_group
(
	id_contact int,
	FOREIGN KEY (id_contact) REFERENCES "._DB_PREFIX_."contact(id_contact) ON DELETE CASCADE ON UPDATE CASCADE,
	id_contact_group int,
	FOREIGN KEY (id_contact_group) REFERENCES "._DB_PREFIX_."contact_group(id_contact_group) ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY (id_contact, id_contact_group)
) ENGINE=InnoDB
";

$QUERIES[] = "CREATE TABLE "._DB_PREFIX_."phone_number
(
	id_phone_number int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id_phone_number),
	id_contact int NOT NULL,
	FOREIGN KEY (id_contact) REFERENCES "._DB_PREFIX_."contact(id_contact) ON DELETE CASCADE ON UPDATE CASCADE,
	type varchar(20) NOT NULL,
	number varchar(20) NOT NULL,
	preferable BOOLEAN NOT NULL DEFAULT 0
) ENGINE=InnoDB
";

$QUERIES[] = "CREATE TABLE "._DB_PREFIX_."email
(
	id_email int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id_email),
	id_contact int NOT NULL,
	FOREIGN KEY (id_contact) REFERENCES "._DB_PREFIX_."contact(id_contact) ON DELETE CASCADE ON UPDATE CASCADE,
	type varchar(20) NOT NULL,
	email varchar(30) NOT NULL,
	preferable BOOLEAN NOT NULL DEFAULT 0
) ENGINE=InnoDB
";

$QUERIES[] = "CREATE TABLE "._DB_PREFIX_."im
(
	id_im int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id_im),
	id_contact int NOT NULL,
	FOREIGN KEY (id_contact) REFERENCES "._DB_PREFIX_."contact(id_contact) ON DELETE CASCADE ON UPDATE CASCADE,
	type varchar(20) NOT NULL,
	value varchar(30) NOT NULL
) ENGINE=InnoDB
";

// Execute queries
$err = false;
foreach ($QUERIES as $query){
   if(!mysql_query($query,$con)){
      $err = true;
	  echo "<pre>";
      echo mysql_error();
	  echo "</pre>";
   }
}
mysql_close($con);

if(!$err) 
	echo "Database successfully created <br>";