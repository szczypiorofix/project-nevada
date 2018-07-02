# Tequila Platformer

## Spis treści

1. [Co to za gra?](projekt/tequila#cotozagra)
2. [Wątek główny](projekt/tequila#watekglowny)
3. [Cele gry](projekt/tequila#celegry)
4. [Kryształy Mocy](projekt/tequila#krysztalymocy)
5. [Niebezpieczeństwa](projekt/tequila#niebezpieczenstwa)
6. [Główne cechy](projekt/tequila#cechy)
7. [Biblioteki](projekt/tequila#biblioteki)
8. [Assety](projekt/tequila#assety)
9. [Najlepsze wyniki](projekt/tequila#wyniki)
10. [Programy](projekt/tequila#programy)
11. [Media](projekt/tequila#media)
12. [Linki](projekt/tequila#linki)


## Co to za gra?<a name="cotozagra"></a>

Tequila Platformer it's a side-scrolling platform game. It's supposed to be easy, simple and pleasant.

## Wątek główny<a name="watekglowny"></a>

The main character of the game is a farmer named Marcello, who's trying to find his lost goat - Matilda. When Matilda disappeared, Marcello, disregarding the dangers, decides to find his pet and bring her back home.

## Cele gry<a name="celegry"></a>

The main goal of the game is to complete all 11 levels and bring Matilda back home.
The second goal of the game is to gain points by collecting coins, drinking Tequilas, eating Tacos and collecting Power Gems.
Sometimes, you loose your point when hit by Spikes, Bees, Thumbleweeds and by spikes throwed by Angry Cactus.
Marcello begins his journey with 5 points of Health.
When his Health reach 0 - Marcello dies and the player has to restart the current level.
At the end of each level the player has to write down his name. His name and score are stored in the **Hall of Fame**


### Jak grać?

How to play? It's simple, just run, jump, drink Tequilas and eat Tacos. Watch out for dangerous spikes, Angry Cactuses and other dangerous things.
        But, don't let Marcello eat too much Tacos. It's makes him overweighted for a while, so he can't jump high when he's overweighted.
        There are 2 powerups in the game:
        
        Tequila - makes Marcello jump higher temporary.
        Taco - recovers 1 point of Health & makes Marcello overweighted for a while.
        
            
    <h2 id="tppowergems">Power Gems</h2>
    <hr />
    <p>Power Gems are special collectibles (they are spawned in random areas on current level).
    They allow Marcello to use some of special "powers" like regenerate his health etc.
    To activate each of abilities you need to collect 5 (or more) Power Gems of each power you want to use.
    The use of current power costs 5 Power Gems.</p>
	
	<p>Power Gems types and powers:</p>

	<ul>
		<li><span style="color:crimson;">red</span> - regenerates 1 point of health</li>
		<li><span style="color:limegreen;">green</span> - increase 1 point of maximum health</li>
		<li><span style="color:cyan;">celadon</span> - regenerates full health</li>
		<li><span style="color:lightskyblue;">blue</span> - temporary invulnerability</li>
		<li><span style="color:yellow;">yellow</span> - removes all bees on current level</li>
		<li><span style="color:mediumpurple;">violet</span> - removes all cactuses on current level</li>
		<li><span style="color:violet;">pink</span> - removes all enemies (bees, cactuses, tumbleweends) on current level</li>
	</ul><p> </p>

	<h2 id="tpdangers">Dangers</h2>
	<hr />
	<ul>
            <li>water - unfortunately, Marcello can't swim</li>
            <li>Bees - can sting</li>
            <li>Angry Cactuses - can shot needles</li>
            <li>Tumbleweeds - can spin around and harm Marcello</li>
        </ul><p> <br></p>
	
	<h2 id="tpmainfeatures">Main features</h2>
	<hr />
	<ul>
        <li>100% Java</li>
        <li>100% free</li>
        <li>Mexican vibe</li>
        <li>11 levels</li>
        <li>nice music</li>
        <li>collectibles</li>
        <li>Power Gems</li>
        <li>unlockable levels</li>
        <li>achievements system</li>
        <li>global best scores (Hall of Fame)</li>
        <li>english & polish language</li>
	</ul><p> </p>

	<h2 id="tplibraries">Additional libraries</h2><hr />
	<ul>
            <li>JLayer (1.0.1) - support for .mp3 files</li>
            <li><del>JInput (2.0.5) - gamepad support</del>
              - gamepad support is not fully available<del><br /></del></li>
            <li><del>MySQL Connector (ver. 5.1.39) - JDBC driver for MySQL database</del> Since 1.01 version the game connects with database by PHP script
                , not client-server app based by sockets connection.</li>
	</ul><p> </p>

	<h2 id="tpassets">Assets</h2>
	<hr />
        <p>A several free assets are used in this game:</p>
	<ul>
            <li>graphics & music from <a href="https://www.opengameart.org">opengameart.org</a> and <a href="http://www.gameart2d.com">gameart2d.com</a>.</li>
            <li>some of the graphics was made (eg Power Gems, birds in main menu, floating letters, tumbleweeds) or modified
                    (eg moving platforms, airplane, cactuses) by me.</li>
            <li>Cowboy Hippie Pro and Smokun fonts are from <a href="https://www.fontsquirrel.com">www.fontsquirrel.com</a></li>
	</ul><p> </p>

	<h2 id="tpbestscores">Best Scores</h2>
	<hr />
	$bestScoresContent
	<br>

	<h2 id="tpprograms">Programs & Tools</h2><hr />
	<ul>
            <li>Eclipse Neon JEE</li>
            <li>GIMP</li>
            <li>Inkscape</li>
            <li>Paint.NET</li>
            <li>Git (Bitbucket)</li>
	</ul>
	<br>

	<h2 id="tpscreenshots">Screenshots : </h2><hr />

	{$imagesSlider}
        
        <br>
	<h2 id="tpvideo">Latest video:</h2><hr />
	<div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/fqqohkISWI4"></iframe>
	</div><br>
        
        <br>
	<h2>Progress :</h2><hr />
	<div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/playlist?list=PLd5riWaV_JX_aIHMNUsPY4_wLiKkPbqhQ"></iframe>
	</div><br>

	<h2 id="tplinks">Links :</h2><hr />
	<div class="btn-group" style="margin-bottom: 10px;">
            <a class="btn btn-danger" href="download/tp.rar">DOWNLOAD</a>
            <a class="btn btn-info" href="http://warsztat.gd/projects/Tequila_Platformer">Project on warsztat.gd</a>
            <a class="btn btn-warning" href="http://forum.warsztat.gd/index.php?topic=30878.0">Project on warsztat.gd forum</a>
            <a class="btn btn-primary" href="https://szczypiorofix.itch.io/tequilaplatformer">Project on ITCH.IO</a>
	</div>
    </div>