<?php

/**
 * @author Macro
 * @date 2018/8/24 14:31
 * @version 1.0.0
 */

namespace Admin\lib;

class File
{
    CONST MAXSIZE = 1 * 1024 * 1024;
    private $tmpDir = '/tmp/'; // 临时目录
    private $allowType = [
        'jpg',
        'png',
        'gif',
    ]; //允许上传后缀名
    private $uploadDir = "/img/"; // 上传目录
    private $fileName = ""; // 指定文件名
    private $fileSuffix = ""; // 指定文件后缀
    public $moveTmp = false; // 是否上传到临时目录
    public $isCover = true; // 是否覆盖文件

    public function __construct($uploadDir = '', $fileName = '', $fileSuffix = '')
    {
        if (!empty($uploadDir)) {
            $this->uploadDir = $uploadDir;
        }
        if (!empty($fileName)) {
            $this->fileName = $fileName;
        }
        if (!empty($fileSuffix)) {
            $this->fileSuffix = $fileSuffix;
        }
    }

    /**
     * 上传
     * @param $file
     * @return array
     */
    public function upload($file)
    {
        $filePos = strrpos($file['name'], ".");
        $suffix = substr($file['name'], $filePos + 1);
        empty($this->fileSuffix) && $this->fileSuffix = $suffix;
        empty($this->fileName) && $this->fileName = substr($file['name'], 0, $filePos);
        if ($this->moveTmp) {
            $filePath = $this->tmpDir . $this->fileName . '.' . $this->fileSuffix;
        } else {
            $filePath = $this->uploadDir . $this->fileName . '.' . $this->fileSuffix;
        }

        if (!$this->isCover && file_exists("." . $filePath)) {
            return [1001, "上传文件已存在!"];
        }
        if ($file['size'] > self::MAXSIZE) {
            return [1002, "超出最大上传限制!"];
        }
        if (!in_array($suffix, $this->allowType)) {
            return [1003, "文件后缀不合法!"];
        }
        if (@move_uploaded_file($file['tmp_name'], "." . $filePath)) {
            return [0, $filePath];
        }
        return [1000, "上传失败!"];
    }

}