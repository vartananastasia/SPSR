# SPSR API store integration

Uses:

``GuzzleHttp/6.2.1`` - http://docs.guzzlephp.org/en/stable/overview.html#installation
``curl/7.51.0`` 
``PHP/5.6.29``

1) Download all goods in store by ```PutItems```
2) Add quantity for goods by ```PurchaseOrder```
3) Now orders can be sent to SPSR by ```SalesOrder```
4) Check quantity of goods in store by ```StockReport```

Use real:

```php
$client = new SPSR\Client('login', 'password');
# $s = new SPSR\PutItems($fields);
# $s = new SPSR\PurchaseOrder($fields);
$s = new SPSR\SalesOrder($fields);
# $s = new SPSR\StockReport($fields);
$client->Execute($s->GetBody());
```
 
Use test:

```php
$client = new SPSR\Client('', '', True);
# $s = new SPSR\PutItems($fields);
# $s = new SPSR\PurchaseOrder($fields);
$s = new SPSR\SalesOrder($fields);
# $s = new SPSR\StockReport($fields);
$client->Execute($s->GetBody());
```