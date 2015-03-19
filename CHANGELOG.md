# Changes and upcoming features

## Upcoming

### 1.5.0

- add `like` matcher (`expect('123')->to_be_like(123)`)
- if no matchers were specified, assume `EqualMatcher`
- update `throw` matcher, add `error_message` and `context` optional parameters

## Changes

### 1.4.1

- the major documentation update

### 1.4.0

This release is dedicated to providing more readable and informative error messages.
- handle `not` keyword properly (show full error message)
- add special *verbose* mode for the purpose of debugging

### 1.3.0

- integrate Essence with PHPUnit (count assertions)

### 1.2.1, 1.2.2

- a problem with incorrect default value of `implicit_validation` (`1.2.0`) was fixed
- a problem with `Essence::validateAll` (introduced in `1.2.0`) was fixed

### 1.2.0

- new configuration option `implicit_validation`, new method `Essence::implicitValidation`
- new validation methods `Essence::validateAll`, `Essence::validate` (alias of `Essence::go`)
- new configuration methods `Essence::addLink` and `Essence::addMatcher`
- wrapper `expect` now works with other data types (not only `Essence` instances)
- `AbstractMatcher` now will automatically replace matcher's `value` property value

### 1.1.0

VarDumper was introduced to provide better, readable error messages.

### 1.0.0

Initial release.
