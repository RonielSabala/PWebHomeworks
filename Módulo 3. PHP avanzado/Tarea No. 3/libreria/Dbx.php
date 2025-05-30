<?php

define("DATA_DIR", __DIR__ . "/datax");
if (!is_dir(DATA_DIR)) {
    mkdir(DATA_DIR, 0777, true);
}

class Dbx
{
    public static function list($collection)
    {
        $dataPath = DATA_DIR . "/{$collection}";
        if (!file_exists($dataPath)) {
            return [];
        }

        $data = [];
        foreach (scandir($dataPath) as $file) {
            $filePath = $dataPath . "/" . $file;
            if (!is_file($filePath)) {
                continue;
            }

            $content = file_get_contents($filePath);
            $itemData = unserialize($content);
            if ($itemData) {
                $data[] = $itemData;
            }
        }

        return $data;
    }

    public static function get($collection, $id)
    {
        $dataPath = DATA_DIR . "/{$collection}/{$id}dat";
        if (!file_exists($dataPath)) {
            return null;
        }

        $content = file_get_contents($dataPath);
        return unserialize($content);
    }

    public static function save($collection, $item)
    {
        $dataPath = DATA_DIR . "/{$collection}";
        if (!is_dir($dataPath)) {
            mkdir($dataPath, 0777, true);
        }

        $fileName = strlen($item->idx) > 4 ? $item->idx : uniqid();
        $item->idx = $fileName;
        $filePath = $dataPath . "/" . $fileName . "dat";
        file_put_contents($filePath, serialize($item));
    }
}
