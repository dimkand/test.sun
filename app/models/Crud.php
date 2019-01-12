<?php

class Crud extends Model
{
    public function get($id, $rows = '*', $multi_array = false)
    {
        $this->db->where($this->id_key, $id);
        return $this->db->get($this->table, $rows, $multi_array);
    }

    public function getAll($rows = '*', $multi_array = false)
    {
        return $this->db->get($this->table, $rows, $multi_array);
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $key, $value)
    {
        $this->db->where($key, $value);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where($this->id_key, $id);
        $this->db->delete($this->table);
    }

    // Перемещение файла изображения из временной в постоянную директорию
    public function renameImgFile($img)
    {
        if(!empty($_POST['old_img']))
            $img_name = $_POST['old_img'];
        else
            $img_name = Config::get('default_img');// Изображение по умолчанию: Config::get('default_img')

        $saved_img_path = $_SERVER['DOCUMENT_ROOT'] . '/webroot/' . get_called_class()::$img_path . $img['name'];

        if (@rename($img['tmp_name'], $saved_img_path)){
            $img_name = $img['name'];
            if(isset($_POST['old_img']))
                $this->deleteImgFile($_POST['old_img']);
        }

        return $img_name;
    }

    public function deleteImgFileByid($id)
    {
        $data = $this->get($id);
        $this->deleteImgFile($data['img']);
    }

    public function deleteImgFile($file_name)
    {
        if ($file_name == Config::get('default_img'))
            return false;

        $img_path = $_SERVER['DOCUMENT_ROOT'] . '/webroot/' . get_called_class()::$img_path. $file_name;
        if (file_exists($img_path) && is_file($img_path))
            return unlink($img_path);
    }
}