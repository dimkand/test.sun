<?php

class Db
{
    private $link;
    private static $sql_where = '';

    function __construct()
    {
        $this->link = mysqli_connect(
            Config::get('db.host'),
            Config::get('db.user'),
            Config::get('db.pass'),
            Config::get('db.name')
        ) or die("Ошибка соединения с базой данных: " . mysqli_connect_error());

        mysqli_set_charset($this->link, "utf8");
    }

    public function query($sql, $multi_array = false)
    {
        $result = mysqli_query($this->link, $sql) or die("Ошибка: " . mysqli_error($this->link));

        if (is_bool($result)) {
            return mysqli_insert_id($this->link);
        }

        $num = mysqli_num_rows($result);

        if ($num == 0)
            return false;

        if (($num == 1) && (!$multi_array))// если в запросе одна строка и нет запроса на многомерный массив $multi_array = false
            return mysqli_fetch_assoc($result);

        $i = 0;

        while ($i < $num) {
            $data[$i] = mysqli_fetch_assoc($result);
            $i++;
        }
        // Освобождаем память
        $result->free();

        return $data;
    }

    public function get($table, $rows = '*', $multi_array = false)
    {
        $sql = "SELECT $rows FROM `$table`";
        $sql = $this->addSqlPart($sql);

        return $this->query($sql, $multi_array);
    }

    public function insert($table, $data)
    {
        $sql_start = "INSERT INTO  `$table` (";
        $sql_end = ") VALUES (";

        foreach ($data as $key => $value) {
            $sql_start = $sql_start . '`' . $key . '`, ';
            $sql_end = $sql_end . "'{$value}', ";
        }
        //обрезаем в конце ненужные пробел и запятую
        $sql = substr($sql_start, 0, -2) . substr($sql_end, 0, -2) . ")";

        return $this->query($sql, false);
    }

    public function where($key, $value)
    {

        if (is_null($value))
            $prefix_value = "IS NULL";
        else
            $prefix_value = "= '{$value}'";

        if (empty(self::$sql_where))
            self::$sql_where = " WHERE `$key` $prefix_value";
        else
            self::$sql_where = self::$sql_where . " AND `$key` $prefix_value";
    }

    private function addSqlPart($sql)
    {
        //Если есть WHERE добавляем его в запрос и обнуляем
        if (!empty(self::$sql_where)) {
            $sql = $sql . self::$sql_where;
            self::$sql_where = '';
        }

        return $sql;
    }

    public function update($table, $data)
    {
        $sql = "UPDATE `$table` SET ";

        foreach ($data as $key => $value) {
            $sql = $sql . "`" . $key . "` = '{$value}', ";
        }
        $sql = substr($sql, 0, -2);
        $sql = $this->addSqlPart($sql);

        return $this->query($sql, false);
    }

    public function delete($table)
    {
        $sql = "DELETE FROM `$table`";
        $sql = $this->addSqlPart($sql);

        return $this->query($sql);

    }
}