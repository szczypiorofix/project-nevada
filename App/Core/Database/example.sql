/* 
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */
/**
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 * Created: 2018-03-13
 */


/* ###### PRZYKŁADOWE WARTOŚCI ######## */
/**
-------------------------- SETTINGS --------------------------
*/
SET NAMES 'utf8';
SET CHARACTER SET 'UTF8';
-- SET FOREIGN_KEY_CHECKS = 0;



/**
-------------------------- CONFIG --------------------------
*/
INSERT INTO
    `config` (`name`, `value`, `update_time`, `previous_value`)
VALUES
    ('Author', 'Wróblewski Piotr', NOW(), ' ');



/**
-------------------------- CATEGORIES --------------------------
*/
INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'programowanie'),
(2, 'grafika'),
(3, 'gry'),
(4, 'informacje'),
(5, 'projekty');


/**
-------------------------- TAGS --------------------------
*/
INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Android'),
(2, 'info'),
(3, 'game'),
(4, 'web'),
(5, 'PHP'),
(6, 'MySQL'),
(7, 'CSS'),
(8, 'Java'),
(9, 'JavaScript'),
(10, 'jQuery'),
(11, 'desktop'),
(12, 'software'),
(13, 'phone'),
(14, 'hardware'),
(15, 'pixel-art'),
(16, 'Bootstrap'),
(17, 'important'),
(18, 'C#'),
(19, 'C'),
(20, 'pico-8'),
(21, 'Unity3D'),
(22, 'UE4'),
(23, 'GameMaker'),
(24, 'Articy-Draft'),
(25, 'Hexels'),
(26, 'Star Wars'),
(27, 'Twine');



/**
-------------------------- POSTS --------------------------
*/

