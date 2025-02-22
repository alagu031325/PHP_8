<?php

declare(strict_types=1);

namespace Framework;

//used to inspect a class - look into its properties
use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{
    private array $definitions = [];
    private array $resolved = [];

    public function addDefinitions(array $newDefinitions)
    {
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    public function resolve(string $className)
    {
        $reflectionClass = new ReflectionClass($className);

        //validate the class - since abstract classes cant be instantiated so we need to check if the dependancy is a regular class
        if (!$reflectionClass->isInstantiable())
        {
            throw new ContainerException("Class {$className} is not instantiable");
        }
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor)
        {
            return new $className;
        }

        $parameters = $constructor->getParameters();

        if (count($parameters) === 0)
        {
            return new $className;
        }

        //dependencies need by the controller
        $dependencies = [];

        //validating each parameter
        foreach ($parameters as $param)
        {
            $name = $param->getName();
            //If data type is string or boolean we cant instantiate a class for this parameter
            $type = $param->getType();
            if (!$type)
            {
                throw new ContainerException("Failed to resolve class {$className} beacuse parameter {$param} is missing a type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin())
            {
                throw new ContainerException("Failed to resolve class {$className} because invalid param name.");
            }

            $dependencies[] = $this->get($type->getName());
        }

        //$dependencies act as arguments to the constructor function of the controller which is to be instantiated
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions))
        {
            throw new ContainerException("Class {$id} does not exist in container");
        }
        if (array_key_exists($id, $this->resolved))
        {
            return $this->resolved[$id];
        }

        $factory = $this->definitions[$id];
        $dependency = $factory($this);

        $this->resolved[$id] = $dependency;

        return $dependency;
    }
}
