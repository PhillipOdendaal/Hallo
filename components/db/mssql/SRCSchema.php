<?php

namespace app\components\db\mssql;

class SRCSchema extends \yii\db\mssql\Schema {

    public function createQueryBuilder() {
        return new SRCQueryBuilder($this->db);
    }

    protected function findForeignKeys($table) {
       /**
        $sql = <<<SQL
-- overrided from yii2 default findForeignKeys query
SELECT
c1.name AS [fk_column_name],
OBJECT_NAME(fk.referenced_object_id) AS [uq_table_name],
c2.name AS [uq_column_name]
                
FROM sys.foreign_keys fk WITH (NOLOCK)

INNER JOIN sys.foreign_key_columns fkc WITH (NOLOCK) ON fkc.constraint_object_id = fk.object_id
INNER JOIN sys.columns c1 WITH (NOLOCK) ON fkc.parent_column_id = c1.column_id AND fkc.parent_object_id = c1.object_id
INNER JOIN sys.columns c2 WITH (NOLOCK) ON fkc.referenced_column_id = c2.column_id AND fkc.referenced_object_id = c2.object_id

WHERE fkc.parent_object_id = OBJECT_ID(:tableName) 
SQL;

        $rows = $this->db->createCommand($sql, [
                    ':tableName' => $table->name
                ])->queryAll();
        $table->foreignKeys = [];
        foreach ($rows as $row) {
            $table->foreignKeys[] = [$row['uq_table_name'], $row['fk_column_name'] => $row['uq_column_name']];
        }
    }
	**/
	
	//setting keys manually for now
	$table->foreignKeys[] = ['users', 'fid' => 'uid'];

    }
}