INSERT INTO `posts` (`id`, `title`, `content`, `url`, `image`, `image_description`, `insert_date`, `update_date`) VALUES
(1, 'Reaktywacja strony', '<p>My website has been reactivated.</p>\r\n<p>I create my website by myself, without Wordpress. I hope I\'ll learn a lot of PHP, jQuery etc.</p>', 'website-reactivation', 'default.jpg', '', '2017-03-06 11:43:21', '2017-04-10 15:16:45'),
(2, 'Tequila Platformer - update 1.01', '<p><strong>Tequila Platformer - update&nbsp;1.01&nbsp; (build 49).</strong></p>\r\n<p>The main update: modified connection with external database.</p>\r\n<p>Previously it was another java app, constantly run on my server and sometimes it wasn\'t working poperly. After this update the game communicates with the database by PHP script and&nbsp;it should work better now.</p>\r\n<p>Minor changes:</p>\r\n<ul>\r\n<li>more forgiving&nbsp;collisions between objects</li>\r\n<li>Angry Cactuses don\'t shoot needles immediately after they spot a player but after a short while</li>\r\n<li>added <em><strong>Date</strong></em>&nbsp;(in game and in database as well) column. Now there is known who and mainly when put their score on database. All scores before this update has the same date, because I can\'t remember who and when put their score and that feature wasn\'t implemented in the previous version of connector app.</li>\r\n<li>colors of Power Gems was a little bit modified for a better look and distinction.</li>\r\n</ul>\r\n<p>You can download current version <a href=\"http://www.wroblewskipiotr.pl/download\">here</a>.</p>\r\n<p><a href=\"http://www.wroblewskipiotr.pl/project/tequila\">More info about the game</a>.</p>\r\n<p>&nbsp;</p>', 'tequila-platformer---update-101', 'tequila - logo.png', '', '2017-03-06 20:37:11', '2017-04-18 12:55:53'),
(3, 'Tequila Platformer - game development', '<h3>Tequila Platformer - Visualization of the project creation process.</h3>\r\n<p>Software:&nbsp;<a href=\"http://gource.io/\">Gource</a>.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><iframe src=\"//www.youtube.com/embed/Rq4HHPhnNgY\" width=\"560\" height=\"314\" allowfullscreen=\"allowfullscreen\"></iframe></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\">1 second representate 1 day of development of Tequila Platformer game.</p>\r\n<p>&nbsp;</p>', 'tequila-platformer---game-development', 'tp-gource.jpg', '', '2017-03-07 09:46:08', '2017-04-18 12:59:19'),
(4, 'New project - Cave Generator', '<p>I added a new project : Cave Generator. It\'s a simple cave level generator, based on <a href=\"https://en.wikipedia.org/wiki/Cellular_automaton\" target=\"_blank\" rel=\"noopener noreferrer\">Cellular Automaton</a>.</p>\r\n<p>Algorithm is not so perfect but it should work. I\'ll modify this project soon.</p>\r\n<p>Previously I made this project in Java language but now I decided to make in with jQuery and put it on my website.</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"../project/cavegen\" target=\"_blank\" rel=\"noopener noreferrer\">You can test it here</a>.</p>', 'new-project---cave-generator', 'cavegen1.png', '', '2017-03-22 21:42:54', '2017-04-18 13:03:47'),
(5, 'Star Wars The Last Jedi Official Teaser', '<p>Star Wars The Last Jedi Official Teaser:</p>\r\n<p><iframe src=\"//www.youtube.com/embed/zB4I68XVPzQ\" width=\"560\" height=\"314\" allowfullscreen=\"allowfullscreen\"></iframe></p>\r\n<p>Poster:</p>\r\n<p><img class=\"img-responsive\" src=\"../media/images/poster.jpg\" alt=\"\" width=\"800\" height=\"1186\" /></p>', 'star-wars-the-last-jedi-official-teaser', 'sw-the-last-jedi-tall-1200x630.jpg', '', '2017-04-19 10:58:28', '2017-04-19 10:58:28'),
(6, 'Making your own game experience - Commonwealth Rebuild Fallout Twine story', '<h2>Making your own game experience - Fallout Twine story.</h2>\r\n<p>It\'s my first story game made in <a href=\"https://twinery.org/\">Twine</a>.</p>\r\n<p>It\'s not a typical \"story\" game but rather management game.</p>\r\n<p>This game is inspired by the Fallout series (mostly by Fallout 4).</p>\r\n<p>You can go to a several locations, which can be typical locations with some resoruces/enemies or a locations with workshop located on it. On locations with workshop you can build some facilities like beds, water pomps, power generators and crops fields. Every locations has a \"danger\" factor, which means that you can be attacked by a weaker or stronger enemies.</p>\r\n<p>If player\'s health will drop down to 0 - the game is over.</p>\r\n<p>Tip: there\'s a small quest in the Museum of Freedom in Concord location. The treasure will help you fight some tougher enemies ;)</p>\r\n<p>Unfortunately, it\'s in polish only (but in the future I think I\'ll make it in english).</p>\r\n<p>&nbsp;</p>\r\n<p>The game is in development right now, so it can be (and I truly believe it is) unbalanced and some features might not work as intended but I think it\'s worth trying.</p>\r\n<p><a href=\"../twine\">YOU CAN PLAY THIS GAME HERE!</a></p>', 'making-your-own-game-experience---commonwealth-rebuild-fallout-twine-story', 'commonwealth.png', '', '2017-05-05 15:23:51', '2017-05-10 14:31:07'),
(8, 'Commonwealth Rebuild - update', '<p>Commonwealth Rebuild - update.</p>\r\n<p>Change log:</p>\r\n<p>- english translation</p>\r\n<p>- optimized figths - more ballanced, when you decide to run away - the health you can loose depends on the enemies you have encountered.</p>\r\n<p>- stimpaks - now you can use a stimpak to restore a part of your health. You can use it in \"Character\" menu.</p>\r\n<p>&nbsp;- when you are passing the locations your health now slowny regenerates.</p>\r\n<p>- some minor changes</p>\r\n<p>You can play this game <a href=\"http://www.wroblewskipiotr.pl/twine\">HERE </a>!</p>', 'commonwealth-rebuild---update', 'commonwealth.png', '', '2017-05-11 12:40:34', '2017-05-11 12:48:01'),
(9, 'Fury Road - my first JavaScript game', '<h3>\"Fury Road\" - My first game made in JavaScript.</h3>\r\n<p>After a few day of working with Twine software I decided to make something in JavaScript, and learn a little bit of course.</p>\r\n<p>This is my first game, made in JavaScript. I\'ts mainly a text game.</p>\r\n<p>The main goal of this game is to drive as long as you can through a post-apocalyptic world full of danger. You can spot a lot of things, fight with various group of raiders. You need to watch for your resources: water and food, and fuel of course. You can find some scrap while wandering. It\'s valuable and you can buy some resources, repair and upgrade your car.</p>\r\n<p>You will die, for sure, but how long can you survive?</p>\r\n<p>Check this game <a href=\"../furyroad/\">HERE!</a></p>', 'fury-road---my-first-javascript-game', 'furyroadscreenshot.png', '', '2017-05-18 15:22:54', '2017-05-18 15:22:54'),
(10, 'Fury Road - update', '<p>Change log:</p>\r\n<ul>\r\n<li>major visual changes: added new background, changes in UI</li>\r\n<li>now the game is realy playable, some of the events are interactive (work in progress)</li>\r\n<li>now you can visit a village that you spot on the road, in the villages you can repair, refuel or buy upgrades for you car</li>\r\n<li>more balanced raider fights</li>\r\n<li>added music in the background (now you can set the volume or turn if off, this setting are stored in your browser\'s local storage)</li>\r\n<li>added High Scores - when the game ends (fuel, shields, food or water reached 0) you can input your name to the High Scores. Your overall distance will be put in the &nbsp;High Scores (it\'s stored in your browser\'s local storage). You can clear the scores also.</li>\r\n</ul>\r\n<p>More changes will be coming soon...</p>\r\n<p><a title=\"Fury Road\" href=\"../furyroad/\">CHECK THE GAME</a></p>', 'fury-road---update', 'furyroad.png', '', '2017-05-30 12:40:12', '2017-05-30 12:40:12'),
(11, 'Space Invaders - nowa gra napisana w JavaScript', '<p>Space Invaders - simple Space Invaders remake, made in JavaScript.</p>\r\n<p>This is the beginning of this project. I decided to use an additional library - <a title=\"PIXI.JS\" href=\"http://www.pixijs.com/\">PIXI.JS</a>.</p>\r\n<p>You can check it <a title=\"Space Invaders\" href=\"../spaceinvaders/\">HERE</a>.</p>', 'space-invaders---new-game-made-in-js', 'si.png', '', '2017-05-30 12:45:58', '2017-05-30 12:45:58'),
(12, 'Space Invaders - aktualizacja 1', '<h3>Space Invaders - update!&nbsp;</h3>\r\n<p>Update change log:</p>\r\n<ul>\r\n<li>changes in control - now you can control the ship by your mouse.</li>\r\n<li>added more aliens, they can shot you by a plasma missile</li>\r\n<li>after cleaning the level you can go to the next level, where aliens move and shot faster.</li>\r\n<li>added moving background.</li>\r\n</ul>\r\n<p>You can play the game <a href=\"../spaceinvaders/\">HERE</a>.</p>', 'space-invaders---update', 'si.png', '', '2017-05-31 15:45:08', '2017-05-31 15:47:04'),
(13, 'Space Invaders - aktualizacja 2', '<p>Space Invaders - Update 2 ! There are some major and minor changes.</p>\r\n<p>Change log:</p>\r\n<ul>\r\n<li>added Main Menu - there are&nbsp;only \'Play\' and \'Help\' buttons working (more functionality soon).</li>\r\n<li>added Help in Main Menu - if you still don\'t know how to play this game ;)</li>\r\n<li>added old school music from .mod file (Chiptune2 JS).</li>\r\n<li>button \'Restart\' and \'Next level\' has been removed, now when level is finished the ship goes up and game restarts with the next level. If the player fails, there is a 3 seconds delay and next, the game \'goes\' to Main Menu</li>\r\n<li>added another variation of alien.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>You can check the game <a title=\"Space Invaders\" href=\"../spaceinvaders/\" target=\"_blank\" rel=\"noopener noreferrer\">HERE</a>!.</p>', 'space-invaders---update-2', 'si-update.png', '', '2017-06-05 15:25:02', '2017-06-05 15:44:39'),
(14, 'Space Invaders - aktualizacja 3', '<h3>Space Invaders - update 3.</h3>\r\n<p>Change log:</p>\r\n<ul>\r\n<li>changes in gameplay: now the spaceship can only move horizontally, in the bottom of the screen</li>\r\n<li>\'lives\' has been changed to \'shields\' with some graphic representation</li>\r\n<li>added shields (some kind of ... I don\'t know, let\'s call it just \'shields\') before the spaceship, now the player can hide behind these shields, but they are destructible, and they don\'t last for long.</li>\r\n<li>added first power-up! It\'s partial regeneration of spaceship shields. No shooting, just grab it.</li>\r\n<li>when your spaceship is destroyed you can put your name in the High Scores (it\'s your own scores, saved in the browser locar storage).</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3>Play the game&nbsp;<strong><a href=\"../spaceinvaders/\">HERE</a></strong> !</h3>', 'space-invaders---update-3', 'si-update3.png', 'This is the 3rd update of my approach to a classic game - Space Invaders.', '2017-06-12 12:22:08', '2017-06-12 12:24:34'),
(15, 'Wąż - gra', '<p>Now it\'s time for a classic game!</p>\r\n<h3><br />The Snake!</h3>\r\n<p><br />This is my another game, made in JavaScript.</p>\r\n<p>It\'s very, very simple.</p>\r\n<p>You can check it <a href=\"../snake\"><strong>here</strong></a>.</p>', 'snake-game', 'snake1.png', 'I tried to make a classic snake game in JS.', '2017-06-12 12:31:46', '2017-06-12 12:31:46'),
(16, 'New project - Blackboard', '<h3>Blackboard - new project.</h3>\r\n<p>It\'s a simple online blackboard - you can draw something, in real time. You can draw alone or with someone else, it\'s up to you! It can be a little bit funny&nbsp;<img src=\"../js/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\" />.</p>\r\n<p>I made it in pure JavaScript.</p>\r\n<p>&nbsp;</p>\r\n<p>Additional library: <a href=\"http://mourner.github.io/simplify-js/\">Simplify.js</a>, by <a href=\"http://agafonkin.com/en\">Vladimir Agafonkin</a>&nbsp;to reduce amount of data&nbsp;wchich are sent by server.</p>\r\n<p>You can check it <a href=\"../blackboard/\">HERE</a>&nbsp;!</p>', 'new-project---blackboard', 'blackboard1.png', 'It\'s a simple online blackboard.', '2017-06-14 16:09:39', '2017-06-14 16:09:39'),
(17, 'My own version of TypedJS library', '<h3>MyTypedJS</h3>\r\n<p>This is my own version of TypedJS library by Matt Boldt (<a href=\"http://www.mattboldt.com/demos/typed-js/\">Typed JS</a>).</p>\r\n<p>This library allow to print all given sentences, letter by letter, with given speed.</p>\r\n<p>It looks like someone is typing on the website.</p>\r\n<p>You can check it <a href=\"../mytypedjs/\">HERE</a><strong>.</strong></p>', 'my-own-version-of-typedjs-library', 'mytypedjs1.png', 'MyTypedJS - this is my own version of TypedJS library by Matt Boldt ', '2017-06-22 23:13:03', '2017-06-22 23:13:03'),
(18, 'Using Trello API as a change log for one of my projects', '<h3>Using <a href=\"https://developers.trello.com/\">Trello API</a> and one of my lists on Trello as a change log of Space Invaders.</h3>\r\n<p>&nbsp;</p>\r\n<p>I decided to use Trello API and one of my list as a change log to show progress of Space Invaders project directly on my website.</p>\r\n<p>This is not a real change log of my project, but I use it on development to test different features e.g. cards, names, descriptions of cards, check lists etc.. I plan to add such a feature to all of my projects, so changes on each particular project on Trello cards will be visible on my website.</p>\r\n<p>Also, there is a fancy spinner added when there\'s need to wait for data from Trello.</p>\r\n<p>You can check it <a href=\"../trello/\"><strong>HERE</strong></a>.</p>', 'using-trello-api-as-a-change-log-for-one-of-my-projects', 'phptrelloapi1.png', 'I\'m just testing Trello API.', '2017-06-22 23:34:54', '2017-06-22 23:35:37'),
(19, 'A week with API - 1. GOG API', '<h3>I tried GOG API just for fun.</h3>\r\n<p>For now, I can get some information about particular games from <a href=\"https://www.gog.com\">GOG.com</a></p>\r\n<p><a title=\"HERE\" href=\"../../\"><strong>HERE</strong></a>&nbsp;are some basic information about&nbsp;\"The Elder Scrolls III: Morrowind GOTY Edition\" game.</p>', 'a-week-with-api---1-gog-api', 'gogapi1.png', 'I\'m just testing GOG API. Just for fun.', '2017-06-28 16:15:47', '2017-06-28 16:16:59'),
(20, 'A week with API - 2. SteamWeb API', '<h3>Now it\'s time to test SteamWeb API.</h3>\r\n<p>I made&nbsp;my own Steam profile page. It consists a basic information about my Steam profile with 3 the most played games in last two weeks, with hours played and unlocked achievements.</p>\r\n<p>You can check it <a title=\"HERE\" href=\"../steam\"><strong>HERE</strong></a>.</p>', 'a-week-with-api---2-steamweb-api', 'steamapi1.png', 'This is my approach to SteamWeb API.', '2017-06-28 16:23:31', '2017-06-28 16:24:01'),
(21, 'Shoutbox - new project', '<h3>Here\'s my old-new project - Shoutbox.</h3>\r\n<p>It supports BBCode like:</p>\r\n<p>[b][/b], [i][/i], [u][/u], [s][/s], [img][/img], [img=][/img], [url][/url], [url=][/url],[quote][/quote], [quote=][/quote], [code][/code], [color][/color] and [size][/size]</p>\r\n<p>Just write something&nbsp;<a title=\"HERE\" href=\"../shoutbox\"><strong>HERE</strong></a>.</p>', 'shoutbox---new-project', 'shoutbox1.png', 'This is a simple shoutbox.', '2017-06-28 16:40:35', '2017-09-07 14:49:48'),
(22, 'Simple JS Routing System', '<h3>I made a simple routing system with JavaScript.</h3>\r\n<p>You can check it <a title=\"HERE\" href=\"../router\">HERE</a>.</p>\r\n<p>How did I made it?</p>\r\n<p>Here\'s some code:</p>\r\n<p>File: index.html [part of this file]</p>\r\n<div class=\"container\">\r\n<p class=\"pagetitle\">HELLO ROUTER!</p>\r\n<a class=\"mybutton\" href=\"#content1view\">Content 1 link</a> <a class=\"mybutton\" href=\"#content2view\">Content 2 link</a> <a class=\"mybutton\" href=\"#content3view\">Content 3 link</a> <a class=\"mybutton\" href=\"#content4view\">Content 4 link</a>\r\n<div id=\"routerdiv\">&nbsp;</div>\r\n</div>\r\n<div class=\"views\">\r\n<div id=\"content1view\"><!-- FIRST CONTENT --></div>\r\n<div id=\"content2view\"><!-- SECOND CONTENT --></div>\r\n<div id=\"content3view\"><!-- THIRD CONTENT --></div>\r\n<div id=\"content4view\"><!-- FOURTH CONTENT --></div>\r\n</div>\r\n<p>File: js/script.js:</p>\r\n<pre class=\"language-markup\"><code>var Router = {\r\n    element: null,\r\n    parameters: [],\r\n    fragment: null,\r\n    views: [],\r\n    lasturl: \'\',\r\n    url: \'\',\r\n    defaultPageContent: \'</code></pre>\r\n<h3>Default Content...\', loadDefaultContent: true, loadContentOnStart: true, init: function(element) { var self = this; self.lasturl = window.location.href; this.element = document.getElementById(element); setInterval(function() { self.geturl(); }, 100); }, addView: function(p) { this.views.push(p); return this; }, geturl: function() { this.url = window.location.href; this.fragment = this.url.match(/#(.*)/); if (this.fragment === null) this.fragment = \'\'; this.parameters = (this.fragment ? this.fragment[1] : \'\').split(\'/\'); if (this.lasturl !== this.url || this.loadContentOnStart) { for (i = 0; i &lt; this.views.length; i++) { if (this.parameters[0] === this.views[i]) { this.loadDefaultContent = false; this.loadContentOnStart = false; console.log(\'Content changed!\'); this.lasturl = this.url; this.element.innerHTML = document.getElementById(this.views[i]).innerHTML; } } } if (this.loadDefaultContent || this.parameters[0] === \'\') { this.element.innerHTML = this.defaultPageContent; } } }; Router.init(\'routerdiv\'); Router.addView(\'content1view\') .addView(\'content2view\') .addView(\'content3view\') .addView(\'content4view\');</h3>\r\n<p>File: style.css:</p>\r\n<pre class=\"language-css\"><code>@import url(\'https://fonts.googleapis.com/css?family=Lato\');\r\n\r\nhtml, body {\r\n    font-family: \'Lato\', sans-serif;\r\n    background-color: #111111;\r\n    color: #ddd;\r\n}\r\n\r\n.container {\r\n    border: 1px solid black;\r\n    background-color: #2d2d2d;\r\n    width: 80%;\r\n    height: auto;\r\n    margin: 0 auto;\r\n    padding: 15px;\r\n}\r\n\r\np {\r\n    font-size: 18px;\r\n}\r\n\r\na {\r\n    text-decoration: none;\r\n    color: #7675f5;\r\n}\r\n\r\n.pagetitle {\r\n    font-size: 72px;\r\n    text-align: center;\r\n    text-transform: uppercase;\r\n    color: #202020;\r\n    background-color: #2d2d2d;\r\n    letter-spacing: .1em;\r\n    text-shadow: \r\n      -1px -1px 1px #111, \r\n      2px 2px 1px #363636;\r\n}\r\n\r\n.views {\r\n    display: none;\r\n}\r\n\r\n#routerdiv &gt; h3 {\r\n    color:#99e;\r\n}\r\n\r\n.mybutton {\r\n    background-color: #556;\r\n    color: #eee;\r\n    padding: 10px;\r\n    border: none;\r\n    border-radius: 3px;\r\n    display: inline-block;\r\n    box-shadow:\r\n        2px 2px 2px #334;\r\n}\r\n\r\n.mybutton:hover {\r\n    \r\n    background: #445;\r\n    color: #ddd;\r\n    -ms-transform: translate(0, 1px); /* IE 9 */\r\n    -webkit-transform: translate(0, 1px); /* Safari */\r\n    transform: translate(0, 1px);\r\n}\r\n\r\n.mybutton:active {\r\n    -ms-transform: translate(0, 2px); /* IE 9 */\r\n    -webkit-transform: translate(0, 2px); /* Safari */\r\n    transform: translate(0, 2px);\r\n}</code></pre>', 'simple-js-routing-system', 'routing1.png', 'This is a simple routing system, made with JavaScript.', '2017-06-29 15:32:41', '2017-09-07 14:48:48'),
(23, 'Demo template', '<p>This is my new template, just for testing.</p>\r\n<p>You can check it <a href=\"../demo/\"><strong>HERE</strong></a>.</p>', 'demo-template', 'demot_template_1.png', 'This is my new demo template. Just for testing.', '2017-08-07 08:54:36', '2017-09-07 14:47:26'),
(24, 'Unique Code Generator', '<p>I created a simple unique code generator.</p>\r\n<p>This application creates a number of unique alphanumeric codes.</p>\r\n<p>As a parameter you can set the number of codes to generate, number of letters in the code and a HTML element to show the results.</p>\r\n<p>Generated codes are always unique.</p>\r\n<p>Project on GitHub: <strong><span style=\"color: #ff9900;\"><a style=\"color: #ff9900;\" href=\"https://szczypiorofix.github.io/CodeGenerator/\" target=\"_blank\" rel=\"noopener noreferrer\">CodeGenerator</a></span>.</strong></p>\r\n<p>You can check it <span style=\"color: #ff9900;\"><strong><a style=\"color: #ff9900;\" href=\"../codegenerator\">HERE</a></strong></span></p>', 'unique-code-generator', 'codegenerator1.png', 'This application creates a number of unique alphanumeric codes.', '2017-09-01 15:09:00', '2017-09-07 14:45:50'),
(25, 'Kanciarz - kalkulator walut', '<h2>Kanciarz</h2>\r\n<h3>This app it\'s a simple currency converter.</h3>\r\n<p>It use <a href=\"https://openexchangerates.org\">https://openexchangerates.org</a> API to get rates of 168&nbsp;the most common currencies in the world.</p>\r\n<p>Simply choose a currency from the top-down list and enter the amount of money and the calculated rates of this currency will be shown in the table below.</p>\r\n<p>&nbsp;</p>\r\n<p>Project on GitHub: <span style=\"color: #ff9900;\"><strong><a style=\"color: #ff9900;\" href=\"https://szczypiorofix.github.io/wymianawalut/\" target=\"_blank\" rel=\"noopener noreferrer\">Kanciarz</a></strong></span></p>\r\n<p>&nbsp;</p>\r\n<p>You can check this app <span style=\"color: #ff9900;\"><a style=\"color: #ff9900;\" href=\"../kanciarz/\"><strong>HERE</strong></a></span>.</p>', 'kanciarz---currency-converter', 'kanciarz1.png', 'It\'s a simple currency converter. It use OpenExchangeRates API to get rates of 168 the most common currencies in the world.', '2017-09-01 15:20:04', '2017-09-07 14:44:20'),
(26, 'Czat - aplikacja stworzona w Node.JS i Socket.io', '<h3>This is simple real-time chat application, made in node + socket.io with socket-based streaming music in background.</h3>\r\n<p>You can chat with another people and listen to good old Christmas (some of them) music&nbsp;<img src=\"../../js/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\" /></p>\r\n<p>You can see it <span style=\"color: #333300;\"><strong><a style=\"color: #333300;\" href=\"http://node.wroblewskipiotr.pl/\" target=\"_blank\" rel=\"noopener noreferrer\">HERE.</a></strong></span></p>', 'real-time-chat-made-in-nodejs-and-socketio', 'socketiochat1.png', 'Socket.IO Chat', '2018-01-04 15:07:26', '2018-01-04 15:09:12'),
(27, 'Kanciarz - aktualizacja', '<h3><strong>Kanciarz</strong> - currency converter update!</h3>\r\n<p>Changelog:</p>\r\n<ul>\r\n<li>added CRON jobs to obtain data from API once a day</li>\r\n<li>the goal of the cron job now is to obtain data from OpenExchangeRates and write it into database</li>\r\n<li>significant performance increase due to getting data from database.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>You can try it out <span style=\"color: #333333;\"><strong><a style=\"color: #333333;\" href=\"../kanciarz/\" target=\"_blank\" rel=\"noopener noreferrer\">HERE</a></strong></span>.</p>', 'kanciarz---currency-converter-update', 'kanciarz1.png', 'Kanciarz - currency converter', '2018-01-04 15:20:20', '2018-01-04 15:33:43'),
(28, 'Prognoza pogody', '<h2>Prognoza pogody</h2>\r\n<p>Weather forecast for 10 big cities in Poland.</p>\r\n<p>&nbsp;</p>\r\n<p>Main features:</p>\r\n<ul>\r\n<li>10 cities</li>\r\n<li>move mouse over the city to see more details</li>\r\n<li>data are updated every 3 hours by cron jobs</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong><a href=\"../weatherforecast/\" target=\"_blank\" rel=\"noopener noreferrer\">LINK</a></strong></p>', 'weather-forecast', 'weatherforecast1.png', 'Weather Forecast in Poland', '2018-01-04 15:32:53', '2018-01-04 15:32:53');






