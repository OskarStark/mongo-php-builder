# Code Generator for MongoDB PHP Library

This subproject is used to generate the code that is committed to the repository.
The `generator` directory is not included in `mongodb/builder` package and is not installed by Composer. 

## Contributing

Updating the generated code can be done only by modifying the code generator, or its configuration.

To run the generator, you need to have PHP 8.1+ installed and Composer.

1. Move to the `generator` directory: `cd generator`
1. Install dependencies: `composer install`
1. Run the generator: `./generate`

## Configuration

The `generator/config/*.yaml` files contains the list of operators and stages that are supported by the library.
