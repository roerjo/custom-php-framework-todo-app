# Todo App

This is a custom PHP MVC framework I'm working on. CRUD functions are currently working. Wanted to build a framework to get an idea of how Laravel's works. Check it out at http://todo.roerjo.me

## Requirements
- MySQL
- Composer

## Installation

- Setup the .env file:
  - APP_DEBUG // boolean
  - BASE_URI  // used to setup the client in the tests (I use localhost:8000)
  - DATABASE  // database to be used
  - DATABASE_USER // authorized db user
  - DATABASE_PASSWORD // db user passowrd

- Setup the database:

  - Create new database called 'todo'
  - Create the tasks table by running the following script:

```sql
CREATE TABLE IF NOT EXISTS `todo`.`tasks` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL,
  `description` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `completed` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `completed_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`)
);
```

- Install the vendor packages:

```bash
composer install
```

Locally, I run `php -S localhost:8000` in the public directory. Be sure to
match your local server with the BASE_URI you have set if you want tests
to pass.

![Alt text](/screenshots/todoMain.png)
