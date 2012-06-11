<?php

// test:    $id = bizStorage::add(__FILE__, 'test.php');
class bizStorage
{
    const STORAGE_URL = 'http://storage.atomdev.com';

    /**
     * add 上传一个文件
     * $strFile : 本机文件路径
     * $strFileName : 文件名称(选填)
     * @return mix 成功返回文件id,否则为false
     */
    public static function add($strFile, $strFileName = null)
    {

        if (!file_exists($strFile)) {
            return false;
        }

        isset($strFileName) || $strFileName = basename($strFile);

        $MULTIPART_BOUNDARY = '--------------------------'.microtime(true);
        $file_contents = file_get_contents($strFile);

        $content =  "--".$MULTIPART_BOUNDARY."\r\n".
                    "Content-Disposition: form-data; name=\"uploaded_file\"; filename=\"".$strFileName."\"\r\n".
                    "Content-Type: application/zip\r\n\r\n".
                    $file_contents."\r\n";

        // add some POST fields to the request too: $_POST['foo'] = 'bar'
        // $content .= "--".MULTIPART_BOUNDARY."\r\n".
        //             "Content-Disposition: form-data; name=\"foo\"\r\n\r\n".
        //             "bar\r\n".

        $content .= "--".$MULTIPART_BOUNDARY."--\r\n";

        $context = stream_context_create(array(
            'http' => array(
                  'method' => 'POST',
                  'header' => 'Content-Type: multipart/form-data; boundary='.$MULTIPART_BOUNDARY,
                  'content' => $content,
            ),
        ));

        $result = @file_get_contents(self::STORAGE_URL, false, $context);
        $result = @json_decode($result, true);
        if (isset($result['id'])) {
            return $result['id'];
        }
        return false;
    }

    /**
     * readInfo 根据文件id读取文件相关信息
     * $intFileId : 文件id
     * @return mix 成功返回文件信息,否则为false
     */
    public static function readInfo($intFileId)
    {
        $result = @file_get_contents(self::STORAGE_URL.'/index.php?r=site/readinfo&id='.$intFileId);
        $result = @json_decode($result, true);
        if (is_array($result)) {
            return $result;
        }

        return false;
    }

    /**
     * readData 根据文件id读取文件内容
     * $intFileId : 文件id
     * @return mix 成功返回文件内容,否则为false
     */
    public static function readData($intFileId)
    {
        $result = @file_get_contents(self::STORAGE_URL.'/index.php?r=site/readdata&id='.$intFileId);
        if ($result == 'error') {
            return false;
        }

        return $result;
    }
}

?>