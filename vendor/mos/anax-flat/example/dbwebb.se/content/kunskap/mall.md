---
author: Mikael Roos
published: 2016-03-21
category:
    - python
...
Kom igång med datatypen lista i Python
===================================

[FIGURE src=/image/snapvt16/python-list-shopping.png?w=c5&a=0,75,75,0 class="right"]

Python är känt för sina datastrukturer och listor är en av de grundläggande datastrukturerna. Denna artikel introducerar listor och visar hur du kan jobba med dem.

Du får se hur du skapar en lista, hur du lägger till, tar bort och flyttar runt innehållet i listan samt hur du loopar runt en lista.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du kan grunderna i Python och du vet vad variabler, typer och funktioner innebär.



En shoppinglista i Python {#shopping}
------------------------------


Jag har fått i uppdrag att sköta helgens inhandling av mat. Som nybliven Python-programmerare så tänker jag lösa det på en programmerares sätt.

Här är min råa data.

```text
köttfärs
grädde
krossade tomater
gul lök
```

Jag börjar med en ansats där varje rad på shoppinglistan är en sträng och denna strängen lägger jag till en lista i Python.



###En lista `[]` som datastruktur {#datastruct}

Jag börjar med en tom lista. I Python representerar `[]` en tom lista.

```python
>>> shopping = []
>>> print(shopping)
[]
>>> type(shopping)
<class 'list'>    
```

Sådär, nu har jag en tom lista att utgå ifrån.

Det finns fler sätt att skapa en lista. Du kan till exempel använda en konstruktor `list()` eller skapa en färdig lista där du separerar värden med ett kommatecken.

```python
>>> alist = list() 
>>> alist          
[]                 
>>> anotherList = ["a", "b", "c"]
>>> anotherList                  
['a', 'b', 'c']                  
```

Det finns alltid varianter på hur man gör saker. En enkel variant vore att jag helt enkelt skapade hela min shoppinglistan på en gång.

```python
>>> shopping = ["köttfärs", "krossade tomater", "grädde", "gul lök"]
>>> shopping                                                        
['köttfärs', 'krossade tomater', 'grädde', 'gul lök']               
```

Klar. Men det vore ju för enkelt. Jag vill ju gärna förklara hur man kan jobba med en lista, så jag fortsätter med min tomma lista.

```python
>>> shopping = []
>>> shopping
[]
```

Så, då kikar vi lite på vad vi kan göra med en lista.



###Metoder för att jobba med en lista {#metoder}

En lista i Python är implementerad som en `<class 'list'>` och har ett antal metoder kopplade till sig. Vi kan läsa om dessa [metoder i manualen](https://docs.python.org/3.5/tutorial/datastructures.html), eller få fram information om dem direkt i terminalen.

```python
>>> shopping = []
>>> dir(shopping)
['__add__', '__class__', '__contains__', '__delattr__', '__delitem__', '__dir__', '__doc__
', '__eq__', '__format__', '__ge__', '__getattribute__', '__getitem__', '__gt__', '__hash_
_', '__iadd__', '__imul__', '__init__', '__iter__', '__le__', '__len__', '__lt__', '__mul_
_', '__ne__', '__new__', '__reduce__', '__reduce_ex__', '__repr__', '__reversed__', '__rmu
l__', '__setattr__', '__setitem__', '__sizeof__', '__str__', '__subclasshook__', 'append',
 'clear', 'copy', 'count', 'extend', 'index', 'insert', 'pop', 'remove', 'reverse', 'sort'
]
>>> help(shopping.insert)
Help on built-in function insert:

insert(...) method of builtins.list instance
    L.insert(index, object) -- insert object before index
```

Med funktionen `dir()` får jag fram en lista med attribut och metoder som kan användas när man jobbar med en lista. Jag ignorerar de som börjar med `__` och fokuserar på de metoder som är publika.

Jag hittar metoden `insert()` som verkar vara det jag letar efter. Låt testa och se.



### Lägga till innehåll i listan (insert/append) {#insert}

Jag testar att lägga till items i listan med hjälp av metoden `insert()`.

```python
>>> shopping.insert("köttfärs")                         
Traceback (most recent call last):                      
  File "<stdin>", line 1, in <module>                   
TypeError: insert() takes exactly 2 arguments (1 given) 
>>> shopping.insert(2, "köttfärs")                      
>>> shopping                                            
['köttfärs']                                            
>>> shopping.insert(0, "grädde")                        
>>> shopping                                            
['grädde', 'köttfärs']                                  
>>> shopping.insert(1, "krossade tomater")              
>>> shopping                                            
['grädde', 'krossade tomater', 'köttfärs']              
```

Det visar sig att metoden `insert()` tar två parametrar, en som anger själva objektet, strängen i vårt fall, och en som anger positionen i listan. 

Nu var jag inte intresserad av positionen i listan, jag ville bara lägga in dem i en viss ordning. Jag kollar om det finns en annan bättre metod och finner `append()`.

```python
>>> help(shopping.append)
Help on built-in function append:             
                                              
append(...)                                   
    L.append(object) -- append object to end  
```

Jag testar att använda metoden `append()` istället.

```python
>>> shopping                                          
['grädde', 'krossade tomater', 'köttfärs']            
>>> shopping.append("gul lök")                        
>>> shopping                                          
['grädde', 'krossade tomater', 'köttfärs', 'gul lök'] 
>>> shopping.append("röd lök")                                   
>>> shopping                                                     
['grädde', 'krossade tomater', 'köttfärs', 'gul lök', 'röd lök'] 
```

Ja, det var mer `append()` som jag hade tänkt mig. Det finns alltså olika sätt att lägga till saker till en lista.



###En lista med positioner {#pos}

När saker ligger i en lista så ligger det på en viss position. Positionerna i listan är numrerad från 0 till antal saker i listan minus ett.

För att räkna ut antalet saker i listan så använder vi funktionen [`len()`](https://docs.python.org/3.5/library/functions.html?highlight=len#len).

```python
>>> shopping                                                     
['grädde', 'krossade tomater', 'köttfärs', 'gul lök', 'röd lök'] 
>>> len(shopping)
5                
>>> shopping[0]  
'grädde'         
>>> shopping[4]  
'röd lök'        
```

Med hjälp av dessa konstruktioner kan vi nu byta plats på två element i listan. Säg jag vill byta plats på "grädde" och "köttfärs".

```python
>>> tempItem = shopping[0]                                      
>>> shopping[0] = shopping[2]                                   
>>> shopping[2] = tempItem                                      
>>> shopping                                                    
['köttfärs', 'krossade tomater', 'grädde', 'gul lök', 'röd lök']
```

Jag behöver mellanlagra värdet i variabeln `tempItem` och på det viset kan jag byta plats på två element i en lista.



###Radera saker ur listan {#radera}

Det visade sig att "röd lök" ligger i listan men det skall jag inte ha. Det vill jag ta bort. Vis av skillnanden mellan `insert()` och `append()` så läser jag nu i [manualen](https://docs.python.org/3.5/tutorial/datastructures.html) om de metoder som finns för att radera saker ur en lista. Jag finner `remove()` och `pop()` och väljer den senare.

```python
>>> shopping                                                    
['köttfärs', 'krossade tomater', 'grädde', 'gul lök', 'röd lök']
>>> remove = shopping.pop(4)                                    
>>> remove                                                      
'röd lök'                                                       
>>> shopping                                                    
['köttfärs', 'krossade tomater', 'grädde', 'gul lök']           
```

Metoden `remove()` tar bort en sak ur listan baserad på dess värde. Jag hade alltså kunnat använda den metoden, som ett alternativ.

```python
>>> shopping                                                    
['köttfärs', 'krossade tomater', 'grädde', 'gul lök']           
>>> shopping.append("röd lök")                                  
>>> shopping                                                    
['köttfärs', 'krossade tomater', 'grädde', 'gul lök', 'röd lök']
>>> shopping.remove("röd lök")                                  
>>> shopping                                                    
['köttfärs', 'krossade tomater', 'grädde', 'gul lök']           
```

Ibland lämpar sig den ena eller den andra bättre. Det är bara att välja, båda utför arbetet som önskas, att ta bort "röd lök" från shoppinglistan.



###Loopa genom en lista {#loop}

Säg jag vill loopa igenom min shoppinglista och skriva ut varje värde. En `for`-sats hjälper mig med det.

```python
>>> for item in shopping: 
...     print(item)       
...                       
köttfärs                  
krossade tomater          
grädde                    
gul lök                   
```

Säg nu att du vill ha listan numrerad. Du skulle kunna skapa en räknare som du inkrementerar för varje varv i loopen, det hade fungerat. Men låt mig visa dig en annan variant som är mer Python-lik.

```python
>>> for i, item in enumerate(shopping):      
...     print("{}. {}".format(i + 1, item)); 
...                                          
1. köttfärs                                  
2. krossade tomater                          
3. grädde                                    
4. gul lök                                   
```

Den inbyggda funktionen [`enumerate()`](https://docs.python.org/3.5/library/functions.html#enumerate) hjälper oss att få en siffra på varje iteration, så vi slipper en egen räknare. Det som returneras från `enumerate()` är en annan spännande datastruktur i Python, en *tuple*. Men den pratar vi mer om en annan dag.

Nu skall jag gå och handla med min shoppinglista.



Tre i rad med en lista {#treirad}
------------------------------

Vill du ha lite mer kod som använder sig av listor så finns ett Tic Tac Toe spel i kursrepots exempel-katalog, närmare bestämt i [`example/list/tic-tac-toe.py`](https://github.com/mosbth/python/blob/master/example/list/tic-tac-toe.py). Det visar hur man kan använda en lista för att representera ett spel där man placerar ut brickor som liknar spelet tre i rad.

[ASCIINEMA src=37763]

Kika på exempelkoden och variabeln `board` som är en lista som representerar spelplanen.



###Överkurs {#overkurs}

Vill du se ett exempel på hur man kan jobba med flera dimensioner i listor, där en lista består av en lista? Då kan du kika på exempelprogrammet [example/matrix](https://github.com/mosbth/python/blob/master/example/matrix/do-matrix.py). Exempelprogrammet jobbar med en tvådimensionell lista som skrivs och läses från fil.

Men ta detta som ren överkurs och bara om du är bekväm med användandet av listor.



Avslutningsvis {#avslutning}
------------------------------

Detta var en introduktion till listor i Python. Har du frågor eller funderingar så tar vi det i [forumet för Python-frågor](forum/viewforum.php?f=44). 



Revisionshistoria {#revisionshistoria}
--------------------------------------

<span class='revision-history' markdown='1'>
2016-02-29 (A, mos) Första utgåvan.  
</span>
