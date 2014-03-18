# Loath

Crafted with hatred by [Selvin Ortiz][developer] for [Craft CMS][craftcms]

**Loath** is a sample plugin designed to illustrate unit testing in [Craft][craftcms]  
Its goal is to help you get started with unit testing and write testable code.

## Requirements
- PHP 5.3.2 _or above_
- Craft 1.3 Build 2507 _or above_

## Setup
This is a developer targeted plugin so, I would recommend that you...

1. Download or clone the repo `git clone git@github.com:selvinortiz/craft.loath.git`
2. Place inside `craft/plugins` or symlink to `craft/plugins/loath`
3. Run the test suite, study the code & comments, contribute.

## Assumed Directory Structure

```
@craft = /path/to/site/craft
@craftTests = @craft/app/tests
@craftVendor = @craft/app/vendor
@pluginTestDir = @craft/plugins/loath/tests

/path/to/site/craft
  - /app
    - /tests
    - /vendor
  - /plugins
    - loath
      - tests
```

## Running PHPUnit
Running plugin tests via phpunit within craft can be tricky but hopefully this will get you started in the right direction.

Here is the example command that should work in most cases.

### Full Command

```
/path/to/php -c /path/to/php.ini @craftVendor/phpunit/phpunit/phpunit.php --bootstrap @craftTests/bootstrap.php --configuration @craftTests/phpunit.xml @pluginTestDir

```

### Command Explained

_These commands should be executed as a single command with exactly one space between each step._

#### Invoke the *PHP* executable and pass along our *php.ini*
`php -c /etc/php5/apache2/php.ini`

#### Run *PHPUnit* through *PHP*
`/path/to/site/craft/vendor/phpunit/phpunit/phpunit.php` or `which phpunit`

#### Tell *PHPUnit* what `bootstrap` file to use
`--bootstrap /path/to/site/craft/app/tests/bootstrap.php`

#### Tell *PHPUnit* to use the configuration file provided by *Craft*
`--configuration /path/to/site/craft/app/tests/phpunit.xml`

#### Finally, tell *PHPUnit* where to find your plugin test directory
`/path/to/site/craft/plugins/yourplugin/tests`

### Bundled Command
This repo includes a shell script that you can edit with your paths and run it.

The `loath/tests/run.sh` file should be executable `+x` and the paths should be update, once you've address that you can simply...

- cd into `craft/plugins/loath/tests`
- run `./run.sh`

## Issues
The biggest issues I've come across during testing have to do with bootstrapping dependencies.

Some issues are really hard to diagnose and explain and in effort to keep this short... I figured that rather than explaining every single issue I've found, I'd just post what is currently working for me and other's I've helped and if you can't get things running just post a comment here and we can sort it out together.

## Changelog
### 1.1.0
- Added the `models/LoathModel`
- Fixed a path issue in the bundled `run.sh`
- Improved the way dependencies are loaded
- Improved the way static method dependencies are handled

### 1.0.0
- Initial release

## Feedback & Support
If you have any feedback or questions, please reach out to me on twitter [@selvinortiz][developer]

## License & Credits
Loath is open source software licensed under the [MIT license][license]

![Open Source Initiative][osilogo]

[developer]:http://twitter.com/selvinortiz "@selvinortiz"
[license]:https://raw.github.com/selvinortiz/craft.loath/master/LICENSE "MIT License"
[craftcms]:http://buildwithcraft.com "Craft CMS"
[pixelandtonic]:http://pixelandtonic.com "Pixel & Tonic"
[osilogo]:https://github.com/selvinortiz/craft.loath/raw/master/resources/img/osilogo.png "Open Source Initiative"
