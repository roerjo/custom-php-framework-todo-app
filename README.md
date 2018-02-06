# Todo App

This is a custom PHP MVC framework I'm working on. CRUD functions are currently working. Wanted to build a framework to get an idea of how Laravel's works. Check it out at http://todo.roerjo.me

A .env file will need to be created with the following attributes:

DATABASE

DATABASE_USER

DATABASE_PASSWD

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

![Alt text](/screenshots/todoMain.png)
