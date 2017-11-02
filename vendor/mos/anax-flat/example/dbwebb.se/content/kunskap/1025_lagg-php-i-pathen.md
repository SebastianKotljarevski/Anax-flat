---
author: mos
category: 
    - labbmiljo
    - php
revision:
    "2016-10-11": (A, mos) Första revisionen.
...
Lägg PHP i pathen
==================================

[FIGURE src=image/snapht16/php-in-path.png?w=c5&a=0,70,70,0 class="right"]

Så här gör du för att lägga PHP i sökvägen så att du kan köra det direkt i terminalen. 

<!--more-->



Förutsättning {#pre}
-------------------------------

Du har installerat PHP på ditt system.




Verifiera att det fungerar {#test}
-------------------------------

Så här kan du verifiera att det fungerar. Om det inte fungerar så forsätter du längre ned i artikeln för att installera, sedan kommer du tillbaka hit igen för att verifiera att allt fungerar som det ska.

Var ligger PHP? Har jag flera installationer av PHP i pathen? Vilken är min PATH?

```bash
$ which php
$ whereis php
$ echo $PATH
```

Öppna din terminal, kolla versionen på PHP och testkör ett PHP-skript.

```bash
$ php --help
$ php --version
$ php -r "echo 'Hello World';"
$ php -r "echo md5('mos@dbwebb.se');"
```

Kontrollera var konfig-filen (`php.ini`) ligger samt kontrollera om en viss modul är laddad i via konfig-filen.

```bash
$ php -i | grep Configuration
$ php -i | grep sqlite
```

Nu har du verktyg att testa och felsöka via PHP på terminalen.



Installera på Windows {#windows}
-------------------------------

Om du har installerat XAMPP så ligger troligen den exekverbara PHP-filen i följande katalog. Öppna en `cmd.exe` för att kontrollera att du har rätt sökväg.

```bash
C\: \xampp\php\php.exe --version
```

Starta nu kontrollpanelen för din dator `Control Panel\System and Security\System`.

Du kan starta den direkt från `cmd.exe` på följande sätt.

```bash
C\: control system
```

Klicka på ändra inställningar för din dator.

[FIGURE src=image/snapht16/windows-php-path1.png?w=w2 caption="I kontrollpanelen, öppna fönstret för att ändra inställningar i din dator."]

Välj fliken "Advanced" och klicka på "Environment Variables".

[FIGURE src=image/snapht16/windows-php-path2.png caption="Öppna fönstret för Environment Variabels."]

Välj "Path" i listan och klicka "Edit...".

Redigera så att sökvägen till din exekverbara `php.exe` kommer in i listan.

[FIGURE src=image/snapht16/windows-php-path3.png caption="Nu ligger sökvägen på plats."]

Starta om `cmd.exe` och testa att det nu fungerar.

Starta en Cygwin-terminal och verifiera att det även fungerar där.

Om det inte fungerar, pröva att logga ut och logga in igen.



Installera på Mac OS {#macos}
-------------------------------

Om du har installerat XAMPP så ligger troligen filerna under katalogen `/Applications/XAMPP/bin`. Öppna en terminal och kontroller att du har rätt sökväg.

```bash
$ /Applications/XAMPP/bin/php --version
```

I XAMPPs katalog ligger en stor del exekverbara som delvis krockar med de som Mac OS har installerat. Jag är alltså inte villig att lägga XAMPPs bin-katalog direkt i min sökväg. Så jag gör på ett eget sätt och väljer ut de exekverbara som jag vill använda.

Jag skapar en egen bin-katalog i `$HOME/bin`, som jag lägger till i `$PATH` via startupfilen `.bash_profile`. I bin-katalogen avser jag lägga till de exekverbara som jag vill använda.

```bash
$ cd $HOME
$ mkdir bin
$ echo 'export PATH="$HOME/bin:$PATH"' >> .bash_profile
$ tail -1 .bash_profile 
export PATH="$HOME/bin:$PATH"
```

Du kan nu starta om terminalen och verifera att `$PATH` verkligen innehåller bin-katalogen. Eller så kan du sourca startupfilen.

```bash
$ source .bash_profile
$ echo $PATH
```

Då lägger jag till de kommandon som jag kommer att behöva, in i bin-katalogen. Jag skapar symboliska länkar.

```bash
$ ln -s /Applications/XAMPP/bin/{php,phpize,php-config,pecl} bin/
$ ls -l bin
total 32
lrwxr-xr-x  1 mikaelroos  staff  28 Oct 11 12:22 pecl -> /Applications/XAMPP/bin/pecl
lrwxr-xr-x  1 mikaelroos  staff  27 Oct 11 12:22 php -> /Applications/XAMPP/bin/php
lrwxr-xr-x  1 mikaelroos  staff  34 Oct 11 12:22 php-config -> /Applications/XAMPP/bin/php-config
lrwxr-xr-x  1 mikaelroos  staff  30 Oct 11 12:22 phpize -> /Applications/XAMPP/bin/phpize
```

Klart. Nu kan du verifera att php fungerar som det ska.



Installera på Linux {#linux}
-------------------------------

På Linux (debian) installerar jag PHP med `apt-get` och den exekverbara hamnar i `usr/bin` vilket redan ligger i min path. Allt klart.



Avslutningsvis {#avslutning}
------------------------------

Det finns en [forumtråd](t/5775) där du kan ställa frågor, eller ge tips och trix, om denna artikel. Kika där om du får problem.
