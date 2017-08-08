<?php

namespace SPSR;


/**
 * Constructs xml body for PutItems API method
 *
 * Class PutItems
 * @package SPSR
 */
class PutItems extends SPSRMethod
{
    /**
     * @var \SimpleXMLElement
     */
    private $body;


    /**
     * PutItems constructor.
     * @param array $fields
     * @throws SPSRException
     */
    public function __construct(array $fields = [
        'id' => '1',
        'article' => '1',
        'name' => 'test good',
        'fullname' => 'test good 1',
        'barcodes' => [
            '1', '2', '3'
        ]
    ])
    {
        $keys = ['id', 'name', 'fullname'];

        if (self::CheckFields($fields, $keys)) {
            $body = new \SimpleXMLElement(file_get_contents(Client::FILE_PUT_ITEMS));

            $body->Items->Item->Id = $fields["id"];
            $body->Items->Item->Article = $fields["article"];
            $body->Items->Item->Name = $fields["name"];
            $body->Items->Item->Fullname = $fields["fullname"];

            if (count($fields["barcodes"]) > 0) {
                unset($body->Items->Item->Barcodes->Barcode[0]);
                foreach ($fields["barcodes"] as $barcode) {
                    $new_barcode = $body->Items->Item->Barcodes->addChild('Barcode');
                    $new_barcode->addChild('Code', $barcode);
                }
            }
            $this->body = $body;
        } else {
            throw new SPSRException(SPSRException::KEY_NOT_IN_ARRAY);
        }
    }
}