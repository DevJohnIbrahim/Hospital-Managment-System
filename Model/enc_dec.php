<?php
/**
 *
 */
interface Cypher
{
  public function encrypt();
  public function decrypt();
}
class CaesarCipherV1 implements Cypher{
public  $string;
public $key=10;
public $enc;
public $dec;
  function __construct($string){
    $this->string=$string;
  }
public function encrypt(){
  for ($x = 0 ; $x<strlen($this->string);$x++){
      $this->enc .= chr(ord($this->string{$x})+$this->key+$x);
  }
  return $this->enc;
}
public function decrypt(){
  for ($x = 0 ; $x<strlen($this->string);$x++){
      $this->dec .= chr(ord($this->string{$x})-$this->key-$x);
  }
  return $this->dec;
}

}

class CaesarCipherV2 implements Cypher{
  public  $string;
  public $key=25;
  public $enc;
  public $dec;
    function __construct($string){
      $this->string=$string;
    }
  public function encrypt(){
    for ($x = 0 ; $x<strlen($this->string);$x++){
        $this->enc .= chr(ord($this->string{$x})+$this->key+$x);
    }
    return $this->enc;
  }
  public function decrypt(){
    for ($x = 0 ; $x<strlen($this->string);$x++){
        $this->dec .= chr(ord($this->string{$x})-$this->key-$x);
    }
    return $this->dec;
  }


}


class Encryption_Decryption{
   public $cypher;
   function __construct(Cypher $cypher){
     $this->cypher=$cypher;
   }
   function useEncrypte(){
    return $this->cypher->encrypt();
   }
   function useDecrypte(){
    return $this->cypher->decrypt();
   }

}

 $x = new CaesarCipherV1("John");
 $y=new Encryption_Decryption($x);
 $z=$y->useEncrypte();

 $x=new CaesarCipherV1($z);
 $y=new Encryption_Decryption($x);
 $z=$y->useDecrypte();

 ?>
