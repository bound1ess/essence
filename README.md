# Essence [![Build Status](https://travis-ci.org/bound1ess/essence.svg?branch=master)](https://travis-ci.org/bound1ess/essence)

Essence is a very flexible BDD style assertion framework for PHP that fits into existing
 PHPUnit projects nicely.

## Installation

```
composer require --dev bound1ess/essence
```

## The Idea

...

## Usage

...

## Cheatsheet

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
