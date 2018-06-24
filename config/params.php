<?php

return [
    'copyright' => 'Uteg',
    'alias' => 'UT',
    'web' => 'http://www.uteg.edu.ec',
    'version' => '1.0',
    'adminEmail' => 'web@uteg.edu.ec',
    'soporteEmail' => 'dlopez@uteg.edu.ec',
    'admisiones' => 'analistadesarrollo01@uteg.edu.ec', //'jefeadmisiones@uteg.edu.ec', //'analistadesarrollo02@uteg.edu.ec', 
    'colecturia' => 'analistadesarrollo01@uteg.edu.ec', //'colecturia@uteg.edu.ec', //'analistadesarrollo02@uteg.edu.ec',    
    'jefetalento' => 'analistadesarrollo01@uteg.edu.ec', //'directortalento@uteg.edu.ec', //
    'analistatalento' => 'analistadesarrollo01@uteg.edu.ec', //'kmunoz@uteg.edu.ec', //
    'analistanomina' => 'analistadesarrollo01@uteg.edu.ec', // 'glamota@uteg.edu.ec',
    'contactoEmail' => 'pruebacontacto@uteg.edu.ec',
    'culture' => 'es-ES',
    'dateTimeByDefault' => 'Y-m-d H:i:s',
    'dateByDefault' => 'Y-m-d',
    'dateByDatePicker' => 'yyyy-mm-dd',
    'cookieSession' => 3600 * 24 * 30,
    'logfile' => __DIR__ . '/../runtime/logs/pb.log',
    'limitRow' => 10,
    'pageSize' => 20,
    'userWebServer' => getenv('APACHE_RUN_USER'),
    'documentFolder' => '/uploads/',
    'imgFolder' => '/site/getimage/?route=/uploads/',
    'FileExtensions' => ['jpg', 'png', 'pdf'],
    'MaxFileSize' => 1024, //Tamaño 1 MB
    'timeRecursive' => '2', // segundos
    'numRecursive' => '3',
    'keywordEncription' => 'PBdoHUHYU909854874HNGFGKO',
    'tokenid' => 'HU787390kdnhyyejkKJHWFRDERD3573LOSNQ2JKTDCA67253',
    'numbersecret' => '29839813213464',
    'socialNetworks' => [
        'facebook' => 'https://www.facebook.com/uteg.ec',
        'twitter' => 'https://twitter.com/uteg_ec',
        'youtube' => 'https://www.youtube.com/channel/UC8_6Fr2MGrNkr-kM7BZzkdQ',
    ],
    // Variables VPOS                     
    'Vposvector' => "1EBCFD349F229E00",
    'VposacquirerId' => '8',
    'VposcommerceId' => '7687',
    'VpospurchaseCurrencyCode' => '840',
    'VposcommerceMallId' => '000001',
    'Vposlanguage' => 'SP',
    'VposbillingAddress' => 'Direccion ABC',
    'VposbillingZIP' => '1234567890',
    'VposbillingCity' => 'Quito',
    'VposbillingState' => 'Quito',
    'VposbillingCountry' => 'EC',
    'VposbillingPhone' => '123456789',
    'VposshippingAddress' => 'Direccion ABC',
    'VposterminalCode' => '000001',
    'VposIVA' => 0.12,
    'VposReserved1' => 'SP',
    'VposReserved4' => '000',
    'VposReserved5' => '000',
    'VposReserved9' => '000',
    'VposReserved10' => '000',
    'VposReserved11' => 'Valor Reservado ABC',
    
    // Variables VPOS Pruebas                    
    'Vposvector_p' => "1EBCFD349F229E00",
    'VposacquirerId_p' => '119',
    'VposcommerceId_p' => '7725',
    'VpospurchaseOperationNumber_p' => '123401201',
    'VpospurchaseAmount_p' => '10000',    
    'VposcommerceMallId_p' => '0',
    'VposterminalCode_p' => '00000000',
    'VposIVA_p' => 0.12,
    
    //URL
    'url_biblioteca' => 'https://www.biblionline.pearson.com',
    'url_educativa' => 'https://campusvirtual.uteg.edu.ec',
    
    //desarrollo llaves de cifrado publica de Alignet
    'VposllaveVPOSCryptoPub' => "-----BEGIN PUBLIC KEY-----\n" .
    "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDTJt+hUZiShEKFfs7DShsXCkoq\n" .
    "TEjv0SFkTM04qHyHFU90Da8Ep1F0gI2SFpCkLmQtsXKOrLrQTF0100dL/gDQlLt0\n" .
    "Ut8kM/PRLEM5thMPqtPq6G1GTjqmcsPzUUL18+tYwN3xFi4XBog4Hdv0ml1SRkVO\n" .
    "DRr1jPeilfsiFwiO8wIDAQAB\n" .
    "-----END PUBLIC KEY-----",
      //desarrollo llave de firma privada de su comercio
    'VposllaveComercioFirmaPriv' => "-----BEGIN RSA PRIVATE KEY-----\n" .
    "MIICXQIBAAKBgQC6Jfa9E/EbMhL0n6wSn5rav5kWL7b7OUiIE1YYCNbXpDmpRqJv\n" .
    "/lBVv4M5N/cYfkGV0J42B8vlOEjfWfOpkRGRmkYQ64mGdoUA50hszDNY13WdBAnx\n" .
    "WHhNtxYdlBSd7igaxAieQ6zwGggvlEx8s1pOvGFe4zAwbStrx3uZobFO4wIDAQAB\n" .
    "AoGBAKeWKi9L1tN/H2WwowAZRRcPS8mXp4tBpTUtA2OcAaAer/LgLrnZIYYxZviK\n" .
    "lCEu+ejg6q8GEeEJ7UF4AFB21HLSeVxY72tlm68Z/DRGvLrwubsBkfJ7+DV4Yabj\n" .
    "8kn3I2vs0FapcTKTofVVJHogE9mhXSNnNusDqy53o4mH6tyxAkEA2122w4SHkfNz\n" .
    "Wi1eSLMZX/qcr+7kGcMckOb3NkORu9cH9yJIEoVLNUoUEsMmWNDMSmyQWWyxATEe\n" .
    "xSTXZjf+1QJBANk8IawNIkajkJBT/5nyG+qqPCoDy5t+wC4/4jJIxhwGww0zPZDT\n" .
    "qVmpyfCV4TYbvzfhyDF3ioSap6lFcRKKItcCQFheoz6WSArquOBuAFpnE+TPT4ms\n" .
    "QeWC7SIOeS46AB5cnI/ZFpGncsmv4vA//1WuH24n1+q+V3v0bsHaeo9qJVUCQExq\n" .
    "uLWbUSlkNGBxDAMNhgCArfVhrGggqF4cnudtbjNBta+ZDNk7e+FMtvro3nZ4QEXa\n" .
    "KOAt2w5WkRAcm3AYI7UCQQCBKxXLYNzx343zzbXOKZHBdrbZ3oRSAi7zMRNt1gHT\n" .
    "yn16rEfVUiHmGgJeTZMdqE+zOZAE13Oi8pA9ZsCmlEyA\n" .
    "-----END RSA PRIVATE KEY-----",
    
    //llave de firma publica de Alignet
    'VposllaveVPOSFirmaPub' => "-----BEGIN PUBLIC KEY-----\n" .
    "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCvJS8zLPeePN+fbJeIvp/jjvLW\n" .
    "Aedyx8UcfS1eM/a+Vv2yHTxCLy79dEIygDVE6CTKbP1eqwsxRg2Z/dI+/e14WDRs\n" .
    "g0QzDdjVFIuXLKJ0zIgDw6kQd1ovbqpdTn4wnnvwUCNpBASitdjpTcNTKONfXMtH\n" .
    "pIs4aIDXarTYJGWlyQIDAQAB\n" .
    "-----END PUBLIC KEY-----",
    // llaves de cifrado privado de su comercio.
    'VposllaveComercioCryptoPriv' => "-----BEGIN RSA PRIVATE KEY-----\n" .
    "MIICXQIBAAKBgQDDWHEHbBSnuaDZK1pS1XGHE61fyoY+lJ4+GwQ8/fKM8O1+FT7a\n" .
    "rYJfjt8N6G0H7bU+SQXYIJB5nOxK4hPp1eFxsGOho4b1A0EDBleBlSigeKRrPKno\n" .
    "6UdXc9lml5LmzHif6prE1K2iy84JqNrPCMnR/dqalbZhDRdXn75FlUVovQIDAQAB\n" .
    "AoGAfAtdOulW9GrbyQvOf2sqfCvynDFura6SDb36IwDfVMBpDvdOwm4Lq8J9wccl\n" .
    "9TLtNHAKVgPXumH7alHFc2dtkDZFROKf+rJ9zEcmXQg62zaoPC9ZjqVjhcQVkEcc\n" .
    "0jhRCdZ9e4VBfvPIglt1GPYlLtQs8GeeMtR6UUHa8ubybAECQQD5si6GY5SrYWuA\n" .
    "tzsfcYG9MOjG33mkpM7VKhCSRqKTvviAtcTL50erHBh3hJI9vkZkIPW3s/KsU4/k\n" .
    "Vm+VHM2RAkEAyEb8K2Ez8GC7OCZ/2XfpLjEnkYLLZi8czJQ+H8qu+svykCLlcWrk\n" .
    "/KBJWx7+nl9F9RagT8u940rIP2pEa5rCbQJBALAvlPqIm2eONw+8uoAGVHhNYYKq\n" .
    "Pyf4jmUE6Gp+YssDjk8rcvA5gm1vRqhWp+XfM8YFJ7x2wb3svHRutQ8vIrECQE/a\n" .
    "DZz2KpFC4CKpJvx8FNq3+oDH13Usf50J1iMy2sVgH5xcbYLlDduzxMux9e8LKYdo\n" .
    "uA5Yu6MuI90074a/s5kCQQCgO5taB7LBdQYXCThk5tyYAXurToH6XIq0nG6hx8th\n" .
    "9LIbpeY6Sdq2pcjKYB77lxCeseSjSrMpvlDaQXTfzyYH\n" .
    "-----END RSA PRIVATE KEY-----",
];