/**
-------------------------- POST CATEGORIES --------------------------
*/
INSERT INTO `post_categories` (`id`, `categoryid`, `postid`) VALUES
(1, 4, 1),
(2, 5, 2),
(3, 5, 3),
(4, 5, 4),
(5, 4, 5),
(6, 1, 6),
(8, 1, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 3, 14),
(15, 3, 15),
(16, 5, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 5, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28);



/**
-------------------------- POST TAGS --------------------------
*/
INSERT INTO `post_tags` (`id`, `tagid`, `postid`) VALUES
(35, 17, 1),
(36, 2, 1),
(53, 11, 2),
(54, 3, 2),
(55, 2, 2),
(56, 8, 2),
(57, 3, 3),
(58, 2, 3),
(59, 8, 3),
(60, 7, 4),
(61, 3, 4),
(62, 9, 4),
(63, 10, 4),
(64, 4, 4),
(65, 26, 5),
(83, 3, 6),
(84, 27, 6),
(85, 4, 6),
(89, 3, 8),
(90, 27, 8),
(91, 4, 8),
(92, 7, 9),
(93, 3, 9),
(94, 9, 9),
(95, 15, 9),
(96, 4, 9),
(97, 7, 10),
(98, 3, 10),
(99, 9, 10),
(100, 15, 10),
(101, 4, 10),
(102, 7, 11),
(103, 3, 11),
(104, 9, 11),
(105, 4, 11),
(111, 7, 12),
(112, 3, 12),
(113, 9, 12),
(114, 15, 12),
(115, 4, 12),
(121, 7, 13),
(122, 3, 13),
(123, 9, 13),
(124, 15, 13),
(125, 4, 13),
(131, 7, 14),
(132, 3, 14),
(133, 9, 14),
(134, 15, 14),
(135, 4, 14),
(136, 3, 15),
(137, 9, 15),
(138, 4, 15),
(139, 7, 16),
(140, 2, 16),
(141, 9, 16),
(142, 12, 16),
(143, 4, 16),
(144, 9, 17),
(145, 4, 17),
(149, 9, 18),
(150, 5, 18),
(151, 4, 18),
(155, 9, 19),
(156, 5, 19),
(157, 4, 19),
(161, 9, 20),
(162, 5, 20),
(163, 4, 20),
(203, 9, 25),
(204, 4, 25),
(205, 7, 24),
(206, 9, 24),
(207, 4, 24),
(208, 7, 23),
(209, 9, 23),
(210, 4, 23),
(211, 7, 22),
(212, 9, 22),
(213, 4, 22),
(214, 7, 21),
(215, 9, 21),
(216, 6, 21),
(217, 5, 21),
(218, 4, 21),
(221, 9, 26),
(222, 4, 26),
(229, 7, 28),
(230, 9, 28),
(231, 5, 28),
(232, 4, 28),
(233, 9, 27),
(234, 5, 27),
(235, 4, 27);



