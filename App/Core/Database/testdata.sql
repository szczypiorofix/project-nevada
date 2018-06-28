/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Piotrek
 * Created: 2018-04-20
 */

--
-- Zrzut danych tabeli `posts`
--
SET NAMES 'utf8';
SET CHARACTER SET 'UTF8';

INSERT INTO `posts` (`id`, `title`, `content`, `url`, `image`, `image_description`, `insert_date`, `update_date`) VALUES
(1, 'Reaktywacja mojej strony', '###Reaktywacja mojej strony po raz drugi!\r\n\r\n####To już drugi raz kiedy tworzę moją stronę zupełnie od zera. Tym razem mam nadzieję, że wszystko pójdzie zgodnie z planem i tak jak sobie założyłem.\r\n\r\n##Trzymajcie kciuki!\r\n', 'reaktywacja-mojej-strony', 'default.jpg', 'Opis obrazka', '2017-03-06 11:43:21', '2018-04-20 13:53:07'),
(3, 'Tequila Platformer - game development', '### Tequila Platformer - Visualization of the project creation process.\r\nSoftware: Gource\r\n\r\n1 second representate 1 day of development of Tequila Platformer game.\r\n', 'tequila-platformer---game-development', 'tp-gource.jpg', 'Opis obrazka', '2017-03-07 09:46:08', '2018-04-20 10:31:58'),
(4, 'New project - Cave Generator', '### Cave Generator\r\nI added a new project : Cave Generator. It&#39;s a simple cave level generator, based on Cellular Automaton\r\n\r\nAlgorithm is not so perfect but it should work. I&#39;ll modify this project soon.\r\nPreviously I made this project in Java language but now I decided to make in with jQuery and put it on my website.\r\n\r\nYou can test it here.', 'new-project---cave-generator', 'cavegen1.png', 'opis', '2017-03-22 21:42:54', '2018-04-20 10:33:23'),
(6, 'Making your own game experience - Commonwealth Rebuild Fallout Twine story', '## Making your own game experience - Fallout Twine story.\r\n\r\nIt&#39;s my first story game made in Twine.\r\nIt&#39;s not a typical &#34;story&#34; game but rather management game.\r\nThis game is inspired by the Fallout series (mostly by Fallout 4).\r\nYou can go to a several locations, which can be typical locations with some resoruces/enemies or a locations with workshop located on it. On locations with workshop you can build some facilities like beds, water pomps, power generators and crops fields. Every locations has a &#34;danger&#34; factor, which means that you can be attacked by a weaker or stronger enemies.\r\nIf player&#39;s health will drop down to 0 - the game is over.\r\nTip: there&#39;s a small quest in the Museum of Freedom in Concord location. The treasure will help you fight some tougher enemies ;)\r\nUnfortunately, it&#39;s in polish only (but in the future I think I&#39;ll make it in english).\r\n\r\nThe game is in development right now, so it can be (and I truly believe it is) unbalanced and some features might not work as intended but I think it&#39;s worth trying.\r\n\r\nYOU CAN PLAY THIS GAME HERE!', 'making-your-own-game-experience---commonwealth-rebuild-fallout-twine-story', 'commonwealth.png', 'Commonwealth Rebuild Fallout Twine story', '2017-05-05 15:23:51', '2018-04-20 10:35:00'),
(8, 'Commonwealth Rebuild - update', '### Commonwealth Rebuild - update.\r\nChange log:\r\n- english translation\r\n- optimized figths - more ballanced, when you decide to run away - the health you can loose depends on the enemies you have encountered.\r\n- stimpaks - now you can use a stimpak to restore a part of your health. You can use it in &#34;Character&#34; menu.\r\n- when you are passing the locations your health now slowny regenerates.\r\n- some minor changes\r\n\r\nYou can play this game HERE !', 'commonwealth-rebuild---update', 'commonwealth.png', 'Commonwealth Rebuild - update', '2017-05-11 12:40:34', '2018-04-20 10:35:56'),
(9, 'Fury Road - my first JavaScript game', '###&#34;Fury Road&#34; - My first game made in JavaScript.\r\n\r\nAfter a few day of working with Twine software I decided to make something in JavaScript, and learn a little bit of course.\r\n\r\nThis is my first game, made in JavaScript. I&#39;ts mainly a text game.\r\n\r\nThe main goal of this game is to drive as long as you can through a post-apocalyptic world full of danger. You can spot a lot of things, fight with various group of raiders. You need to watch for your resources: water and food, and fuel of course. You can find some scrap while wandering. It&#39;s valuable and you can buy some resources, repair and upgrade your car.\r\n\r\nYou will die, for sure, but how long can you survive?\r\n\r\nCheck this game **[HERE](../furyroad)**.', 'fury-road---my-first-javascript-game', 'furyroadscreenshot.png', 'Fury Road - my first JavaScript game', '2017-05-18 15:22:54', '2018-04-20 11:28:18'),
(10, 'Fury Road - update', '###Fury Road - update\r\nChange log:\r\n\r\n* major visual changes: added new background, changes in UI\r\n* now the game is realy playable, some of the events are interactive (work in progress)\r\n* now you can visit a village that you spot on the road, in the villages you can repair, refuel or buy upgrades for you car\r\n* more balanced raider fights\r\nadded music in the background (now you can set the volume or turn if off, this setting are stored in your browser&#39;s local storage)\r\nadded High Scores - when the game ends (fuel, shields, food or water reached 0) you can input your name to the High Scores. Your overall distance will be put in the  High Scores (it&#39;s stored in your browser&#39;s local storage). You can clear the scores also.\r\n\r\nMore changes will be coming soon...\r\nCHECK THE GAME', 'fury-road---update', 'furyroad.png', 'Fury Road - update', '2017-05-30 12:40:12', '2018-04-20 11:25:44'),
(11, 'Space Invaders - new game made in JS', '###Space Invaders - simple Space Invaders remake, made in JavaScript.\r\n\r\nThis is the beginning of this project. I decided to use an additional library - PIXI.JS.\r\n\r\nYou can check it [HERE](../spaceinvaders/).', 'space-invaders---new-game-made-in-js', 'si.png', 'Space Invaders - new game made in JS', '2017-05-30 12:45:58', '2018-04-20 11:21:46'),
(12, 'Space Invaders - update', '###Space Invaders - update!\r\n\r\nUpdate change log:\r\n* changes in control - now you can control the ship by your mouse.\r\n* added more aliens, they can shot you by a plasma missile\r\n* after cleaning the level you can go to the next level, where aliens move and shot faster.\r\n* added moving background.\r\n\r\n\r\nYou can play the game **HERE**', 'space-invaders---update', 'si.png', 'Space Invaders - update', '2017-05-31 15:45:08', '2018-04-20 11:20:47'),
(13, 'Space Invaders - update 2', '### Space Invaders - Update 2 ! There are some major and minor changes\r\n\r\nChange log:\r\n* added Main Menu - there are only &#39;Play&#39; and &#39;Help&#39; buttons working (more functionality soon).\r\n* added Help in Main Menu - if you still don&#39;t know how to play this game ;)\r\n* added old school music from .mod file (Chiptune2 JS).\r\n* button &#39;Restart&#39; and &#39;Next level&#39; has been removed, now when level is finished the ship goes up and game restarts with the next level. If the player fails, there is a 3 seconds delay and next, the game &#39;goes&#39; to Main Menu\r\n* added another variation of alien.\r\n\r\nYou can check the game **HERE**!.', 'space-invaders---update-2', 'si-update.png', 'Space Invaders - update 2', '2017-06-05 15:25:02', '2018-04-20 11:19:56'),
(14, 'Space Invaders - update 3', '###Space Invaders - update 3.\r\nChange log:\r\n\r\n* changes in gameplay: now the spaceship can only move horizontally, in the bottom of the screen\r\n* &#39;lives&#39; has been changed to &#39;shields&#39; with some graphic representation\r\n* added shields (some kind of ... I don&#39;t know, let&#39;s call it just &#39;shields&#39;) before the spaceship, now the player can hide behind these shields, but they are destructible, and they don&#39;t last for long.\r\n* added first power-up! It&#39;s partial regeneration of spaceship shields. No shooting, just grab it.\r\n* when your spaceship is destroyed you can put your name in the High Scores (it&#39;s your own scores, saved in the browser locar storage).\r\n\r\nPlay the game **HERE** !', 'space-invaders---update-3', 'si-update3.png', 'This is the 3rd update of my approach to a classic game - Space Invaders.', '2017-06-12 12:22:08', '2018-04-20 11:13:34'),
(16, 'New project - Blackboard', '###Blackboard - new project.\r\n\r\nIt&#39;s a simple online blackboard - you can draw something, in real time. You can draw alone or with someone else, it&#39;s up to you! It can be a little bit funny.\r\n\r\nI made it in vanilla JavaScript.\r\n\r\nAdditional library: [Simplify.js](http://mourner.github.io/simplify-js/), by [Vladimir Agafonkin](http://agafonkin.com/en) to reduce amount of data wchich are sent by server.\r\n\r\nYou can check it **HERE**!', 'new-project---blackboard', 'blackboard1.png', 'It&#39;s a simple online blackboard.', '2017-06-14 16:09:39', '2018-04-20 10:55:02'),
(17, 'My own version of TypedJS library', '###MyTypedJS\r\n\r\nThis is my own version of TypedJS library by Matt Boldt [Typed JS](http://www.mattboldt.com/demos/typed-js/).\r\n\r\nThis library allow to print all given sentences, letter by letter, with given speed.\r\nIt looks like someone is typing on the website.\r\n\r\nYou can check it **HERE**', 'my-own-version-of-typedjs-library', 'mytypedjs1.png', 'MyTypedJS - this is my own version of TypedJS library by Matt Boldt ', '2017-06-22 23:13:03', '2018-04-20 10:50:56'),
(18, 'Using Trello API as a change log for one of my projects', '### Using [Trello API](https://developers.trello.com/) and one of my lists on Trello as a change log of Space Invaders.\r\n\r\n\r\nI decided to use Trello API and one of my list as a change log to show progress of Space Invaders project directly on my website.\r\n\r\nThis is not a real change log of my project, but I use it on development to test different features e.g. cards, names, descriptions of cards, check lists etc.. I plan to add such a feature to all of my projects, so changes on each particular project on Trello cards will be visible on my website.\r\n\r\nAlso, there is a fancy spinner added when there&#39;s need to wait for data from Trello.\r\n\r\nYou can check it **HERE**.', 'using-trello-api-as-a-change-log-for-one-of-my-projects', 'phptrelloapi1.png', 'I&#39;m just testing Trello API.', '2017-06-22 23:34:54', '2018-04-20 10:49:11'),
(19, 'A week with API - 1. GOG API', '##I tried GOG API just for fun.\r\n\r\nFor now, I can get some information about particular games from [GOG](https://www.gog.com).\r\n\r\n**HERE** are some basic information about &#34;The Elder Scrolls III: Morrowind GOTY Edition&#34; game.', 'a-week-with-api---1-gog-api', 'gogapi1.png', 'I&#39;m just testing GOG API. Just for fun.', '2017-06-28 16:15:47', '2018-04-20 10:47:27'),
(20, 'A week with API - 2. SteamWeb API', '###Now it&#39;s time to test SteamWeb API.\r\n\r\nI made my own Steam profile page. It consists a basic information about my Steam profile with 3 the most played games in last two weeks, with hours played and unlocked achievements.\r\n\r\nYou can check it **HERE**.', 'a-week-with-api---2-steamweb-api', 'steamapi1.png', 'This is my approach to SteamWeb API.', '2017-06-28 16:23:31', '2018-04-20 10:45:53'),
(21, 'Nowy tytuł!', '##To zupełnie nowy post o niczym.\r\n', 'nowy-tytul', 'shoutbox1.png', 'blabl bla1', '2017-06-28 16:40:35', '2018-04-20 10:45:20'),
(22, 'Simple JS Routing System', '###I made a simple routing system with JavaScript.\r\n\r\nYou can check it **HERE**\r\n', 'simple-js-routing-system', 'routing1.png', 'This is a simple routing system, made with JavaScript.', '2017-06-29 15:32:41', '2018-04-20 10:44:50'),
(23, 'Demo template', 'This is my new template, just for testing.\r\n**HERE**', 'demo-template', 'demot_template_1.png', 'This is my new demo template.', '2017-08-07 08:54:36', '2018-04-20 10:43:40'),
(24, 'Unique Code Generator', '###Unique Code Generator\r\nI have created a simple unique code generator.\r\n\r\nThis application creates a number of unique alphanumeric codes.\r\n\r\nAs a parameter you can set the number of codes to generate, number of letters in the code and a HTML element to show the results.\r\n\r\nGenerated codes are always unique.\r\n\r\nProject on GitHub: **CodeGenerator**\r\n\r\nYou can check it **HERE**', 'unique-code-generator', 'codegenerator1.png', 'This application creates a number of unique alphanumeric codes.', '2017-09-01 15:09:00', '2018-04-20 10:41:11'),
(25, 'Kanciarz - currency converter', '###Kanciarz\r\n####This app it&#39;s a simple currency converter.\r\n\r\nIt use [Open Exchange Rates](https://openexchangerates.org) API to get rates of 168 the most common currencies in the world.\r\n\r\nSimply choose a currency from the top-down list and enter the amount of money and the calculated rates of this currency will be shown in the table below.\r\n\r\nProject on GitHub: **Kanciarz**\r\n\r\nYou can check this app **HERE**.', 'kanciarz---currency-converter', 'kanciarz1.png', 'It&#39;s a simple currency converter.', '2017-09-01 15:20:04', '2018-04-20 11:29:39'),
(26, 'Real-time chat made in Node.JS and Socket.io', '###Real-time chat made in Node.JS and Socket.io\r\nThis is simple real-time chat application, made in node + socket.io with socket-based streaming music in background.\r\nYou can chat with another people and listen to good old Christmas (some of them) music.\r\n\r\nYou can see it HERE.', 'real-time-chat-made-in-nodejs-and-socketio', 'socketiochat1.png', 'Socket.IO Chat', '2018-01-04 15:07:26', '2018-04-20 10:37:59'),
(27, 'Kanciarz - currency converter update', '###Kanciarz - currency converter update!\r\n\r\nChangelog:\r\n\r\n- added CRON jobs to obtain data from API once a day\r\n- the goal of the cron job now is to obtain data from OpenExchangeRates and write it into database\r\n- significant performance increase due to getting data from database.\r\n\r\n\r\nYou can try it out HERE.', 'kanciarz---currency-converter-update', 'kanciarz1.png', 'Kanciarz - currency converter', '2018-01-04 15:20:20', '2018-04-20 10:37:33'),
(28, 'Prognoza pogody', '##Prognoza pogody\r\nAplikacja prognozy pogody pobiera informacje o pogodzie dla 10 miast na terenie Polski.\r\n\r\nWięcej informacji można uzyskać po najechaniu kursorem myszki nad wybrane miasto.\r\n\r\nDane aktualizowane są za pomocą zadań crona co 3 godziny.\r\n\r\n\r\n_Sprawdź to_ **tutaj**', 'prognoza-pogody', 'code.jpeg', 'Prognoza pogody na terenie Polski', '2018-01-04 15:32:53', '2018-04-18 14:20:56'),
(29, 'To jest zupełnie nowy post', '### Tak na serio to jest tylko temp.\r\n\r\n\r\nsdas', 'to-jest-zupelnie-nowy-post', 'default.jpg', '', '2018-04-20 13:54:04', '2018-04-20 13:54:04');

