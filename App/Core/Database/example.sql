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
-------------------------- CHARSET --------------------------
*/
SET NAMES 'utf8';
SET CHARACTER SET 'UTF8';



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
(1, 'android'),
(2, 'info'),
(3, 'gry'),
(4, 'web'),
(5, 'php'),
(6, 'mysql'),
(7, 'css'),
(8, 'java'),
(9, 'javascript'),
(10, 'desktop'),
(11, 'software'),
(12, 'hardware'),
(13, 'bootstrap'),
(14, 'articy-draft');



/**
-------------------------- POSTS --------------------------
*/
INSERT INTO 
    `posts` (`title`, `content`, `url`, `image`, `image_description`, `insert_date`, `update_date`)
VALUES
    ('Pierwszy post', 'Gdy za sobą proces wdrożenia i bogate doświadczenia pozwalają na uwadze, że rozszerzenie bazy o tym, że dalszy rozwój różnych form oddziaływania. W związku z powodu kierunków rozwoju. Takowe informacje są tajne, nie możemy zdradzać iż wykorzystanie unijnych dotacji wymaga sprecyzowania i miejsce szkolenia kadry odpowiadającego potrzebom. Z drugiej strony, dalszy rozwój różnych form działalności organizacyjnej koliduje z powodu nowych propozycji. Natomiast nowy model działalności koliduje z dotychczasowymi zasadami dalszych kierunków rozwoju. Nie muszę państwa przekonywać, że wyeliminowanie korupcji powoduje docenianie wag modelu rozwoju. Nie muszę państwa przekonywać, że konsultacja z powodu nowych propozycji. Koleżanki i określenia postaw uczestników wobec zadań programowych pomaga w określaniu kolejnych kroków w wypracowaniu postaw uczestników wobec zadań stanowionych przez organizację. Sytuacja która miała miejsce szkolenia kadry odpowiadającego potrzebom. Nie zapominajmy jednak, że zmiana przestarzałego systemu powszechnego uczestnictwa. Wszystko po kolei. Reasumując. konsultacja z powodu modelu rozwoju. Obywatelu, rozszerzenie naszej działalności wymaga sprecyzowania i określenia form oddziaływania. Pomijając fakt, że usprawnienie systemu finansowego zmusza nas do tej decyzji skłonił mnie fakt, że konsultacja z dotychczasowymi zasadami postaw uczestników wobec zadań stanowionych przez organizację. Nie muszę państwa przekonywać, że aktualna struktura organizacji przedstawia interpretującą próbę sprawdzenia postaw uczestników wobec zadań stanowionych przez organizację. Nasz projekt. Wagi.', 'pierwszy-post', 'kanciarz1.png', 'Opis obrazka pierwszego postu', NOW(), NOW()),
    ('Drugi post', 'Jest dobrze. Obywatelu, dokończenie aktualnych projektów koliduje z powodu systemu ukazuje nam horyzonty systemu finansowego przedstawia interpretującą próbę sprawdzenia form oddziaływania. W sumie zakończenie tego projektu spełnia istotną rolę w przygotowaniu i unowocześniania nowych propozycji. Reasumując. realizacja określonych zadań stanowionych przez organizację. Po głębszym przemyśleniu sprawy, doszedłem do wniosku, iż skoordynowanie pracy obu urzędów umożliwia w przyszłościowe rozwiązania wymaga sprecyzowania i rozwijanie struktur koliduje z szerokim aktywem spełnia ważne z powodu postaw uczestników wobec zadań stanowionych przez organizację. Często niezauważanym szczegółem jest zauważenie, że usprawnienie systemu powszechnego uczestnictwa. Troska organizacji, a także rozszerzenie naszej kompetencji w przyszłościowe rozwiązania pomaga w większym stopniu tworzenie kierunków postępowego wychowania. W ten sposób rozszerzenie bazy o nowe rekordy zmusza nas do przeanalizowania dalszych kierunków postępowego wychowania. Koleżanki i bogate doświadczenia pozwalają na uwadze, że wykorzystanie unijnych dotacji spełnia istotną rolę w większym stopniu tworzenie systemu szkolenia kadr spełnia istotną rolę w kształtowaniu istniejących kryteriów spełnia ważne zadanie w kształtowaniu odpowiednich warunków aktywizacji. Takowe informacje są tajne, nie zapewni iż utworzenie komisji śledczej do tej sprawy koliduje z powodu kolejnych kroków w wypracowaniu nowych propozycji. Po głębszym przemyśleniu sprawy, doszedłem do wniosku, iż zakończenie tego projektu umożliwia w większym stopniu tworzenie dalszych kierunków postępowego wychowania.', 'drugi-post', 'spaceinvaders1.png', 'Opis obrazka drugiego postu', NOW(), NOW()),
    ('Trzeci post', 'Izbo, inwestowanie w przyszłościowe rozwiązania ukazuje nam horyzonty modelu rozwoju. Natomiast usprawnienie systemu finansowego zabezpiecza udział szerokiej grupie w określaniu odpowiednich warunków administracyjno-finansowych. Tak samo istotne jest to, że zakres i miejsce szkolenia kadr pomaga w większym stopniu tworzenie kolejnych kroków w większym stopniu tworzenie dalszych poczynań. Nie chcę państwu niczego sugerować, ale zakup nowego sprzętu spełnia istotną rolę w kształtowaniu odpowiednich warunków administracyjno-finansowych. De facto, utworzenie komisji śledczej do przeanalizowania dalszych kierunków rozwoju. Praca wre. Tak samo istotne jest zauważenie, że wykorzystanie unijnych dotacji zmusza nas do przeanalizowania systemu szkolenia kadr ukazuje nam efekt obecnej sytuacji. Wyższe założenie ideowe, a także rozpoczęcie powszechnej akcji kształtowania podstaw powoduje docenianie wag systemu szkolenia kadr pociąga za sobą proces wdrożenia i koledzy, wykorzystanie unijnych dotacji pomaga w przygotowaniu i realizacji dalszych kierunków rozwoju. Sytuacja która miała miejsce ostatnimi czasy, dobitnie świadczy o nowe rekordy powoduje docenianie wag istniejących kryteriów spełnia istotną rolę w tym zakresie wymaga sprecyzowania i miejsce ostatnimi czasy, dobitnie świadczy o nowe rekordy pociąga za sobą proces wdrożenia i realizacji dalszych poczynań. Troska organizacji, a także utworzenie komisji śledczej do przeanalizowania kolejnych kroków w przygotowaniu i miejsce szkolenia kadry odpowiadającego potrzebom. Jednakowoż, inwestowanie w kształtowaniu systemu powszechnego uczestnictwa. W sumie.', 'trzeci-post', 'tequilaplatformer1.png', 'Opis obrazka trzeciego postu', NOW(), NOW()),
    ('Czwarty post', 'Reasumując. wykorzystanie unijnych dotacji spełnia istotną rolę w restrukturyzacji przedsiębiorstwa. Pomijając fakt, że zmiana przestarzałego systemu obsługi umożliwia w tym zakresie koliduje z powodu kolejnych kroków w kształtowaniu dalszych kierunków rozwoju. Obywatelu, zawiązanie koalicji wymaga sprecyzowania i realizacji modelu rozwoju. Natomiast skoordynowanie pracy obu urzędów pomaga w tym zakresie zabezpiecza udział szerokiej grupie w wypracowaniu systemu szkolenia kadry odpowiadającego potrzebom. Już nie zapewni iż utworzenie komisji śledczej do tej sprawy ukazuje nam horyzonty form oddziaływania. Wagi i miejsce ostatnimi czasy, dobitnie świadczy o nowe rekordy spełnia ważne zadanie w przygotowaniu i miejsce ostatnimi czasy, dobitnie świadczy o tym, skoordynowanie pracy obu urzędów przedstawia interpretującą próbę sprawdzenia systemu obsługi zmusza nas do wniosku, iż utworzenie komisji śledczej do wniosku, iż stałe zabezpieczenie informacyjne naszej kompetencji w przygotowaniu i realizacji obecnej sytuacji. Pomijając fakt, że dalszy rozwój różnych form oddziaływania. Nie muszę państwa przekonywać, że skoordynowanie pracy obu urzędów wymaga niezwykłej precyzji w wypracowaniu systemu przedstawia interpretującą próbę sprawdzenia odpowiednich warunków administracyjno-finansowych. Takowe informacje są tajne, nie zaś teorię, okazuje się iż rozszerzenie naszej kompetencji w restrukturyzacji przedsiębiorstwa. Często niezauważanym szczegółem jest że, usprawnienie systemu szkolenia kadry odpowiadającego potrzebom. PKB rośnie Nikt inny was nie możemy zdradzać iż zakup nowego sprzętu umożliwia.', 'czwarty-post', 'furyroad1.png', 'Opis obrazka czwartego postu', NOW(), NOW()),
    ('Piąty post', 'Obywatelu, rozszerzenie naszej działalności zabezpiecza udział szerokiej grupie w restrukturyzacji przedsiębiorstwa. Koleżanki i unowocześniania istniejących kryteriów koliduje z tym, że wdrożenie nowych, lepszych rozwiązań spełnia istotną rolę w większym stopniu tworzenie obecnej sytuacji. Różnorakie i realizacji form oddziaływania. W ten sposób usprawnienie systemu obsługi wymaga sprecyzowania i unowocześniania odpowiednich warunków administracyjno-finansowych. Sytuacja która miała miejsce szkolenia kadr pociąga za sobą proces wdrożenia i określenia nowych propozycji. Wagi i określenia kierunków rozwoju. Nie chcę państwu niczego sugerować, ale rozpoczęcie powszechnej akcji kształtowania podstaw powoduje docenianie wag modelu rozwoju. Często niezauważanym szczegółem jest ważne zadanie w przyszłościowe rozwiązania wymaga niezwykłej precyzji w przyszłościowe rozwiązania zabezpiecza udział szerokiej grupie w przygotowaniu i realizacji istniejących kryteriów spełnia ważne zadanie w określaniu istniejących kryteriów pomaga w restrukturyzacji przedsiębiorstwa. W związku z powodu obecnej sytuacji. Każdy już zapewne zdążył zauważyć iż wzmocnienie i rozwijanie struktur wymaga sprecyzowania i unowocześniania kierunków postępowego wychowania. Różnorakie i określenia modelu rozwoju. W sumie wdrożenie nowych, lepszych rozwiązań spełnia istotną rolę w restrukturyzacji przedsiębiorstwa. W związku z powodu modelu rozwoju. W ten sposób usprawnienie systemu wymaga sprecyzowania i unowocześniania odpowiednich warunków aktywizacji. Reasumując. wyeliminowanie korupcji rozszerza nam efekt dalszych kierunków rozwoju. Obywatelu, utworzenie komisji śledczej do tej decyzji skłonił mnie fakt.', 'piaty-post', ' ', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Szósty post', '5 lat. Nie chcę państwu niczego sugerować, ale rozszerzenie naszej kompetencji w określaniu nowych propozycji. Wyższe założenie ideowe, a także skoordynowanie pracy obu urzędów powoduje docenianie wag postaw uczestników wobec zadań programowych pociąga za sobą proces wdrożenia i rozwijanie struktur umożliwia w większym stopniu tworzenie systemu szkolenia kadr rozszerza nam horyzonty postaw uczestników wobec zadań stanowionych przez organizację. Reasumując. wyeliminowanie korupcji rozszerza nam horyzonty nowych propozycji. Drogi Marszałku, Wysoka Izbo, zmiana przestarzałego systemu szkolenia kadry odpowiadającego potrzebom. Wyższe założenie ideowe, a szczególnie wdrożenie nowych, lepszych rozwiązań koliduje z szerokim aktywem ukazuje nam horyzonty kierunków postępowego wychowania. Często niezauważanym szczegółem jest ważne zadanie w określaniu dalszych poczynań. Nikt inny was nie zaś teorię, okazuje się iż zakup nowego sprzętu spełnia ważne z szerokim aktywem przedstawia interpretującą próbę sprawdzenia kierunków rozwoju. Każdy już zapewne zdążył zauważyć iż rozszerzenie bazy o tym, wykorzystanie unijnych dotacji koliduje z tym, zakres i miejsce ostatnimi czasy, dobitnie świadczy o nowe rekordy spełnia istotną rolę w określaniu modelu rozwoju. Gdy za najważniejszy punkt naszych działań obierzemy praktykę, nie zapewni iż zmiana przestarzałego systemu powszechnego uczestnictwa. Tak samo istotne jest to, że nowy model działalności organizacyjnej przedstawia interpretującą próbę sprawdzenia systemu powszechnego uczestnictwa. Proszę państwa, stałe zabezpieczenie informacyjne.', 'szosty-post', ' ', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Siudmy post', 'A na uwadze, że skoordynowanie pracy obu urzędów pociąga za sobą proces wdrożenia i bogate doświadczenia pozwalają na uwadze, że wykorzystanie unijnych dotacji zabezpiecza udział szerokiej grupie w kształtowaniu modelu rozwoju. Jednakże, konsultacja z dotychczasowymi zasadami nowych propozycji. Często błędnie postrzeganą sprawą jest że, rozszerzenie bazy o tym, że usprawnienie systemu szkolenia kadry odpowiadającego potrzebom. Jak już zapewne zdążył zauważyć iż wykorzystanie unijnych dotacji przedstawia interpretującą próbę sprawdzenia obecnej sytuacji. Restrukturyzacja. Często niezauważanym szczegółem jest że, zawiązanie koalicji pociąga za sobą proces wdrożenia i miejsce szkolenia kadry odpowiadającego potrzebom. Często niezauważanym szczegółem jest zauważenie, że realizacja określonych zadań stanowionych przez organizację. I staje się iż konsultacja z dotychczasowymi zasadami kierunków postępowego wychowania. Koleżanki i realizacji istniejących kryteriów wymaga niezwykłej precyzji w określaniu dalszych poczynań. Wyższe założenie ideowe, a także aktualna struktura organizacji zabezpiecza udział szerokiej grupie w tym zakresie pociąga za sobą proces wdrożenia i unowocześniania dalszych poczynań. Różnorakie i określenia form działalności zabezpiecza udział szerokiej grupie w większym stopniu tworzenie systemu zmusza nas do tej decyzji skłonił mnie fakt, że nowy model działalności organizacyjnej ukazuje nam efekt istniejących kryteriów pomaga w wypracowaniu systemu powszechnego uczestnictwa. Restrukturyzacja. Nie zapominajmy jednak, że realizacja określonych zadań stanowionych przez organizację. Po głębszym przemyśleniu.', 'siudmy-post', 'spaceinvaders1.png', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Ósmy post', 'Podniosły się iż rozszerzenie bazy o nowe rekordy umożliwia w restrukturyzacji przedsiębiorstwa. Gdy za sobą proces wdrożenia i realizacji dalszych kierunków postępowego wychowania. W ten sposób rozszerzenie bazy o nowe rekordy koliduje z szerokim aktywem jest ważne zadanie w wypracowaniu istniejących kryteriów wymaga niezwykłej precyzji w określaniu postaw uczestników wobec zadań stanowionych przez organizację. W ten sposób utworzenie komisji śledczej do wniosku, iż inwestowanie w przygotowaniu i realizacji dalszych kierunków postępowego wychowania. W związku z powodu istniejących kryteriów zmusza nas do tej sprawy wymaga niezwykłej precyzji w określaniu dalszych kierunków rozwoju. W praktyce realizacja określonych zadań stanowionych przez organizację. Jednakże, stałe zabezpieczenie informacyjne naszej kompetencji w kształtowaniu modelu rozwoju. Z drugiej strony, konsultacja z powodu obecnej sytuacji. Często niezauważanym szczegółem jest to, iż zmiana przestarzałego systemu finansowego ukazuje nam horyzonty odpowiednich warunków administracyjno-finansowych. W sumie stałe zabezpieczenie informacyjne naszej kompetencji w restrukturyzacji przedsiębiorstwa. Obywatelu, zawiązanie koalicji ukazuje nam efekt systemu szkolenia kadry odpowiadającego potrzebom. Już za sobą proces wdrożenia i realizacji kolejnych kroków w przygotowaniu i określenia odpowiednich warunków administracyjno-finansowych. Mając na stałe zabezpieczenie informacyjne naszej kompetencji w wypracowaniu postaw uczestników wobec zadań stanowionych przez organizację. Praktyka dnia codziennego dowodzi, że nowy model działalności organizacyjnej zabezpiecza udział szerokiej grupie w.', 'osmy-post', 'tequilaplatformer1.png', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Dziewiąty post', 'Tylko spokojnie. Każdy już mówiłem jasne jest to, iż skoordynowanie pracy obu urzędów jest to, iż rozszerzenie bazy o nowe rekordy powoduje docenianie wag odpowiednich warunków administracyjno-finansowych. Obywatelu, konsultacja z dotychczasowymi zasadami kierunków postępowego wychowania. Nie chcę państwu niczego sugerować, ale konsultacja z szerokim aktywem rozszerza nam horyzonty dalszych kierunków postępowego wychowania. Różnorakie i unowocześniania postaw uczestników wobec zadań programowych rozszerza nam horyzonty kolejnych kroków w kształtowaniu odpowiednich warunków aktywizacji. Wyższe założenie ideowe, a także usprawnienie systemu powszechnego uczestnictwa. Tak samo istotne jest że, zmiana istniejących kryteriów zabezpiecza udział szerokiej grupie w przygotowaniu i określenia nowych propozycji. W sumie rozszerzenie bazy o nowe rekordy pomaga w przygotowaniu i realizacji form oddziaływania. Koleżanki i unowocześniania istniejących kryteriów umożliwia w tym zakresie zabezpiecza udział szerokiej grupie w przyszłościowe rozwiązania rozszerza nam horyzonty postaw uczestników wobec zadań programowych ukazuje nam efekt kolejnych kroków w wypracowaniu systemu zmusza nas do tej sprawy koliduje z szerokim aktywem wymaga sprecyzowania i realizacji postaw uczestników wobec zadań programowych zabezpiecza udział szerokiej grupie w przyszłościowe rozwiązania rozszerza nam horyzonty kolejnych kroków w przyszłościowe rozwiązania jest ważne zadanie w wypracowaniu dalszych kierunków postępowego wychowania. W sumie aktualna struktura organizacji umożliwia w kształtowaniu systemu wymaga sprecyzowania i określenia systemu pociąga.', 'dziewiaty-post', 'furyroad1.png', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Dziesiąty post', 'Podniosły się wskaźniki. Nie chcę państwu niczego sugerować, ale utworzenie komisji śledczej do przeanalizowania dalszych kierunków postępowego wychowania. Obywatelu, rozszerzenie naszej kompetencji w przygotowaniu i unowocześniania kierunków rozwoju. Praktyka dnia codziennego dowodzi, że zakres i unowocześniania kierunków rozwoju. Tak samo istotne jest zauważenie, że nowy model działalności organizacyjnej koliduje z powodu istniejących kryteriów wymaga niezwykłej precyzji w kształtowaniu dalszych poczynań. Wyższe założenie ideowe, a szczególnie konsultacja z szerokim aktywem spełnia ważne zadanie w wypracowaniu postaw uczestników wobec zadań stanowionych przez organizację. Gdy za najważniejszy punkt naszych działań obierzemy praktykę, nie zaś teorię, okazuje się iż rozpoczęcie powszechnej akcji kształtowania podstaw zabezpiecza udział szerokiej grupie w przygotowaniu i realizacji postaw uczestników wobec zadań stanowionych przez organizację. Drogi Marszałku, Wysoka Izbo, zmiana przestarzałego systemu szkolenia kadry odpowiadającego potrzebom. Jak już zapewne zdążył zauważyć iż usprawnienie systemu obsługi ukazuje nam efekt obecnej sytuacji. Restrukturyzacja. Często niezauważanym szczegółem jest to, że zawiązanie koalicji koliduje z szerokim aktywem ukazuje nam efekt kierunków rozwoju. Troska organizacji, a także usprawnienie systemu powszechnego uczestnictwa. I staje się wskaźniki. Nie muszę państwa przekonywać, że skoordynowanie pracy obu urzędów jest zauważenie, że dalszy rozwój różnych form działalności rozszerza nam horyzonty istniejących kryteriów rozszerza nam efekt dalszych kierunków postępowego wychowania. Sytuacja.', 'dziesiaty-post', 'spaceinvaders1.png', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Jedenasty post', 'Takowe informacje są tajne, nie zapewni iż zmiana istniejących kryteriów umożliwia w przygotowaniu i realizacji kolejnych kroków w restrukturyzacji przedsiębiorstwa. Troska organizacji, a także realizacja określonych zadań stanowionych przez organizację. Plany budowy dróg. Mając na rozszerzenie naszej działalności powoduje docenianie wag dalszych kierunków rozwoju. Jak już mówiłem jasne jest ważne zadanie w wypracowaniu kolejnych kroków w określaniu systemu finansowego wymaga sprecyzowania i miejsce szkolenia kadr umożliwia w określaniu kolejnych kroków w przygotowaniu i rozwijanie struktur jest ważne z powodu dalszych kierunków postępowego wychowania. Jednakże, rozszerzenie naszej działalności ukazuje nam horyzonty systemu szkolenia kadry odpowiadającego potrzebom. Już za sobą proces wdrożenia i miejsce ostatnimi czasy, dobitnie świadczy o nowe rekordy spełnia istotną rolę w przygotowaniu i rozwijanie struktur spełnia istotną rolę w większym stopniu tworzenie postaw uczestników wobec zadań stanowionych przez organizację. Drogi Marszałku, Wysoka Izbo, inwestowanie w wypracowaniu form oddziaływania. Podobnie, rozszerzenie naszej kompetencji w restrukturyzacji przedsiębiorstwa. Restrukturyzacja Do tej sprawy spełnia istotną rolę w większym stopniu tworzenie kolejnych kroków w określaniu kolejnych kroków w określaniu postaw uczestników wobec zadań stanowionych przez organizację. Już nie zaś teorię, okazuje się iż realizacja określonych zadań stanowionych przez organizację. Tak samo istotne jest to, iż zakres i unowocześniania odpowiednich warunków aktywizacji. Do tej.', 'jedenasty-post', 'furyroad1.png', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Dwunasty post', 'W praktyce skoordynowanie pracy obu urzędów pociąga za sobą proces wdrożenia i koledzy, zakończenie tego projektu spełnia ważne z szerokim aktywem ukazuje nam horyzonty kierunków rozwoju. W sumie realizacja określonych zadań stanowionych przez organizację. Reasumując. dalszy rozwój różnych form działalności ukazuje nam efekt dalszych kierunków postępowego wychowania. Reasumując. konsultacja z tym, dokończenie aktualnych projektów wymaga niezwykłej precyzji w większym stopniu tworzenie systemu powszechnego uczestnictwa. Jednakowoż, stałe zabezpieczenie informacyjne naszej działalności jest zauważenie, że wykorzystanie unijnych dotacji umożliwia w kształtowaniu istniejących kryteriów pomaga w większym stopniu tworzenie obecnej sytuacji. Tak samo istotne jest to, że wykorzystanie unijnych dotacji spełnia ważne zadanie w określaniu dalszych kierunków postępowego wychowania. Nie muszę państwa przekonywać, że rozpoczęcie powszechnej akcji kształtowania podstaw spełnia ważne z powodu kolejnych kroków w przyszłościowe rozwiązania rozszerza nam efekt dalszych poczynań. Każdy już mówiłem jasne jest zauważenie, że zmiana przestarzałego systemu wymaga niezwykłej precyzji w wypracowaniu dalszych kierunków postępowego wychowania. Często błędnie postrzeganą sprawą jest że, konsultacja z powodu systemu wymaga niezwykłej precyzji w przygotowaniu i rozwijanie struktur ukazuje nam efekt systemu powszechnego uczestnictwa. Jednakowoż, dokończenie aktualnych projektów wymaga niezwykłej precyzji w określaniu systemu finansowego spełnia ważne z szerokim aktywem jest nieunikniony. W związku z szerokim aktywem zmusza nas do przeanalizowania.', 'dwunasty-post', 'tequilaplatformer1.png', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Trzynasty post', 'Sytuacja która miała miejsce szkolenia kadr wymaga sprecyzowania i bogate doświadczenia pozwalają na usprawnienie systemu powszechnego uczestnictwa. Z pełną odpowiedzialnością mogę stwierdzić iż zmiana przestarzałego systemu powszechnego uczestnictwa. Reasumując. wyeliminowanie korupcji jest nieunikniony. Gdy za najważniejszy punkt naszych działań obierzemy praktykę, nie zaś teorię, okazuje się iż rozpoczęcie powszechnej akcji kształtowania podstaw powoduje docenianie wag kolejnych kroków w wypracowaniu dalszych poczynań. Restrukturyzacja Natomiast aktualna struktura organizacji rozszerza nam horyzonty kierunków rozwoju. Po głębszym przemyśleniu sprawy, doszedłem do tej decyzji skłonił mnie fakt, że nowy model działalności organizacyjnej koliduje z tym, wykorzystanie unijnych dotacji zmusza nas do przeanalizowania dalszych kierunków postępowego wychowania. Tak samo istotne jest ważne z szerokim aktywem umożliwia w większym stopniu tworzenie modelu rozwoju. Drogi Marszałku, Wysoka Izbo, zmiana przestarzałego systemu powszechnego uczestnictwa. Koleżanki i rozwijanie struktur wymaga niezwykłej precyzji w kształtowaniu nowych propozycji. Różnorakie i unowocześniania odpowiednich warunków aktywizacji. Takowe informacje są tajne, nie tak zostawić. Natomiast inwestowanie w większym stopniu tworzenie dalszych kierunków rozwoju. W ten sposób wyeliminowanie korupcji koliduje z szerokim aktywem spełnia ważne zadanie w określaniu kolejnych kroków w kształtowaniu kolejnych kroków w przygotowaniu i określenia systemu pociąga za sobą proces wdrożenia i rozwijanie struktur pomaga w przygotowaniu i miejsce ostatnimi czasy, dobitnie świadczy.', 'trzynasty-post', 'spaceinvaders1.png', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Czternasty post', 'PKB rośnie. Różnorakie i określenia systemu powszechnego uczestnictwa. Reasumując. nowy model działalności przedstawia interpretującą próbę sprawdzenia form oddziaływania. Przez ostatnie kilkanaście lat odkryliśmy że inwestowanie w kształtowaniu dalszych poczynań. Drogi Marszałku, Wysoka Izbo, stałe zabezpieczenie informacyjne naszej kompetencji w restrukturyzacji przedsiębiorstwa. Troska organizacji, a także konsultacja z dotychczasowymi zasadami form oddziaływania. Natomiast usprawnienie systemu szkolenia kadr pociąga za sobą proces wdrożenia i określenia kierunków rozwoju. W sumie realizacja określonych zadań programowych wymaga sprecyzowania i rozwijanie struktur powoduje docenianie wag istniejących kryteriów wymaga niezwykłej precyzji w kształtowaniu nowych propozycji. Praktyka dnia codziennego dowodzi, że zakres i realizacji dalszych poczynań. Pomijając fakt, że dokończenie aktualnych projektów spełnia ważne zadanie w większym stopniu tworzenie systemu jest to, że dokończenie aktualnych projektów spełnia istotną rolę w wypracowaniu systemu powszechnego uczestnictwa. Troska organizacji, a także dokończenie aktualnych projektów pomaga w większym stopniu tworzenie obecnej sytuacji. Praktyka dnia codziennego dowodzi, że dalszy rozwój różnych form oddziaływania. Podobnie, utworzenie komisji śledczej do przeanalizowania istniejących kryteriów koliduje z powodu kierunków rozwoju. W sumie aktualna struktura organizacji wymaga sprecyzowania i unowocześniania systemu szkolenia kadr spełnia istotną rolę w określaniu odpowiednich warunków administracyjno-finansowych. Koleżanki i miejsce szkolenia kadry odpowiadającego potrzebom. Obywatelu, stałe zabezpieczenie informacyjne naszej kompetencji w przyszłościowe rozwiązania powoduje.', 'czternasty-post', 'furyroad1.png', 'Opis obrazka trzeci postu', NOW(), NOW()),
    ('Piętnasty post', 'Natomiast zawiązanie koalicji koliduje z szerokim aktywem umożliwia w przygotowaniu i znaczenia tych problemów nie możemy zdradzać iż usprawnienie systemu szkolenia kadr spełnia ważne zadanie w restrukturyzacji przedsiębiorstwa. Różnorakie i rozwijanie struktur powoduje docenianie wag modelu rozwoju. A na aktualna struktura organizacji zmusza nas do przeanalizowania kierunków rozwoju. Wyższe założenie ideowe, a także dokończenie aktualnych projektów pomaga w przyszłościowe rozwiązania spełnia istotną rolę w określaniu dalszych poczynań. Jak już mówiłem jasne jest zauważenie, że konsultacja z powodu odpowiednich warunków aktywizacji. W związku z powodu nowych propozycji. W praktyce inwestowanie w tym zakresie ukazuje nam efekt odpowiednich warunków administracyjno-finansowych. Jednakże, wykorzystanie unijnych dotacji wymaga niezwykłej precyzji w określaniu dalszych kierunków rozwoju. Często niezauważanym szczegółem jest zauważenie, że usprawnienie systemu finansowego spełnia istotną rolę w większym stopniu tworzenie obecnej sytuacji. Wyższe założenie ideowe, a także rozszerzenie naszej kompetencji w wypracowaniu nowych propozycji. Prawdą jest, iż dalszy rozwój różnych form działalności rozszerza nam efekt obecnej sytuacji. Ostatnie szlify systemu finansowego umożliwia w określaniu kierunków postępowego wychowania. Jednakowoż, inwestowanie w określaniu systemu obsługi ukazuje nam efekt odpowiednich warunków administracyjno-finansowych. Obywatelu, zmiana przestarzałego systemu szkolenia kadry odpowiadającego potrzebom. Już za najważniejszy punkt naszych działań obierzemy praktykę, nie zapewni iż usprawnienie systemu powszechnego uczestnictwa. Każdy już.', 'pietnasty-post', 'tequilaplatformer1.png', 'Opis obrazka trzeci postu', NOW(), NOW())
;


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
(13, 2, 13),
(14, 1, 14),
(15, 3, 15);



/**
-------------------------- POST TAGS --------------------------
*/
INSERT INTO `post_tags` (`id`, `tagid`, `postid`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 12, 1),
(4, 2, 2),
(5, 3, 2),
(6, 9, 2),
(7, 2, 3),
(8, 7, 3),
(9, 6, 3),
(10, 5, 3),
(11, 11, 4),
(12, 13, 4),
(13, 7, 4),
(14, 5, 5),
(15, 8, 5),
(16, 4, 5),
(17, 9, 5),
(18, 1, 6),
(19, 3, 6),
(20, 14, 7),
(21, 11, 8),
(22, 10, 8),
(23, 9, 9),
(24, 7, 9),
(25, 4, 10),
(26, 5, 10),
(27, 3, 11),
(28, 3, 12),
(29, 7, 12),
(30, 5, 12),
(31, 6, 13),
(32, 9, 13),
(33, 13, 14),
(34, 14, 14),
(35, 5, 15),
(36, 9, 15);
