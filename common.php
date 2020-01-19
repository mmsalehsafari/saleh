<?
function dump($var,$return=false){
  if (is_array($var)){
    $out= print_r($var,true);
  } else if (is_object($var)){
    $out= var_export($var,true);
  } else {
    $out=$var;
  } if ($return){
    return "\n<pre style='direction: ltr;'>$out</pre>\n";
  } else {
    echo"\n<pre style='direction: ltr'>$out</pre>\n";
  }
}
function hr($return=false){
  if ($return){
    return "<hr>\n";
  } else {
    echo "<hr>\n";
  }
}
function br ($return=false){
  if ($return){
    return "<br>\n";
  }else{
    echo "<br>\n";
  }
}
function getCurrentDateTime(){
  return date("Y-m-d H:i:s");
}
function encryptPassword($password1){
  global $config;
  return md5($password1.$config['salt']);
}