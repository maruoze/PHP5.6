--TEST--
Bug #60632: openssl_seal fails with AES
--SKIPIF--
<?php
if (!extension_loaded("openssl")) die("skip openssl not loaded");
?>
--FILE--
<?php
$pkey = openssl_pkey_new(array(
	'digest_alg' => 'sha256',
	'private_key_bits' => 1024,
	'private_key_type' => OPENSSL_KEYTYPE_RSA,
	'encrypt_key' => false
));
$details = openssl_pkey_get_details($pkey);
$test_pubkey = $details['key'];
$pubkey = openssl_pkey_get_public($test_pubkey);
$encrypted = null;
$ekeys = array();
$result = openssl_seal('test phrase', $encrypted, $ekeys, array($pubkey), 'AES-256-CBC');
echo "Done";
?>
--EXPECTF--
Warning: openssl_seal(): Ciphers with modes requiring IV are not supported in %s on line %d
Done
