<?php

namespace SPSR;


/**
 * Constructs xml body for PutContractors API method
 *
 * Class PutContractors
 * @package SPSR
 */
class PutContractors extends SPSRMethod
{
    /**
     * @var \SimpleXMLElement
     */
    protected $body;


    /**
     * PutContractors constructor.
     * @param array $fields
     * @throws SPSR_Exception
     */
    public function __construct(array $fields = [
        'id' => '622',
        'name' => 'test name',
        'full_name' => 'test name',
    ])
    {
        $keys = ['id', 'name', 'full_name'];

        if (self::CheckFields($fields, $keys)) {
            $body = new \SimpleXMLElement(file_get_contents(Client::FILE_PUT_CONTRACTORS));
            $body->Contractors->Contractor->Id = $fields["id"];
            $body->Contractors->Contractor->Name = $fields["name"];
            $body->Contractors->Contractor->Fullname = $fields["full_name"];

            $this->body = $body;
        } else
            throw new SPSR_Exception(SPSR_Exception::KEY_NOT_IN_ARRAY);
    }
}