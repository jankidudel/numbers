## how to run

* composer install
* sqlite config in a new file .env.local: DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
* php bin/console doctrine:migrations:migrate
* wget https://get.symfony.com/cli/installer -O - | bash 
* symfony server:start  
* open http://127.0.0.1:8001/api/doc  (or whichever port it is on)   
* e.g conversion: 
{
  "original": "MMMCMXCIX",
  "numeralTypeFrom":2,
  "numeralTypeTo": 1
}



## other notes and todo's:

### to-do: 
* proper psr-12
* add tests for every number conversion class
* to make the API more flexible, accept array in /convert endpoint
* correct the namings, split into separate folders/namespaces and other cleaning.
* proper exception handling
* code more to an "interface", rather than actual classes

### notes:
* I didn't focus much on details, int-roman-int conversions were copied from stackoverflow
* I've separated the number conversion logic into 2 separate steps, so it's more flexible/extendable:
** 1st - convert from "any" numeral type to integer
** 2nd - convert from integer to "any" numeral type
* For this I've used "strategy" pattern with dependency injection
