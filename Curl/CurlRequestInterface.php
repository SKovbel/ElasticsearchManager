<?php namespace Curl;

/**
 * curl请求接口
 */
interface CurlRequestInterface
{
    /**
     * 执行get方式的curl请求
     *
     * @param string $api API URI地址
     * @return mixed false on curl error or result of curl request
     */
    public function get(string $api);

    /**
     * 执行put方式的curl请求
     *
     * @param string $api API URI地址
     * @param array $data put数据及参数
     * @return mixed false on curl error or result of curl request
     */
    public function put(string $api, array $data = []);

    /**
     * 执行post方式的curl请求
     *
     * @param string $api API URI地址
     * @param array $data post数据及参数
     * @return mixed false on curl error or result of curl request
     */
    public function post(string $api, array $data = []);
}
