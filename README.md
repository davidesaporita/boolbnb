# BoolBnB | Web Application

> Laravel based Airbnb replica

> Creators: 
- [Carmine Lentisco](https://www.linkedin.com/in/carmine-lentisco-07a0871b2/)
- [Paolo Francesco Marino](https://www.linkedin.com/in/paolo-francesco-marino-0790981b2/)
- [Gerardo Pagliarulo](https://www.linkedin.com/in/gerardo-pagliarulo-b56105113/)
- [Emanuele Sanquirico](https://www.linkedin.com/in/emanuele-sanquirico-3791161b2/)
- [Davide Saporita](https://www.linkedin.com/in/davidesaporita/)

![BoolBnB](https://i.imgur.com/rNNAGnZ.png)

BoolBnB è un’applicazione web che mette in contatto persone in cerca di un alloggio o di una camera per brevi periodi. Attraverso BoolBnB i proprietari possono inserire le informazioni dei loro alloggi che desiderano affittare per cercare utenti interessati.

[![GitHub stars](https://img.shields.io/github/stars/davidesaporita/boolbnb?style=social&label=Star&maxAge=2592000)](https://GitHub.com/davidesaporita/boolbnb/stargazers/)
[![GitHub watchers](https://img.shields.io/github/watchers/Naereen/StrapDown.js.svg?style=social&label=Watch&maxAge=2592000)](https://GitHub.com/Naereen/StrapDown.js/watchers/)


## Main features
L’applicazione è sviluppata in Laravel e fornisce le seguenti funzionalità principali:
- registrazione di utenti, 
- l’inserimento di alloggi geo-localizzati (Algolia Places API), 
- piattaforma di pagamenti per annunci sponsorizzati (Braintree SDK) 
- visualizzazione grafica delle statistiche (Chart.js)

## Client needs
La richiesta prevedeva lo sviluppo di un’app per trovare e gestire l’affitto di alloggi. Gli utenti interessati devono avere la possibilità di visualizzare una lista di possibili alloggi filtrabili mediante un’apposita pagina di ricerca, e di accedere ad una pagina di dettaglio. Trovato l’alloggio desiderato, l’utente avere la possibilità di contattare il proprietario per richiedere informazioni. I proprietari devono avere la possibilità di sponsorizzare i propri alloggi, mettendoli in evidenza in home page e nella pagina di ricerca.

## Design Process
Il team ha strutturato il lavoro partendo dall’identificazione delle entità fondamentali del progetto per la costruzione del database. Parallelamente sono state sintetizzate in modo visuale le funzionalità base richieste dal cliente e realizzato un flow-chart per descrivere il flusso degli utenti nell’app. Su tali basi si è predisposto il lavoro di sviluppo dell’applicazione lato backend, al fine di implementare le funzionalità richieste ed aggiuntive. La seconda metà del lavoro è stata dedicata in gran parte al design visuale dell’applicazione, prima mediante la realizzazione dei layout in Adobe XD e poi implementando gli stili.

## Tools and Technologies
Linguaggi:
* HTML5
* CSS3 (SCSS)
* JavaScript ES6
* Php | Framework: Laravel 7
* MySQL

JavaScript Libraries:
* places.js 
* chart.js
* handlebars
* leaflet
* fortawesome/fontawesome-free

Php Libraries:
* braintree/braintree_php
* nesbot/carbon

App/Software:
* Visual Studio Code
* dbdiagram.io
* Google Meet
* Lark
* Trello
* Adobe Illustrator
* Adobe XD

## Mobile mockup (iPhoneX)
![BoolBnB](https://i.imgur.com/fSsB6Gm.png)

## License

[![License](http://img.shields.io/:license-mit-blue.svg?style=flat-square)](http://badges.mit-license.org)

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2020 © <a href="http://fvcproductions.com" target="_blank"></a>