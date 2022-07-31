<img src="https://s6.uupload.ir/files/logo_2jjj.png" alt="Laravel Setting" />

# Laravel Setting

Easily save, update and get titles, descriptions, and more. it is very easy to use.

This is great for storing and receiving general site information.

## Installation

***requires PHP 8+ and Laravel 9+***

via composer:

```bash
$ composer require RanjbarAli/Laravel-Setting
```

You can publish migration and configuration with:
```bash
php artisan vendor:publish --provider="RanjbarAli\LaravelSetting\LaravelSettingServiceProvider"
```
Migrate:
```bash
php artisan migrate
```

## Usage

#### Initialize
```php
setting()
```

#### Get All *(array)*
```php
setting()->value
```

#### Get One *(string | array | integer | float | boolean)*
```php
setting('key')->value
```

#### Get Multiple *(array)*
```php
setting(['key1', 'key2'])->value
```

#### Update *(boolean)*
```php
setting('key')->set('new value')
```

#### Add *(boolean)*
```php
setting()->add($key, $value, $type)
```
Type must be one of ``"string"`` , ``"array"`` , ``"boolean"`` , ``"integer"`` , ``"float"``

default: ``"string"``

#### Delete *(boolean)*
```php
setting('key')->delete()
```

#### Check Value *(boolean)*
```php
setting('key')->is('value')
```

#### Check Value with Type *(boolean)*
```php
setting('key')->is_exactly('value')
```


#### Check Exists *(boolean)*
```php
setting('key')->exists()
```


#### Recache
```php
setting()->restart()
```

## Examples

#### add() : Add and Get One
```php
setting()->add('key', ['item'], 'array');
setting('key')->value; // Output: ['item']
```
```php
setting()->add('isOffline', true, 'boolean');
setting('isOffline')->value; // Output: true
```
```php
setting()->add('key', 'value');
setting('key')->value; // Output: "value"
```
```php
setting()->add('level', 5, 'integer');
setting('level')->value; // Output: 5
```
```php
setting()->add('score', 6.5, 'float');
setting('score')->value; // Output: 6.5
```

#### set()
```php
setting()->add('key', 'old value');
setting('key')->set('new value');
setting('key')->value; // Output: 'new value'
```

#### Get Multiple 
```php
setting()->add('key1', 'foo');
setting()->add('key2', 'bar');
setting(['key1', 'key2'])->value; // Output: [ 'key1' => 'foo', 'key2' => 'bar' ]
```

#### is()
```php
setting()->add('key', '1');
setting('key')->is(1); // Output: true
```


#### is_exactly()
```php
setting()->add('key', '1');
setting('key')->is_exactly(1); // Output: false
```

#### exists()
```php
setting()->add('key', 'value');
setting('key')->delete();
setting('key')->exists(); // Output: false
```

in blade:
```html
<title> {{ setting('title')->value }} </title>
<meta name="description" content=" {{ setting('description')->value }} " />
```



## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
