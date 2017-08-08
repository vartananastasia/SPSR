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
    protected $body;


    /**
     * PutItems constructor.
     * @param array $fields
     * @throws SPSR_Exception
     */
    public function __construct(array $fields = [
        'id' => '1',
        'article' => '1',
        'name' => 'test good',
        'fullname' => 'test good 1',
        'barcodes' => [
            '33432453678765432'
        ]
    ])
    {
        $keys = ['id', 'name', 'fullname', 'barcodes'];

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
            throw new SPSR_Exception(SPSR_Exception::KEY_NOT_IN_ARRAY);
        }
    }
}