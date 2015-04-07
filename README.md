# Essence 1.5.1 [![Build Status](https://travis-ci.org/bound1ess/essence.svg?branch=master)](https://travis-ci.org/bound1ess/essence)

Essence is a very flexible BDD style assertion framework for PHP that fits into existing
 PHPUnit projects nicely.

## Installation

```
composer require --dev bound1ess/essence
```

## The Idea

In most PHP testing frameworks, you are tied to *concrete matcher names* (e.g., `assertEqual`, `shouldHaveType`).
I don't like that.
That's why I created Essence.

## Usage

In order to run a matcher you need to specify it in the *query string*.
So what is a query string? Have a look:

```php
this("someValue")->should_have_length_of(10); # => "someValue should have length of 10"
expect(123)->toBeAbove(120); # => "expect 123 to be above 120"

$elements = [1, 2, 3, 4, 5];
these($elements)->values->should_contain(5); # => "these elements should contain a value '5'"

expect(null)->not()->to()->beNull(); => "expect NULL not to be NULL"
```

Yes, Essence is smart enough to handle all these cases just as you would expect it to do.
So, how do you build a query string (or *assertion*)?

1. Decide if you need to configure a matcher you plan to use. As for now there are two only matchers that can be used in *configuration* mode - `ValuesMatcher` and `KeysMatcher`.
2. Determine what matcher you will need to use to get the job done. Is it `ThrowMatcher`, or, say, `RespondMatcher`?
3. Add some *links* to make the assertion **readable**.
4. Choose an appropriate entry point (`expect`, `this`, `these` etc).
5. Pass a proper value and arguments.
6. If you want to, add `->go()` to immediately perform validation. I'll tell you more about that later.

### Configuration

First of all, Essence leverages the singleton pattern to persist all its important data during the runtime. It means that this expression will always be equal to `true`:

```php
spl_object_hash(essence()) == spl_object_hash(essence());
```

You can configure Essence by using `configure` method:

```php
essence()->configure(function($config) {
    return array_merge($config, [
        "exception" => "Your\Custom\AssertionException",
    ]);
});
```

Available configuration options:

| Name | Possible value |
-------|-----------------
| exception | fully qualified class name (as a string) |
| implicit_validation | a boolean value (`true` or `false`) |
| links | an array (won't be merged automatically) |
| matchers | an associative array *name => aliases* (won't be merged automatically) |

### Explicit and implicit, validateAll and PHPUnit extension

If you don't want to write `->validate()` or `->go()` every time, you can enable *implicit validation*:

```php
essence()->configure(function() {
    return [
        "implicit_validation" => true,
    ];
});
```

It will validate the last (previous) assertion when you create a new one.
Or, even better, just use the PHPUnit extension as shown below:

```php
class MyTestCase extends Essence\Extensions\PhpunitExtension
{

    // Your assertions here.
}
```

It'll do the job for you, no need to configure anything or call `go/validate`.

### Verbose mode

This line of code will throw an `Essence\Exceptions\AssertionException` by default:

```php
expect(10)->to_be_equal_to(15)->validate(); // You can also use "go" instead of "validate".
```

However, if you pass `true` to `validate/go`, Essence will dump all important data and just `exit`.

```php
expect(10)->to_be_equal_to(15)->validate(true);
```

```shell
vendor/bin/phpunit
# ........
Value: 10
Arguments:
  #1: 15
```

## Cheatsheet

### Entry points

- essence
- it
- that
- this
- these
- those

### Links

- of
- have
- be
- at
- to

### Matchers

| Name | Aliases |
-------|----------
| TypeMatcher     | an, a, type      |
| ContainMatcher  | contain, include |
| PositiveMatcher | ok, fine         |
| TrueMatcher     | true             |
| FalseMatcher    | false            |
| NullMatcher     | null             |
| EmptyMatcher    | empty            |
| EqualMatcher    | equal            |
| LikeMatcher     | like             |
| AboveMatcher    | above            |
| BelowMatcher    | below            |
| LeastMatcher    | least            |
| MostMatcher     | most             |
| WithinMatcher   | within           |
| LengthMatcher   | length           |
| MatchMatcher    | match            |
| KeysMatcher     | key, keys        |
| ValuesMatcher   | value, values    |
| ThrowMatcher    | throw, raise     |
| RespondMatcher  | respond          |
| CloseMatcher    | close            |

## License

The MIT License (MIT).

## Development

The `Makefile` contains all sorts of useful tasks.

### Running tests

```shell
make run-tests
```

### Creating code coverage report

```shell
make coverage-report coverage-report-server
```

### Building documentation

```shell
make build-docs docs-server
```
