# Semestro-projektas-DD

**Team:**  
Arvydas Apulskis IFF-7/13  
Marius Žilgužis IFF-7/8   
Modestas Gužauskas IFF - 7/8  
Valdas Gudelevičius IFF-7/8  

### General information
**To get started:**  
1. git clone https://github.com/ArvApu/Semestro-projektas-DD.git
    * *```git pull``` if already cloned* 
1. cd Semestro-projektas-DD 
1. composer install  
1. composer require annotations
1. git checkout development
   * *create your branch ```git branch (your name)-features```*
   * *if you have branch check if it is not behind development if it is:*  
   ```git pull origin development``` 
1. php bin/console server:run  

_**Note: php and composer should be instaled. If using phpStorm enable Symfony plugin for project.**_    

**Extras:**  

Debugging tool:
```
$ php bin/console
```

Generate route, controller and view:
```
$ php bin/console make:controller NameController
```

Preview all routes :  
```
$ php bin/console debug:router
```

Test route matches:  
```
$ php bin/console router:match path
```

Make enityt (model):
```
$ php bin/console make:entity EntityName
```

Generate migration
```
$ php bin/console make:migration
```

GRUD (Create, Read, Update, Delete):
```
$ php bin/console make:crud ExistingEntity
```

Setup database connection:
```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```  
More info at:
[Symfony documentation](https://symfony.com/)
