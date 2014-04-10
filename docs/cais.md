# PHPerian CAIS Documentation

Every CAIS report that you send to Experian contains several blocks, one for
every submember (or "source code") under your account.
Each one of these blocks contains multiple records for each customer, sandwiched
between a header and footer.

## Collections

The header, footer, and body records are all collections for various attributes
(although you don't need to worry about the footer as it is generated
automatically).
Each header, footer and record object all have difference attributes associated
with them. For example, the header has 9 attributes regarding the submember
branch; the record collection has 42 all about the customer.

## Collection Attributes

There are several ways to access the attributes from a collection object. Assume
`X` is the attribute identifier with the first letter capitalised.

A collection object can also be treated just like an array; the PHP SPL
interfaces allow its attributes to be accessed using array notation,
`$collectionObject['attributeIdentifier']`, and `foreach` - as well as the
`count` function.

#### Return Attribute Value

- `$attributeValue = $collectionObject->getX()`
- `$attributeValue = $collectionObject->X`

#### Set Attribute Value

- `$collectionObject->setX($value)`
- `$collectionObject->X = $value`

#### Fetch Attribute Object

- `$attributeObject = $collectionObject->fetchX()`

### CAIS Format

The final method of a collection object, `getString()`, concatenates all
attributes in CAIS-string format, returning the 530 character line ready for the
final report.

This can also be achieved using type-casting, `$caisString = (string)
$collectionObject` thanks to the `__toString()` magic method (however,
type-casting will return an empty string, rather than false, in the event of an
error).

## Attribute Object

After fetching the attribute object, several methods are available (as defined
in `PHPerian\CAIS\Interfaces\Attribute`).

#### `getStartByte()`

A line within a CAIS report is 530 characters long, with a header, footer and
record all taking up one line each. `getStartByte()` returns the zero-based
position along a collection line that the attribute starts.

Please note that the zero-based position is how PHP deals with strings; Experian
define the start byte from a one-based position. Attribute definitions take what
is suppled in the Experian *CAIS2007 File Layout Specification Version 3*
document and convert them into the numbers required by PHP.

#### `getEndByte()`

Subsequently, `getEndByte()` returns the zero-based position along a collection
line that the attribute ends.


#### `getLength()`

Calculated from the start and end bytes, this method returns how many characters
an attribute takes up on a collection line.

#### `getName()`

Returns the name of the attribute as supplied in the Experian specification.
Most attribute identifiers are a camel-cased version of the attribute name.

#### `getPadding()`

If the value of the attribute does not take up the full amount of characters
assigned to it on the collection line, what character should fill the empty
spaces?

For example: if an attribute took up 5 characters but the value - `PHP` - only
took up three, then a padding of `@` would produce (with left justification)
`PHP@@`.

Defaults to a blank space if not specificed in the attribute definition.

#### `getJustification()`

If the value of the attribute does not take up the full amount of characters
assigned to it on the collection line, should it be left or right alligned?

Using the example above, if the justification had been right-aligned, then the
output from `getString()` would have been `@@PHP`.

It returns a boolean value depending on left (`true`) or right (`false`); since
this isn't the easiest thing to remember, the constants
`PHPerian\CAIS\Interfaces\Attribute::JUSTIFY_LEFT` and
`PHPerian\CAIS\Interfaces\Attribute::JUSTIFY_RIGHT` are provided.

Defaults to left justification if not specified in the attribute definition.

#### `getValue()`

Returns the value of the attribute. This will be a PHP data-type, not
necessarily a string.

Defaults to `null` if not set with `setValue($value)` or alternative methods.

#### `setValue($value)`

Set the value of the attribute to the value specified. Each attribute accepts a
specific data-type, and the exception `PHPerian\Exceptions\InvalidDataType` will
be thrown if it is incorrect.

Another exception, `PHPerian\Exceptions\DataTruncated`, will be thrown if the
value exceeds the maximum length defined for that attribute - the value will
still be set however, and the exception caught and ignored if so desired.

#### `getString()`

Returns the value in CAIS-string format (padded to the exact character length
and justified).

# Attribute Definitions

## Header Attributes

|Identifier                     |Type           | Length|Default               |
|:------------------------------|:--------------|------:|:---------------------|
|`headerIdentifier`             |Read Only      |     20|`              HEADER`|
|`sourceCodeNumber`             |Integer        |      3| NULL                 |
|`dateOfCreation`               |Date           |      8| NULL                 |
|`companyName`                  |Alphanumeric   |     60| NULL                 |
|`filler`                       |Read Only      |     20|`                    `|
|`version`                      |Alphanumeric   |      8|`CAIS2007`            |
|`overdraftReportingCutoff`     |Integer        |      6|`0`                   |
|`cardsBehaviouralSharingFlag`  |Boolean        |      1|False                 |
|`endFiller`                    |Read Only      |    434|Blank                 |
