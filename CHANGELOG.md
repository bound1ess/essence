# Changlelog and upcoming features

## Upcoming

### 1.3.0

This release will be dedicated to providing more readable and informative error messages.
- handle `not` keyword properly (show full error message)
- when doing some sort of comparison, show *diff* (difference between the two values)

## Changes

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