/**
-------------------------- TEQUILA PLATFORMER SCORES --------------------------
*/
INSERT INTO `tequilabestscores` (`id`, `name`, `score`, `millis`, `level`, `insert_date`) VALUES
(12, 'damoch', 2050, 118720, 1, '2017-03-04 23:13:15'),
(13, 'damoch', 1955, 82000, 2, '2017-03-04 23:13:15'),
(14, '', 1465, 67184, 3, '2017-03-04 23:13:15'),
(15, '', 1960, 106288, 1, '2017-03-04 23:13:15'),
(16, '', 3975, 96608, 2, '2017-03-04 23:13:15'),
(17, '', 3445, 98176, 3, '2017-03-04 23:13:15'),
(24, 'seba', 2910, 180080, 1, '2017-03-04 23:13:15'),
(25, 'kkk', 3230, 173616, 1, '2017-03-04 23:13:15'),
(26, 'kkk', 4040, 127056, 2, '2017-03-04 23:13:15'),
(27, 'kkk', 3625, 118128, 3, '2017-03-04 23:13:15'),
(28, 'aleksandra', 3120, 155872, 1, '2017-03-04 23:13:15'),
(29, 'Karol', 2960, 198304, 1, '2017-03-04 23:13:15'),
(30, '', 3130, 192160, 1, '2017-03-04 23:13:15'),
(31, 'ochodzki', 3230, 187248, 1, '2017-03-04 23:30:31'),
(32, 'ochodzki', 3305, 192592, 1, '2017-03-05 00:14:36'),
(33, 'ochodzki', 4010, 178624, 2, '2017-03-05 00:17:44'),
(34, 'Karol', 3200, 131488, 1, '2017-03-21 15:15:11'),
(35, 'Karol', 4020, 107696, 2, '2017-03-21 15:17:04'),
(36, 'Zdzicho', 2265, 100576, 1, '2017-03-23 09:45:02'),
(37, 'Zdzich', 2790, 106736, 1, '2017-03-23 09:49:09'),
(38, 'Misiek', 2790, 73216, 4, '2017-04-18 14:36:12'),
(39, 'tomasz', 825, 94176, 1, '2017-04-26 23:36:10'),
(40, 'TOMASZ', 2475, 104864, 2, '2017-04-26 23:40:31'),
(41, 'TOMASZ', 1405, 69008, 3, '2017-04-26 23:44:04'),
(42, 'aaa', 3260, 185696, 1, '2017-04-27 15:47:00'),
(43, 'aaa', 3975, 111984, 2, '2017-04-27 15:48:57'),
(44, 'aaa', 3645, 111216, 3, '2017-04-27 15:50:54'),
(45, 'aaa', 3955, 118192, 4, '2017-04-27 15:52:58'),
(46, 'aaa', 940, 75024, 5, '2017-04-27 15:54:16'),
(47, 'Chimerian', 3310, 180592, 1, '2017-05-17 18:12:33'),
(48, 'Chimerian', 4100, 136960, 2, '2017-05-17 18:14:59'),
(49, 'Janusz', 3320, 174256, 1, '2018-01-16 13:19:21'),
(50, 'Janusz', 3820, 179408, 2, '2018-01-16 13:22:31'),
(51, 'Janusz', 3445, 115584, 3, '2018-01-16 13:36:46'),
(52, 'Janusz', 4135, 146800, 4, '2018-01-16 14:05:57'),
(53, 'Janusz', 970, 69440, 5, '2018-01-16 14:08:08'),
(54, 'Janusz', 2360, 103232, 6, '2018-01-19 00:28:23'),
(55, 'Janusz', 1865, 105776, 7, '2018-01-19 00:35:36'),
(56, 'Janusz', 3730, 181424, 8, '2018-01-22 12:59:34'),
(57, 'Janusz', 1515, 92080, 9, '2018-01-22 13:28:08');





-- SET FOREIGN_KEY_CHECKS = 1;