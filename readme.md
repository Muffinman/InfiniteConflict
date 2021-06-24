InfiniteConflict
================

Tick Based Strategy Game

Background
---------

The principle of IC was born from a project called [TurnEngine](http://www.turnengine.com/forums/). Who's creators, although very talented, had little will to maintain the project and keep their user base happy.

TurnEngine attempted to remove the complexity from creating a turn (actually 'tick') based strategy game, by creating a layer of abstraction below the game code, which handled all the common tasks that any tick-based game might want to perform. Requiring the game designer to merely define the units/structures, and generate set of rules and boundaries within the game to operate in.

Using this technique they rebuilt their already popular game [DarkGalaxy](http://www.darkgalaxy.com) on top of TurnEngine, and to great success ran 5 or 6 rounds of the game on this code. At it's peak the game had about 30000 players, of which maybe 10000 were active.

Unfortunately the developers gave up on the project claiming that it was too difficult to maintain and too time-consuming to administrate the game. Even though numerous community members, including myself, offered to help both admin the game and develop the code, all offers were rejected, and the game was closed down indefinitely.

Recently, the original developers have tried to resurrect the game, and even run a few rounds on some slightly different code. Although again, development does seem to have slowed/stopped in recent months.

Idea
----

IC was started with the same concept, allow users to create great games with minimum effort, by writing a core code and allowing developers to either integrate directly with it, or extend it to suit their needs.

This example game is a clone of the original DarkGalaxy game concept, with some much-needed improvements and modifications, built on top of the Laravel. It has built as headless API, allowing mobile or web apps to easily integrate with it.

Built on top of Laravel and using queued jobs for the majority of the heavy lift processing, the project should be horizontally scalable to large numbers of users/planets with relative ease. It can also be easily hosted on containerised hosting to allow auto-scaling if demand grows.

System Requirements
-------------------

* **Apache 2/NGINX Webserver**
* **PHP 7.4+**
* **MySQL/MariaDB**
* **Redis (for queues)**

Newer versions of the above should work, these are just the minimum.

Development setup
-------------------

```bash
# Install
composer install
php artisan migrate:fresh --seed
npm install

# Develop / build frontend
npm run watch

# Run Queues
php artisan horizon

# Test
php artisan test
```

Development Hints
-----------------

This project is built as a headless web app, the frontend will be separated into a separate repo once development starts on that properly.

Areas of Active Development
--------------------------

* API Endpoints - *in progress*
* API Docs - *in progress*
* Turn update jobs - *in progress*


License
-------

The InfiniteConflict framework is open-sourced software licensed under the MIT license.
