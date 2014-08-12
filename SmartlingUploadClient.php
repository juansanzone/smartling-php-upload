<?php

/**
 * Simple Abstraction PHP layer for upload files with Smartling API
 * Juan Sanzone - juan.sanzone@gmail.com / 2014
 */
class SmartlingUploadClient
{
    const API_URL = 'https://api.smartling.com/v1';
    const UPLOAD_METHOD = '/file/upload';

    private $_request;
    private $_projectId;
    private $_apiKey;
    private $_filePath;
    private $_fileType;

    public function __construct($projectId, $apiKey)
    {
        $this->_projectId = $projectId;
        $this->_apiKey = $apiKey;
    }

    public function uploadFile($filePath, $fileType = 'gettext')
    {
        $this->_filePath = $filePath;
        $this->_fileType = $fileType;
        $this->_request = curl_init(self::API_URL . self::UPLOAD_METHOD);

        curl_setopt($this->_request, CURLOPT_POST, true);
        curl_setopt($this->_request, CURLOPT_POSTFIELDS, $this->_getUploadParams());
        curl_setopt($this->_request, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->_request);

        curl_close($this->_request);

        return $response;
    }

    protected function _getUploadParams() 
    {
        return array(
            'file'          => '@' . realpath($this->_filePath) . ';type=text/plain',
            'fileType'      => $this->_fileType,
            'fileUri'       => $this->_filePath,
            'projectId'     => $this->_projectId,
            'apiKey'        => $this->_apiKey,
        );
    }
}
