# Platter

A basic application dependency resolver.

## Usage

_Package installation instructions to be defined_

Create a new `Platter` instance with your definitions:

```php
$factory = new Platter(array(
	'dbuser' => 'admin',
	'dbpassword' => 'password',
	'dbname' => 'test',
	'dbhost' => '0.0.0.0',
	'connectionstring' => function ($container) {
		return "mysql:dbname={$container->get('dbname')};host={$container->get('dbhost')}";
	},
	'pdo' => function ($container) {
		return new PDO(
			$container->get('connectionstring'),
			$container->get('dbuser'),
			$container->get('dbpassword')
		);
	},
	'repository' => function ($container) {
		return new Repository($container->get('pdo'));
	}
));
```

To retrieve an object from your container, just use the `get` method:

```php
$repository = $factory->get('repository');
```

You can also link `Platter` containers together, one container is considered
the child and the other the parent.

```php
$parent = new Platter(array(
	'dbuser' => 'xyz',
	'dbpassword' => 'abc'
));

$factory = new Platter(array(
	'DataSource' => function ($container) {
		return new DataSource(
			$container->get('dbuser'),
			$container->get('dbpassword')
		);
	}
), $parent);

$ds = $factory->get('DataSource');
```

When resolving dependencies if the child does not have a definition for
the dependency the dependency will be obtained from the parent.

**Note:** The direction in which dependencies are resolved is unidirectional,
a parent will not check it's children for a dependency. Therefore,
definitions attached to a container can only access other definitions
within that container and it's parents but not it's children.

The following will not work:

```php
$parent = new Platter(array(
	'DataSource' => function ($container) {
		return new DataSource(
			$container->get('dbuser'),
			$container->get('dbpassword')
		);
	}
));

$factory = new Platter(array(
	'dbuser' => 'xyz',
	'dbpassword' => 'abc'
), $parent);

$ds = $factory->get('DataSource'); // "Identifier 'dbuser' is not defined"
```

This may cause confusion if not understood:

```php
$parent = new Platter(array(
	'name' => 'Joe',
	'example' => function ($container) {
		return $container->get('name');
	}
));

$factory = new Platter(array(
	'name' => 'Michael'
), $parent);

echo $factory->get('name'); // "Michael"
echo $factory->get('example'); // "Joe"
```

The `example` definition does not have access to the `name` definition
from the child and so the `name` definition from the parent container
is returned instead.

## Builder interface

Platter also comes with a builder interface to register items using a friendly
and expressive builder interface. Once built the platter is immutable.

```php
$builder = new Platter\Builder;
$parent = $builder
	->register('dbuser', 'xyz')
	->register('dbpassword', 'abc')
	->build();

$builder = new Platter\Builder;
$factory = $builder
	->register('DataSource', function ($container) {
		return new DataSource(
			$container->get('dbuser'),
			$container->get('dbpassword')
		);
	})
	->connect($parent)
	->build();
```

To show all available items served by the platter:

```php
$factory->available(); // array('DataSource', 'dbpassword', 'dbuser');
```

To show the items that the platter instance itself defines:

```php
$factory->defined(); // array('DataSource');
```