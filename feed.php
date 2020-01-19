<?
require_once('main.php');

$db = Db::getInstance();
$keyword = $_POST['keyword'];
$records =$db->query("SELECT * FROM dict_word WHERE word LIKE '%$keyword%'");

$out['html'] ='';
$out['raw']=array();
foreach($records as $record){
  $out['html'] .= '<strong>' . $record['word'] . '</strong><br><span>' . $record['meaning'] . '</span><hr>';
  $out['raw'][] = $record;
}

echo json_encode($out);



?>