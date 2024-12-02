<?php

namespace Graweb1\Connecto\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConnectoController extends Controller
{
    public function index()
    {
        $db1 = $this->listTables('db1');
        $db2 = $this->listTables('db2');
        return view('connecto::connecto', ['db1' => $db1, 'db2' => $db2]);
    }

    public function listTables(String $db)
    {
        try {
            if (!in_array($db, ['db1', 'db2'])) {
                throw new \Exception('Conexão inválida');
            }

            $tablesWithSize = DB::connection($db)->select("
                SELECT
                    table_name AS tableName,
                    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb
                FROM
                    information_schema.tables
                WHERE
                    table_schema = DATABASE()
                GROUP BY
                    table_name
            ");

            $tables = [];
            foreach ($tablesWithSize as $table) {
                $tableName = $table->tableName;
                $recordCount = DB::connection($db)->table($tableName)->count();

                $tables[] = [
                    'table_name' => $tableName,
                    'size_mb' => $table->size_mb,
                    'total_records' => $recordCount,
                ];
            }

            return [
                'database_name' => $db == 'db1' ? env('DB_DATABASE_1') : env('DB_DATABASE_2'),
                'tables' => $tables,
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function tableColumns(Request $request)
    {
        $databaseName = $request->get('database');
        $tableName = $request->get('table');

        if (!$tableName || !$databaseName) {
            return response()->json(['error' => 'Nome da tabela e do banco de dados são obrigatórios'], 400);
        }

        DB::setDefaultConnection('mysql');
        DB::statement("USE {$databaseName}");

        $columns = DB::select("SHOW COLUMNS FROM {$tableName}");

        $primaryKeys = DB::select("SHOW INDEXES FROM {$tableName} WHERE Key_name = 'PRIMARY'");
        $primaryKeys = array_map(function ($key) {
            return $key->Column_name;
        }, $primaryKeys);

        $formattedColumns = array_map(function ($column) use ($primaryKeys) {
            return [
                'name' => $column->Field,
                'type' => $column->Type,
                'auto_increment' => strpos($column->Extra, 'auto_increment') !== false,
                'primary_key' => in_array($column->Field, $primaryKeys),
                'nullable' => $column->Null === 'YES',
            ];
        }, $columns);

        return response()->json($formattedColumns);
    }

    public function transferData(Request $request)
    {
        dd($request->all());
    }
}
