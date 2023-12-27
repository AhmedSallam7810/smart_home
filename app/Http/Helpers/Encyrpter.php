<?php

namespace App\Http\Helpers;


trait Encyrpter{

  private $key = "secret";
  private $method = "AES-256-CBC";

  public function encyrpt($data){
  
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));
  $encrypted = openssl_encrypt($data, $this->method, $this->key, 0, $iv);
  $encrypted = base64_encode($iv.$encrypted);
  return $encrypted;
}

  public function decyrpt($data){

  $encrypted = base64_decode($data);
  $iv = substr($encrypted, 0, openssl_cipher_iv_length($this->method));
  $encrypted = substr($encrypted, openssl_cipher_iv_length($this->method));
  $decrypted = openssl_decrypt($encrypted, $this->method, $this->key, 0, $iv);

      return $decrypted;
}



}