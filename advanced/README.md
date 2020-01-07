# Programmeren 2 Advanced

## Algemene informatie
- Zelfde tentamen als regulier
- Uitgebreidere (advanced..) technieken
- Eigen inbreng wordt gewaardeerd
- Uitgelezen kans voor kennisvergroting!
- Per les vervolg van eigen ‘framework’

Mis je basiskennis? Vergeet dan de reguliere les niet!

## Weekindeling (kan veranderen adhv feedback in de les)

### W1 (OOP part 1):
- Classes
- Public/private
- Standard PHP Classes

### W2 (OOP part 2):
- Extends
- Interface/Implements
- Statics/Const
- Namespaces

### W3 (Databases):
- PDO Abstraction (Prepared statements & Transactions)
- Smart abstraction layer for DB

### W4 (Autoloading & Templating):
- Industry standards (autoloading, config includes, UTF-8, phpDoc, etc.)
- Composer
- Templating

### W5 (Back to basics)
- Basic PHP principles in OOP standards
- Abstract vs. Interface
- Traits

### W6 (Extra subjects):
- Debugging (with phpStorm & xDebug)
- Phalcon (Real-life PHP framework)

### W7 (Cherry on the cake):
- Custom (error) logging
- Magic methods
- Chaining
- Basic unit testing

### W8 (last week):
- Code delen
- Vrije invulling op aanvraag
- Oefententamen

## Werkomgeving
- [PHPStorm](https://www.jetbrains.com/phpstorm/download/)
Je kunt voor PHPStorm een [account](https://www.jetbrains.com/shop/eform/students) krijgen met je HR-email.
- Vagrant box [Volg de README voor installatie instructies](https://github.com/antwanvdm/php7-vagrant).

Er is 1 aanpassing nodig in de vagrant box die je moet doorvoeren:
```$bash
vagrant ssh
sudo nano /etc/nginx/sites-enabled/php7-vagrant.conf

Aanpassen volgende regel:
    location / {
        try_files $uri @phalcon;
    }

Naar:
    location / {
#        try_files $uri @phalcon;
        autoindex on;
    }

(bestand opslaan, sluiten met crtl-x)
sudo service nginx restart
```

## Huiswerk
Huiswerk zal per week worden aangevuld. Ook de voorbeelden uit de les zullen hier te vinden zijn
als naslagwerk voor de opdrachten.
 
- [Week 1](week1/README.md)
- [Week 2](week2/README.md)
- [Week 3](week3/README.md)
- [Week 4](week4/README.md)
- [Week 5](week5/README.md)
