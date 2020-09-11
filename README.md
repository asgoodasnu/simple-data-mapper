# simple-data-mapper

Require with composer: 

`composer req asgoodasnu/simple-data-mapper:*@dev`


Then in your Project, add a ConfigurationBuilder to add your own mappings. 
You have to implement `ConfigurationHandler` Interface
````
<?php

declare(strict_types=1);

use Asgoodasnew\SimpleDataMapperBundle\Collector\ConfigurationHandler;
use Asgoodasnew\SimpleDataMapperBundle\Configuration\Configuration;
use Asgoodasnew\SimpleDataMapperBundle\Loader\PhPFileLoader;

class SimpleDataMapperConfigurationBuilder implements ConfigurationHandler
{
    public function handle(Configuration $configuration): void
    {
        $configuration
            ->addMapping(
                'name',
                new PhPFileLoader('path/to/file/returns/php/array.php'),
                function (string $s1, string $s2) {
                    return [$s1, $s2];
                })
    }
}
````

Now you can autowire the simple data mapper
```
public function __construct(SimpleDataMpper $simpleDataMapper)
{
  echo $simpleDataMapper->map('name', ['key1, 'key2'];

  // With example data file, this would print "Hallo"
}
```

Example PHP Data file
```
<?php

  return [
    'key1' => [
      'key2' => 'Hallo'
    ]
  ];
```