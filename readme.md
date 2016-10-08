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

OR

Simply run this in command line

```bash
composer require zigastrgar/orderable
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

If you don't use the key like in `user_id` case it will default to `DESC`.

### Running "Orderable"

It's super simple.

```php
Article::all();
```

#### Apply only specific rule

From now on, you can also do something like this.

```php
Article::order(); //Equals to Article::all();
```

or

```php
Article::order(['title'])
```

and only rule for `title` will bi applied.


### Running without "Orderable"

Same. Very simple stuff.
```php
Article::unorderable();
```

No scopes applied.

#### Remove specific rule

```php
Article::unorderable(['title']);
```

In this case the rule for title won't be applied.