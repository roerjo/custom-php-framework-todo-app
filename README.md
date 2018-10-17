# Todo App

This is a custom PHP MVC framework I'm working on. CRUD functions are currently working. Wanted to build a framework to get an idea of how Laravel's works. Check it out at http://todo.roerjo.me

A .env file will need to be created with the following attributes:

- APP_DEBUG // boolean
- BASE_URI  // used to setup the client in the tests (I use localhost:8000)
- DATABASE  // database to be used
- DATABASE_USER // authorized db user
- DATABASE_PASSWORD // db user passowrd

Within your database run the following SQL script:

```
CREATE TABLE IF NOT EXISTS `todo`.`tasks` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL,
  `description` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `completed` TINYINT(4) NOT NULL,
  `dateEntered` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL,
  `dateCompleted` VARCHAR(45) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
```

Locally, I run `php -S localhost:8000` in the public directory. Be sure to
match your local server with the BASE_URI you have set if you want tests
to pass.

![Alt text](/screenshots/todoMain.png)
