<?php
/**
 * Created by PhpStorm.
 * User: Choate
 * Date: 2018/3/7
 * Time: 17:18
 */

namespace choate\yii2\flysystem;

use ApolloPY\Flysystem\AliyunOss\AliyunOssAdapter;
use creocoder\flysystem\Filesystem;
use OSS\OssClient;

class OssFilesystem extends Filesystem
{
    public $secretId;

    public $secretKey;

    public $secretToken;

    public $bucket;

    public $prefix;

    public $domain;

    public $bindDomain = false;

    public $timeout = 0;

    public $connectTimeout = 0;

    public $useSSL = false;

    public $useSecretToken = false;

    public $maxTries = 3;

    public $options = [];

    /**
     * @return mixed
     */
    protected function prepareAdapter()
    {
        $config = new OssClient($this->secretId, $this->secretKey, $this->domain, $this->bindDomain, $this->secretToken);
        $config->setTimeout($this->timeout);
        $config->setConnectTimeout($this->connectTimeout);
        $config->setUseSSL($this->useSSL);
        $config->setSignStsInUrl($this->useSecretToken);
        $config->setMaxTries($this->maxTries);

        return new AliyunOssAdapter($config, $this->bucket, $this->prefix, $this->options);
    }
}