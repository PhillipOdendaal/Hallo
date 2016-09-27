<?php

//namespace app\components\db\mysql;
namespace app\components\db\mssql;

//class SRCchema extends \yii\db\mysql\Schema {
class SRCchema extends \yii\db\mssql\Schema {

    public function createQueryBuilder() {
        return new ESMQueryBuilder($this->db);
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
	//$table->foreignKeys[] = ['uq_table_name', 'fk_column_name' => 'uq_column_name'];
	
	$table->foreignKeys[] = ['users', 'fid' => 'uid'];
}

/*

SELECT 
  TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
FROM
  INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE
  REFERENCED_TABLE_SCHEMA = '<database>' AND
  REFERENCED_TABLE_NAME = '<table>';
  
  
For the schema (All objects);
SELECT * FROM information_schema.SCHEMATA S;

For constraints and foreign keys also;
SELECT * FROM information_schema.TABLE_CONSTRAINTS T;

For everything else check this queries;

SELECT * FROM information_schema.CHARACTER_SETS C;
SELECT * FROM information_schema.COLLATION_CHARACTER_SET_APPLICABILITY C;
SELECT * FROM information_schema.COLLATIONS C;
SELECT * FROM information_schema.COLUMN_PRIVILEGES C;
SELECT * FROM information_schema.`COLUMNS` C;
SELECT * FROM information_schema.KEY_COLUMN_USAGE K;
SELECT * FROM information_schema.PROFILING P;
SELECT * FROM information_schema.ROUTINES R;
SELECT * FROM information_schema.SCHEMA_PRIVILEGES S;  
SELECT * FROM information_schema.STATISTICS S;
SELECT * FROM information_schema.TABLE_PRIVILEGES T;
SELECT * FROM information_schema.`TABLES` T;
SELECT * FROM information_schema.TRIGGERS T;
SELECT * FROM information_schema.USER_PRIVILEGES U;
SELECT * FROM information_schema.VIEWS V;
*/