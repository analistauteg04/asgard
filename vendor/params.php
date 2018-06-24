<?php

return [
    'copyright' => 'Uteg',
    'alias' => 'UT',
    'web' => 'http://www.uteg.edu.ec',
    'version' => '1.0',
    'adminEmail' => 'web@uteg.edu.ec',
    'soporteEmail' => 'dlopez@uteg.edu.ec',
    'jefeadmisiones' => 'jefeadmisiones@uteg.edu.ec',
    'colecturia' => 'colecturia@uteg.edu.ec',
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
    'Vposvector' => "1EBCFD349F559E00",
    'VposacquirerId' => '8',
    'VposcommerceId' => '6821',
    'VpospurchaseCurrencyCode' => '840',
    'VposcommerceMallId' => '1',
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
    'VposllaveVPOSCryptoPub' => "-----BEGIN PUBLIC KEY-----\n". 
	"MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC0t0Cnbne8gQoeGK4nG6O3zfwh\n".
	"q8u9Wp5zHjyVYbvx2zudSOlBnJ5qU74BcTGypbn6W7jjvSNE7AmncOAVh4RxuRXO\n".
	"+bINFIyQ7/ErH/v1YpDFk8knC/NuvFpfHqhJ/5j2I8y+WmyF0MZmGtm074nUGv4d\n".
	"qlbUMT9aYUQ+RzMO7QIDAQAB\n".
	"-----END PUBLIC KEY-----",
    'VposllaveComercioFirmaPriv' => "-----BEGIN RSA PRIVATE KEY-----\n". 
	"MIICXAIBAAKBgQC9E/dx3K3K5HD+U8Wg9smDQIOrUF4kqxgpnyAFx/D8XSdib+O7\n".
	"1KQ96vNF0vzmyY00rKoxrAWmzsu1oS/NEuZmxhUIGaaKeLF+zYpIWUaIgeEVWZmy\n".
	"sbthk++l2UaRwl/sjfJ8jxRsEpnPp895MMdgVDdEE2Ej1M/CIaLRQUCZUwIDAQAB\n".
	"AoGAIFpgRt1p54O7SelvsaFIzeqmHRQ9Z6zXD5go1JRnyeburEtU/njeObIQOmxl\n".
	"1d+7B75byPAUb3yHIucX1NFdFwEgMVMeRK9dilOb04X7CS7x7y34D8nn/G1wfoJE\n".
	"Gu2QKNON0b9t6x24/u1VfVynTDOWSZGMGozYeouwb3lOWMECQQD11qMNQawIG//O\n".
	"BjZs+BjeqNT4W9DAjqKdzhXA77TrTWSTEpyjR5hPMWHXjYM9MeyZUopsHQxvM80n\n".
	"qMkBHKljAkEAxOS2swGpB3nVuHhDvU/2PEhpSnnhtuvcAza0Djwr7Q3pMNOb3QPJ\n".
	"OYVE/Qmx9vKHEYopGz4nWvKVI12J1OVLUQJADbyWk9ENmc5mts5mECS0zwxECjSn\n".
	"L3tI3uR7FrLOOy+x5P3vPrhrbFFoFDFWGf9GJzMThQMChNwyJHsr8CH33QJBAKUp\n".
	"cjSAvQifY+9FOxWQAO8akvA9g2DNQxaTCcEzKmnFFIq3x3RDm8WbjH5yZo3PbgwB\n".
	"iG/o2FyLRx2OdnNXELECQHpIOqBw1mGRdnoohzO7AQOAs4nxFnkVd32kIUAOk5v2\n".
	"odhhI/29Yi6yl3ALvcSq9Bqk/MtIRnrYJBZc8B4ySSs=\n".
	"-----END RSA PRIVATE KEY-----",
];
