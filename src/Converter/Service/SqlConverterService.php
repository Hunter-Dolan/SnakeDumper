<?php

namespace Digilist\SnakeDumper\Converter\Service;

use Digilist\SnakeDumper\Configuration\DumperConfigurationInterface;

class SqlConverterService extends ConverterService
{

    /**
     * Read the configuration and create the converter service.
     *
     * @param DumperConfigurationInterface $config
     * @return static
     */
    public static function createFromConfig(DumperConfigurationInterface $config)
    {
        $converterService = new static();

        foreach ($config->getTables() as $tableName => $table) {
            foreach ($table->getColumns() as $columnName => $column) {
                $key = sprintf('%s.%s', $tableName, $columnName);
                $converterService->addConvertersFromConfig($key, $column->getConverters());
            }
        }

        return $converterService;
    }
}
