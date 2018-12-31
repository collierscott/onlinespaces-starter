## The Project

This is a starter project for projects using symfony 4.

### To Get Started

- Download or clone this repository.
- cd into the project directory.
- Copy .env into .env.local and update settings.
- Run the following commands:
```
$ composer install
$ yarn dev
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
$ php bin/console doctrine:fixtures:load
```

## TODO

There is still a lot of work needed for this project. This is meant only as a 
starter project.

Here is a partial list of things needed (in no particular order):

- Testing (Need to setup Behat and write tests).
- Users should be able to log in using Facebook and Google+.
- Users should be able to like and unlike articles.
- Users should be able to view another users profile
- A better way to upload user avatars is needed.
- Users other than Admins should be able to create articles.
- Users should be able to follow other users.
- Admins should be able to add menus and menu items
- Admins should be able to update all settings and store in database.
- All settings should be read from the database. Settings in .env should only be used for 
data fixtures and/or backup if database value does not exist.
- Much more...
