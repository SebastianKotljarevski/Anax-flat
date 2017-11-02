---
author: mos
revision:
    2016-11-29: (A, mos) Första utgåvan.
category:
    - kurs/design
...
Skapa teman med designelement till ditt Anax Flat
===================================

Du skall skapa ett antal teman till ditt Anax Flat som uppfyller vissa krav och använder vissa tongivande designelement.

Du lägger till dina teman via tema väljaren.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat med [teman i temaväljaren](uppgift/en-bas-och-en-familj-av-teman) så du vet hur det fungerar.



Introduktion {#intro}
-----------------------

Låt oss använda grafiska element såsom bilder, texturer, streck, former och färger för att skapa god design.

Om temat som sådant är perfekt eller inte spelar mindre roll, du tränar att jobba med olika designelement, så vi har fokus på dem.

Gör det tydligt i temaväljaren vilka teman som löser uppgiften.

Kanske har du tidigare teman som delvis löser uppgifterna. Du kan då ta **en kopia** av dem och jobba vidare med dem för att lösa kraven i uppgiften.



Krav {#krav}
-----------------------

1. Bygg en testsida `content/design-element.md` där du kort beskriver varje tema som du nu skall skapa. Lägg sidan i menyn. På sidan länkar du till temaväljaren.

1. Gör tre olika teman som gemensamt uppfyller samtliga nedanstående krav. Du väljer själv hur du komponerar varje tema.

1. Ett tema skall ha en bakgrundsbild som är ett foto, gärna återkommande i flera regioner.

1. Ett tema skall ha en textur, eller bild som upplevs som strukturell, som bakgrund. Gärna återkommande i flera regioner.

1. Ett tema skall bygga på bakgrundsfärger med gradients i flera av sidans regioner.

1. Använd genomskinliga element, *opacity*, så att bakgrunden, vid behov, lyser igenom (lagom mycket).

1. Ett tema skall tydligt använder sig av streck (variationer av *borders*) för att lyfta fram designen.

1. Ett tema skall låta innehållet sträcka sig över hela webbläsarens bredd.

1. Ett tema skall låta innehållet vara centrerat i mitten.

1. Ett tema skall använda ett par bilder som placerats ut som designelement på sidan (i bakgrunden).



###Klar och taggad {#tag}

1. Se till att ditt tema passerar testerna som körs vid `make test`.

1. Committa och tagga relevant repo som version 6.0.x (6.0.1 eller högre).

1. Pusha upp repona till GitHub, inklusive taggarna.

1. Gör en `dbwebb publish` för att kolla att allt fungerar.

```bash
$ dbwebb publish me
```



Extrauppgift {#extra}
-----------------------

Det finns inga extrauppgifter.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
