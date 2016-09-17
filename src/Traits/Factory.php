<?php

namespace HiFebriansyah\LaravelContentManager\Traits;

use DB;
use Schema;

trait Factory
{
    public $globalConfigs = [
        'hides' => ['created_at', 'updated_at'],
        'readOnly' => [],
        'files' => ['image_url'],
        'checkboxes' => [],
    ];

    public function getColumns()
    {
        return DB::select('show fields from '.$this->table);
    }

    public function setRules($columns)
    {
        $rules = [];

        foreach ($columns as $key => $column) {
            $validations = [];

            if (!in_array($column->Field, $this->globalConfigs['hides'])) {
                if ($column->Null == 'NO' && $column->Key != 'PRI') {
                    $validations[] = 'required';
                }

                if (strpos($column->Type, 'int') !== false) {
                    $validations[] = 'integer';
                }

                if ($column->Default == 'CURRENT_TIMESTAMP') {
                    $validations[] = 'date';
                }
            }

            $rules[$column->Field] = implode('|', $validations);
        }

        $this->rules = array_merge($rules, $this->rules);

        return $this;
    }

    public function getReference($field)
    {
        $reference = DB::select('
            select REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
            from
                information_schema.key_column_usage
            where
                referenced_table_name is not null
                and column_name = "'.$field.'"
                and table_name = "'.$this->table.'"
                and table_schema = "'.$_ENV['DB_DATABASE'].'"
            ');

        if (isset($reference[0])) {
            $reference = $reference[0];
        }

        return $reference;
    }

    public function getConfigs()
    {
        $this->globalConfigs['columnLabel'] = Schema::hasColumn($this->getTable(), 'name') ? 'name' : 'id';

        return isset($this->lcm) ? array_merge($this->globalConfigs, $this->lcm) : $this->globalConfigs;
    }
}
