<?php namespace Curl;

use Curl\CurlRequestInterface;
/**
 * curl请求类
 */
class CurlRequest implements CurlRequestInterface
{
    /**
     * @var string elasticsearch节点服务器地址
     */
    private $host = 'localhost:9200';

    /**
     * @var resource curl request resource
     */
    private $ch;

    /**
     * 执行get方式的curl请求
     *
     * @param string $api API URI地址
     * @return mixed false on curl error or result of curl request
     */
    public function get(string $api)
    {
        $this->initCurl($api);

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        return $this->execCurl();
    }

    /**
     * 执行put方式的curl请求
     *
     * @param string $api API URI地址
     * @param array $data put数据及参数
     * @return mixed false on curl error or result of curl request
     */
    public function put(string $api, array $data = [])
    {
        $this->initCurl($api);

        curl_setopt_array($this->ch, [
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CONNECTTIMEOUT => 10,
        ]);

        if (is_array($data) && $data) {
            curl_setopt_array($this->ch, [
                CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                CURLOPT_POSTFIELDS => json_encode($data),
            ]);
        }

        return $this->execCurl();
    }

    /**
     * 执行post方式的curl请求
     *
     * @param string $api API URI地址
     * @param array $data put数据及参数
     * @return mixed false on curl error or result of curl request
     */
    public function post(string $api, array $data = [])
    {
        $this->initCurl($api);

        curl_setopt_array($this->ch, [
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CONNECTTIMEOUT => 10,
        ]);

        if (is_array($data) && $data) {
            curl_setopt_array($this->ch, [
                CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                CURLOPT_POSTFIELDS => json_encode($data),
            ]);
        }

        return $this->execCurl();
    }

    /**
     * 设置elasticsearch节点服务器地址
     *
     * @param string $host 节点服务器地址
     * @param int $port 节点服务器端口号
     */
    public function setHost(string $host, int $port = 9200)
    {
        $this->host = "{$host}:{$port}";
    }

    /**
     * 处理curl请求API
     *
     * @param string $api API URI地址
     * @return string $apit 处理后的API
     */
    private function apiHandler($api)
    {
        if (strpos($api, '/') !== 0) {
            return "/{$api}";
        } else {
            return $api;
        }
    }

    /**
     * 初始化curl
     *
     * @param string $api API URI地址
     */
    private function initCurl($api)
    {
        $api = $this->apiHandler($api);
        $this->ch = curl_init($this->host . $api);
    }

    /**
     * 执行curl请求并返回结果数据
     *
     * @return string errorinfo on curl error or result of curl request
     */
    private function execCurl()
    {
        $result = curl_exec($this->ch);

        if (curl_errno($this->ch) === 0) {
            return $result;
        } else {
            return curl_error($this->ch);
        }
    }

    /**
     * 析构函数 - 关闭curl
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }
}
