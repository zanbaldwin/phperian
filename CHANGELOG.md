# Changelog

## 0.2.4-alpha

- Fix mis-referenced variables in various files/methods over multiple commits.
- Only set attribute values in mass-assignment if the value is not null.
- Fix mis-referenced method for returning attributes value-array (no arguments required).
- Update the body record attribute collection, split the `accountNumber` attribute into `submember`, `customer`, `loan`, and `jointAccount`.
- Rename the attribute identifiers to longer, more descriptive IDs in `PHPerian\CAIS\Report\Block\Header` collection; update constructor to reflect those changes.
- Allow an integer (or string-representation of) to be passed as a boolean value for the `PHPerian\CAIS\Report\Block\Attribute\Boolean` attribute class, providing it is zero or one.
- Update attribute definitions.
- Make sure that `AttributeInterface::READONLY` attributes have their default value set.

## 0.2.3-alpha

- Create changelog markdown file.
