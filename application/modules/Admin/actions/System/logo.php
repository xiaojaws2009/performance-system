<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Base\Response;
use Admin\lib\File;

class logoAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        if ($this->getRequest()->getMethod() == 'POST') {
            $file = $this->getRequest()->getFiles()['file'] ?? '';
            if (empty($file)) {
                Response::json(1, "请选择文件!");
            }
            $result = (new File('/img/', 'logo', 'png'))->upload($file);

            Response::json($result[0], $result[1]);
        }
    }

}