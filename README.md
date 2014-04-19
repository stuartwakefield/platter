# Platter

A basic application dependency resolver.

	$parentPlatter = new ParentPlatter(array(
		'dbuser' => 'xyz',
		'dbpassword' => 'abc'
	));

	$platter = new Platter(array(
		'DataSource' => function ($container) {
			return new DataSource(
				$container->get('dbuser'),
				$container->get('dbpassword')
			);
		}
	), $parentPlatter);

	$ds = $platter->get('DataSource');

Platter also comes with a builder interface to register
items in a friendly interface. Once built the platter
is immutable.

	$builder = new Platter\Builder;
	$parentPlatter = $builder
		->register('dbuser', 'xyz')
		->register('dbpassword', 'abc')
		->build();

	$builder = new Platter\Builder;
	$platter = $builder
		->register('DataSource', function ($container) {
			return new DataSource(
				$container->get('dbuser'),
				$container->get('dbpassword')
			);
		})
		->connect($parentPlatter)
		->build();

To show all available items served by the platter:

	$platter->available(); // array('DataSource', 'dbpassword', 'dbuser');

To show the items that the platter instance itself defines:

	$platter->defined(); // array('DataSource');