-- --------------------------------------------------------



--
-- Zrzut danych tabeli `post_categories`
--

INSERT INTO `post_categories` (`id`, `categoryid`, `postid`) VALUES
(1, 4, 1),
(3, 5, 3),
(4, 5, 4),
(6, 1, 6),
(8, 1, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 3, 14),
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
(28, 5, 28),
(29, 5, 29);

-- --------------------------------------------------------

INSERT INTO `post_tags` (`id`, `tagid`, `postid`) VALUES
(322, 4, 28),
(323, 10, 28),
(324, 12, 28),
(325, 14, 28),
(340, 2, 3),
(341, 3, 3),
(342, 8, 3),
(343, 3, 4),
(344, 4, 4),
(345, 7, 4),
(346, 9, 4),
(347, 10, 4),
(348, 3, 6),
(349, 4, 6),
(350, 27, 6),
(351, 3, 8),
(352, 4, 8),
(353, 27, 8),
(354, 4, 27),
(355, 5, 27),
(356, 9, 27),
(357, 4, 26),
(358, 9, 26),
(361, 4, 24),
(362, 7, 24),
(363, 9, 24),
(364, 4, 23),
(365, 7, 23),
(366, 9, 23),
(367, 4, 22),
(368, 7, 22),
(369, 9, 22),
(370, 4, 21),
(371, 5, 21),
(372, 6, 21),
(373, 7, 21),
(374, 9, 21),
(375, 4, 20),
(376, 5, 20),
(377, 9, 20),
(378, 4, 19),
(379, 5, 19),
(380, 9, 19),
(384, 4, 18),
(385, 5, 18),
(386, 9, 18),
(387, 4, 17),
(388, 9, 17),
(389, 2, 16),
(390, 4, 16),
(391, 7, 16),
(392, 9, 16),
(393, 12, 16),
(394, 3, 14),
(395, 4, 14),
(396, 7, 14),
(397, 9, 14),
(398, 15, 14),
(399, 3, 13),
(400, 4, 13),
(401, 7, 13),
(402, 9, 13),
(403, 15, 13),
(404, 3, 12),
(405, 4, 12),
(406, 7, 12),
(407, 9, 12),
(408, 15, 12),
(409, 3, 11),
(410, 4, 11),
(411, 7, 11),
(412, 9, 11),
(423, 3, 10),
(424, 4, 10),
(425, 7, 10),
(426, 9, 10),
(427, 15, 10),
(433, 3, 9),
(434, 4, 9),
(435, 7, 9),
(436, 9, 9),
(437, 15, 9),
(438, 4, 25),
(439, 9, 25),
(444, 2, 1),
(445, 17, 1),
(446, 2, 29),
(447, 11, 29);
