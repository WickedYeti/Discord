## Discord\Event

Gestionnaire d'�venements.

### Utilisation

```php
<?php

use Discord\Event;

$channel = new Event\Channel;
$channel->on('greet', function($name)
{
    echo 'Hello ', $name, ' !';
});

$channel->fire('greet', 'you'); // Hello you !
```

Il est possible d'attacher des objets en tant qu'�couteurs.
Les m�thodes ayant le meta-tag `@event` �couteront un �venement sp�cifique.

```php
<?php

class Listener
{
    /**
     * @event 'greet'
     */
     public function greet($name)
     {
        echo 'Hello ', $name, ' !';
     }
}

use Discord\Event;

$channel = new Event\Channel;
$channel->attach(new Listener);
```

### Valeur de retour

Il est possible de d�finir une valeur ou type de valeur attendue.
Lors de l'acquisition de cette valeur, l'�v�nement est stopp�, sauf si `true` est pass� en 3e param�tre.

#### Acquisition d'une classe

```php
<?php

use Discord\Event;

$channel = new Event\Channel;
$channel->expect('user.create', 'App\Model\User');

$channel->on('user.create', function()
{
    return new App\Model\User;
});

$user = $channel->fire('user.create');
```

#### Acquisition d'autres valeurs

```php
<?php

$channel->expect('foo', true);
$channel->expect('foo', false);
$channel->expect('foo', 'some string');
$channel->expect('foo', 50);
```

#### Acquisition par callback

Le callback re�oit la vleur en argument, s'il retourne `true`, la valeur est retourn�e.

```php
<?php

$channel->expect('foo', function($value)
{
    return is_something($value);
});
```

### Hub : �venements globaux

Gestion statique, pour plus de souplesse.

```php
<?php

use Discord\Event;

Event\Hub::on('greet', function($name)
{
    echo 'Hello ', $name, ' !';
});

Event\Hub::fire('greet', 'you'); // Hello you !
```