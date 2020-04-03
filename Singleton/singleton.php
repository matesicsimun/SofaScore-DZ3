<?php


class singleton
{
    private static $instance = null;

    private function __construct()
    {

    }

    public static function get_instance() : singleton{
        if (self::$instance === null){
            self::$instance = new singleton();
        }

        return self::$instance;
    }
}

$instance_a = singleton::get_instance();
$instance_b = singleton::get_instance();

var_dump($instance_a);
var_dump($instance_b);

echo spl_object_hash($instance_a);
echo "\n";
echo spl_object_hash($instance_b);
echo "\n";

if (spl_object_hash($instance_a) === spl_object_hash($instance_b)){
    echo '$instance_a je isti objekt kao i $instance_b';
}
