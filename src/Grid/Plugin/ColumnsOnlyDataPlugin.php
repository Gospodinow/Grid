<?php

namespace Grid\Plugin;

use Grid\Plugin\Interfaces\DataPluginInterface;
use Grid\GridRow;

/**
 * Allows grid to have different columns for different profiles
 *
 * @author Gospodinow
 */
class ColumnsOnlyDataPlugin extends AbstractPlugin implements DataPluginInterface
{
    /**
     * Remove all fields that are not in the profile
     * @param array $data
     * @return array
     */
    public function filterData(array $data) : array
    {
        $names = [];
        foreach ($this->getGrid()->getColumns() as $column) {
            $names[] = $column->getName();
        }
        foreach ($data as $row) {
            $this->filterDataRow($row, $names);
        }
        return $data;
    }

    public function filterDataRow(GridRow $row, array $columns)
    {
        foreach ($row as $column => $value) {
            if (!in_array($column, $columns)) {
                unset($row[$column]);
            }
        }
    }
}
