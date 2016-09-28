<?php

namespace app\components\db\mysql;

class SRCSchema extends \yii\db\mysql\Schema {

    public function createQueryBuilder() {
        return new SRCQueryBuilder($this->db);
    }

    protected function findForeignKeys($table) {

        $sql = <<<SQL
SELECT 
    TABLE_NAME,
    COLUMN_NAME,
    CONSTRAINT_NAME, 
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME 
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
WHERE REFERENCED_TABLE_SCHEMA = 'src_v1' 
AND REFERENCED_TABLE_NAME = ':tableName'
SQL;
        $rows = $this->db->createCommand($sql, [
                    ':tableName' => $table->name
                ])->queryAll();
        $table->foreignKeys = [];
        foreach ($rows as $row) {
                //$table->foreignKeys[] = [$row['uq_table_name'], $row['fk_column_name'] => $row['uq_column_name']];
                $table->foreignKeys[] = [$row['TABLE_NAME'], $row['REFERENCED_COLUMN_NAME'] => $row['COLUMN_NAME']];
            }
        }
    }