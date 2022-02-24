[![run-tests](https://github.com/worksome/model-attributes/actions/workflows/run-tests.yml/badge.svg)](https://github.com/worksome/model-attributes/actions/workflows/run-tests.yml)
[![PHPStan](https://github.com/worksome/model-attributes/actions/workflows/phpstan.yml/badge.svg)](https://github.com/worksome/model-attributes/actions/workflows/phpstan.yml)


Model attributes are dynamically generated values for models. They are used as eloquent relationships which can be eager loaded.

## Installation

You can install the package via composer:

```bash
composer require worksome/model-attributes
```

## Usage

Assuming we have the following table structure:
```injectablephp
users:
- id

reviews:
- id
- user_id
- stars
```

And the following models:
```injectablephp
class User extends Model 
{
    public function reviews()
    {
        $this->hasMany(Review::class);
    }
}
```

```injectablephp
class Review extends Model 
{
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
```

We can add a `rating` property to each user that is the calculated average of a users reviews. First we're going to create a Model attribute:
```injectablephp
class Rating extends \Worksome\ModelAttributes\ModelAttribute
{
    protected $casts = [
        'id' => 'int',
        'user_id' => 'int',
        'rating' => 'float',
    ];

    public static function attributeGlobalScope(Builder $query): void
    {
        $ratingModel = new Rating();

        $query
            ->groupBy($ratingModel->user()->getForeignKeyName())
            ->addSelect([
                $ratingModel->getKeyName(), // id
                $ratingModel->user()->getForeignKeyName(), // user_id
                \DB::raw('avg(stars) as rating'), // rating
            ]);
    }
}
```
and add it as a relationship to the user model
```injectablephp
public function rating(): \Worksome\ModelAttributes\AttributeRelation|\Illuminate\Database\Eloquent\Relations\HasOne
{
    return new \Worksome\ModelAttributes\AttributeRelation(
        $this->hasOne(Rating::class)
    );
}
```

So that it can be used like so:
```injectablephp
$user = User::first();
$rating = $user->rating; // The rating model attribute created above
$rating->rating // the actual rating
```

Since model attributes are essentially dynamically generated data, and the rating is a scalar, we can override the `getValue()` method of a model in order to "reach" the rating faster:
```injectablephp
public function getValue()
{
    return $this->rating;
}
```
And now the rating can be accessed like so:
```injectablephp
User::first()->rating;
```
And because it's a relationship it can be eager loaded:
```injectablephp
User::with('rating')->get()->map->rating;
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Marian Hodorogea](https://github.com/ahmes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
