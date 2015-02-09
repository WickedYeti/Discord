## Event component

Gestion des �v�nements en PHP, essence m�me du framework Discord.

**�coute d'un �v�nement** via un simple callback.

```php
<?php

use Discord\Event;

$channel = new Event\Channel;
$channel->on('greet', function($name)
{
    echo 'Hello ', $name, ' !';
});
```

**�coute d'un �v�nement** via annotations dans un objet.

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

Vous pouvez attacher autant de callback ou d'objet que vous voulez.

**D�clenchement d'un �v�nement** : tous les callbacks seront �xecut�s.

```php
<?php

$channel->fire('greet', 'you'); // Hello you !
```

**D�finition d'une valeur de retour** : si un callback retourne la valeur attendue (instance, bool, string),
elle sera �galement retourn�e � l'utilisateur.

Dans le cas o� plusieurs callback retourne la valeur attendue, seul le dernier est pris en compte.
Si vous passez le 3e param�tre � `true`, l'�xecution s'arr�te au 1e qui retournera la valeur attendue.

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