<?php

namespace DigitalInvoice\Tests;

use DigitalInvoice\Invoice;

use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase
{
    public function testBasicInvoiceXml(): void
    {
        $invoice = new Invoice('123', new \Datetime('2023-11-07'));

        $invoice->setSeller(
            '12344',
            '0002',
            'Seller',
            'Contact Seller',
            $departmentName = null,
            '+2129999999999',
            'seller@email.com'
        );

        $invoice->setSellerTaxRegistration('!!!!!!', 'VAT') ;

        $invoice->setSellerAddress(
            '1 rue de la paie',
            '90000',
            'Paris',
            'FR'
        );

        $invoice->setBuyer(
            '12344',
            '12344',
            'buyer'
        );

        $invoice->setBuyerAddress(
            '2 rue de la paie',
            '90000',
            'Paris',
            'FR'
        );

        // Item 1
        $invoice->addItem('service a la demande', '750', 10, 0, 'DAY', 'xxxx') ;


        $xml = $invoice->getXml();
        self::assertNotEmpty($xml);


        $result = $invoice->validate($xml);
        self::assertNull($result, $result ?? '');
    }

}