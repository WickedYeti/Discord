## Discord\Persist

Couche de persistance des donn�es de session.

### Session

```php
<?php

use Discord\Persist\Session;

Session::set('foo', 'bar');

$foo = Session::get('foo'); // bar

Session::drop('foo');

$foo = Session::get('foo'); // null

```

Le provider natif utilise la *dot notation* qui permet de parcourir horizontalement un tableau :

```php
<?php

use Discord\Persist\Session;

Session::set('foo', [
    'bar' => 'baz'
]);

$foo = Session::get('foo.bar'); // baz

```

### Message flash

L'utilisation est la m�me que `Session`, les messages sont cependant consomm�s :

```php
<?php

use Discord\Persist\Flash;

Flash::set('success', 'Yeah !');

$message = Session::get('success'); // Yeah !

$message = Session::get('success'); // null

```

### Authentification

Permet de garder un utilisateur authentifi� et son rang (integer).

```php
<?php

use Discord\Persist\Auth;

Auth::login($rank, $user);

if(Auth::logged()) { ... }

$rank = Auth::rank();
$user = Auth::user();

Auth::logout();

```

### Impl�menter son syst�me de session

Ces 3 classes `Session`, `Flash` et `Auth` utilisent des instances `Session\Native`.
Vous pouvez cependant impl�mentez la votre en utilisant l'interface `Session\Provider`
et en passant l'instance via la m�thode `::provider()` :

```php
<?php

use Discord\Persist\Session;

class MySession implements Session\Provider
{
    ...
}

Session::provider(new MySession);

```