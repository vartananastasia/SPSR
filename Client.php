<?php

namespace SPSR;

use GuzzleHttp\Client as GC;


/**
 * Class Client
 * @package SPSR
 */
class Client
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $test;

    # API settings
    # for TEST
    const test_api_base_url = 'http://ilior.lv/ru/webapi/execute';
    const test_login = 'test1';
    const test_password = 'test1';

    # for REAL
    const api_base_url = '';

    # method names
    const PUT_ITEMS = 'PutItems';
    const SALES_ORDER = 'SalesOrder';
    const PURCHASE_ORDER = 'PurchaseOrder';
    const STOCK_REPORT = 'StockReport';

    # xml file names
    const FILE_PUT_ITEMS = __DIR__ . '/put_items.xml';
    const FILE_SALES_ORDER = __DIR__ . '/sales_order.xml';
    const FILE_PURCHASE_ORDER = __DIR__ . '/purchase_order.xml';
    const FILE_STOCK_REPORT = __DIR__ . '/stock_report.xml';


    /**
     * Client constructor.
     * @param $login
     * @param $password
     * @param bool $test
     */
    public function __construct($login, $password, $test = False)
    {
        if ($test) {
            $this->login = self::test_login;
            $this->password = self::test_password;
        }
        else{
            $this->login = $login;
            $this->password = $password;
        }
        $this->test = $test;
    }


    /**
     * Executes API request
     * @param xml $body
     * @return \Psr\Http\Message\StreamInterface
     */
    public function Execute($body)
    {
        if ($this->test)
            $url = self::test_api_base_url;
        else
            $url = self::api_base_url;

        $body->attributes()["Login"] = $this->login;
        $body->attributes()["Password"] = $this->password;

        gg($body);

//        $client = new GC();
//        $response = $client->request('POST', $url, ['body' => $body]);
//        $data = $response->getBody();
//        return $data;
    }
}