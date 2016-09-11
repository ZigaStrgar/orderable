# Orderable Laravel Package

This is my very first Laravel package. I find it useful for me :) When I work with projects where I need to run a lot of `ORDER BY` queries.

## Instalation

Add the Orderable package to your `composer.json` file.

```json
{
    "require": {
        "zigastrgar/orderable": "^1.0"
    }
}
```

## Usage

Go to any model and add this to the model.

```php
use ZigaStrgar\Orderable\Orderable;

class Article extends Model {
    use Orderable;
    
    public function orderable(){
        return [
            'id' => 'DESC',
            'title' => 'ASC',
            'user_id'
        ];
    }
}
```

If you don't use the key like in `user_id` case it will default to `DESC`;

### Running "Orderable"

It's super simple

```php
    Article::all();
```

### Running without "Orderable"

Same. Very simple stuff.
```php
    Article::unorderable();
```