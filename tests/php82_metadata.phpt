--TEST--
Dynamic property support in php 8.2+
--SKIPIF--
<?php if (!class_exists('AllowDynamicProperties')) die('skip PHP >=8.2 only'); ?>
--FILE--
<?php
error_reporting(E_ALL);
ini_set('display_errors', 'stderr');

function dump($x) {
    var_export($x);
    echo "\n";
}

function dump_attributes(string $class) {
    echo "Attributes of $class:\n";
    foreach ((new ReflectionClass($class))->getAttributes() as $attribute) {
        echo "- " . $attribute->getName() . "\n";
    }
}

$node = new ast\Node();
$node->undeclaredDynamic = 123;
dump($node);
$metadata = new ast\Metadata();
$metadata->undeclaredDynamic = 123;
dump($metadata);
dump_attributes(ast\Node::class);
dump_attributes(ast\Metadata::class);
--EXPECTF--
ast\Node::__set_state(array(
   'kind' => NULL,
   'flags' => NULL,
   'lineno' => NULL,
   'children' => NULL,
   'undeclaredDynamic' => 123,
))
Deprecated: Creation of dynamic property ast\Metadata::$undeclaredDynamic is deprecated in %sphp82_metadata.php on line 21
ast\Metadata::__set_state(array(
   'kind' => NULL,
   'name' => NULL,
   'flags' => NULL,
   'flagsCombinable' => NULL,
   'undeclaredDynamic' => 123,
))
Attributes of ast\Node:
- AllowDynamicProperties
Attributes of ast\Metadata:
