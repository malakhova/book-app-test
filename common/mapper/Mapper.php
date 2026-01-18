<?php

namespace common\mapper;

class Mapper
{
    /**
     * @param array $source
     * @param string $targetClassName
     * @param array $config
     * @return mixed
     */
    public function map(array $source, string $targetClassName, array $config = []): object
    {
        $target = new $targetClassName();
        foreach ($source as $property) {
            $target->{$property} = $this->getValue($source, $property, $config);
        }
        return $target;
    }

    /**
     * @param array $sources
     * @param string $targetClassName
     * @param array $config
     * @return array
     */
    public function mapItems(array $sources, string $targetClassName, array $config = []): array
    {
        return array_map(
            function ($source) use ($targetClassName, $config) {
                return $this->map($source, $targetClassName, $config);
            },
            $sources
        );
    }

    /**
     * @param array $source
     * @param string $property
     * @param array $config
     * @return mixed|null
     */
    private function getValue(array $source, string $property, array $config): mixed
    {
        if (isset($config[$property])) {
            $property = $config[$property];
        }

        return $source[$property] ?? null;
    }
}
