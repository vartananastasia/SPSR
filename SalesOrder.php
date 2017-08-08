<?php

namespace SPSR;


/**
 * Constructs xml body for SalesOrder API method
 *
 * Class SalesOrder
 * @package SPSR
 */
class SalesOrder extends SPSRMethod
{
    /**
     * @var \SimpleXMLElement
     */
    protected $body;


    /**
     * SalesOrder constructor.
     * @param array $fields
     * @throws SPSR_Exception
     */
    public function __construct(array $fields = [
        'id' => '1',
        'date' => '2010-10-10',
        'total_sum' => '411',
        'sum_of_delivery' => '400',
        'is_payed' => 'false',
        'full_address' => 'test city state house flat',
        'postcode' => '777888',
        'state' => 'test state',
        'city' => 'test city',
        'street' => 'test street',
        'phone' => '79000000000',
        'items' => [
            ['id' => 1, 'quantity' => 1, 'price' => 11, 'VAT' => 0, 'vat_sum' => 0, 'total_without_vat' => 11,
                'total_with_vat' => 11, 'cancel_item' => 'false']
        ]
    ])
    {
        $keys = ['id', 'date', 'total_sum', 'sum_of_delivery', 'full_address', 'postcode', 'phone', 'items'];
        $item_keys = ['id', 'quantity', 'price'];

        if (self::CheckFields($fields, $keys, $item_keys)) {
            $body = new \SimpleXMLElement(file_get_contents(Client::FILE_SALES_ORDER));

            $body->Orders->Order->Document->ID = $fields["id"];
            $body->Orders->Order->Document->Date = $fields["date"];
            $body->Orders->Order->Document->TotalSum = $fields["total_sum"];
            $body->Orders->Order->Document->SumOfDelivery = $fields["sum_of_delivery"];
            $body->Orders->Order->Document->IsPayed = $fields["is_payed"];
            $body->Orders->Order->Document->DeliveryInformation->FullAddress = $fields["full_address"];
            $body->Orders->Order->Document->DeliveryInformation->Postcode = $fields["postcode"];
            $body->Orders->Order->Document->DeliveryInformation->State = $fields["state"];
            $body->Orders->Order->Document->DeliveryInformation->City = $fields["city"];
            $body->Orders->Order->Document->DeliveryInformation->Street = $fields["street"];
            $body->Orders->Order->Document->DeliveryInformation->Phone = $fields["phone"];

            if (count($fields["items"]) > 0) {
                unset($body->Orders->Order->Items->Item[0]);
                foreach ($fields["items"] as $item) {
                    $new_item = $body->Orders->Order->Items->addChild('Item');
                    $new_item->addChild('ID', $item["id"]);
                    $new_item->addChild('Quantity', $item["quantity"]);
                    $new_item->addChild('Price', $item["price"]);
                    $new_item->addChild('VAT', $item["VAT"]);
                    $new_item->addChild('VatSum', $item["vat_sum"]);
                    $new_item->addChild('TotalWithoutVat', $item["total_without_vat"]);
                    $new_item->addChild('TotalWithVat', $item["total_with_vat"]);
                    $new_item->addChild('CancelItem', $item["cancel_item"]);
                }
            }
            $this->body = $body;
        } else
            throw new SPSR_Exception(SPSR_Exception::KEY_NOT_IN_ARRAY);
    }
}