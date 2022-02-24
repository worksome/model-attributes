# This is my package model-attributes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/worksome/model-attributes.svg?style=flat-square)](https://packagist.org/packages/worksome/model-attributes)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/worksome/model-attributes/run-tests?label=tests)](https://github.com/worksome/model-attributes/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/worksome/model-attributes/Check%20&%20fix%20styling?label=code%20style)](https://github.com/worksome/model-attributes/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/worksome/model-attributes.svg?style=flat-square)](https://packagist.org/packages/worksome/model-attributes)

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
