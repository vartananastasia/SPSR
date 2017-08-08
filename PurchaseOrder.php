<?php

namespace SPSR;


/**
 * Constructs xml body for PurchaseOrder API method
 *
 * Class PurchaseOrder
 * @package SPSR
 */
class PurchaseOrder extends SPSRMethod
{
    /**
     * @var \SimpleXMLElement
     */
    protected $body;


    /**
     * PurchaseOrder constructor.
     * @param array $fields
     * @throws SPSR_Exception
     */
    public function __construct(array $fields = [
        'id' => '6876979',
        'date' => '2010-10-10',
        'date_of_delivery' => '2010-10-10',
        'items' => [
            ['id' => 1, 'quantity' => 2, 'price' => 400]
        ]
    ])
    {
        $keys = ['id', 'date', 'date_of_delivery', 'items'];
        $item_keys = ['id', 'quantity', 'price'];

        if (self::CheckFields($fields, $keys, $item_keys)) {
            $body = new \SimpleXMLElement(file_get_contents(Client::FILE_PURCHASE_ORDER));
            $body->Documents->Document->ID = $fields["id"];
            $body->Documents->Document->Date = $fields["date"];
            $body->Documents->Document->DateOfDelivery = $fields["date_of_delivery"];

            if (count($fields["items"]) > 0) {
                unset($body->Documents->Document->Items->Item[0]);
                foreach ($fields["items"] as $item) {
                    $new_item = $body->Documents->Document->Items->addChild('Item');
                    $new_item->addChild('ID', $item["id"]);
                    $new_item->addChild('Quantity', $item["quantity"]);
                    $new_item->addChild('Price', $item["price"]);
                }
            }
            $this->body = $body;
        } else
            throw new SPSR_Exception(SPSR_Exception::KEY_NOT_IN_ARRAY);
    }
}