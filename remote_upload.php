<?php 
//
//
// Script Remote upload utilisant l'api Streamango.com
// l'exemple ci dessous prend une url streamango et la copie sur votre compte.
// le résultat est un nouveau code embed du même fichier.
//
// 
$login = ''; //api login
$key = '';   //api key
$url = 'https://streamango.com/embed/mbmdbpnmkadlkdff/'; //url streamango quelquonque

$curl = curl_init();
$opts = [
	CURLOPT_URL => 'https://api.fruithosted.net/remotedl/add?login='.$login.'&key='.$key.'&url='.$url.'', //envoi de l'url en remote upload
	CURLOPT_RETURNTRANSFER => true,
];
curl_setopt_array($curl, $opts);

$response = json_decode(curl_exec($curl), true);
$file_id = $response['result']['id'];

echo '<pre>';
print_r($response); //affichage des infos du json de retour
echo '</pre>';

$curl2 = curl_init();
$opts = [
	CURLOPT_URL => 'https://api.fruithosted.net/remotedl/status?login='.$login.'&key='.$key.'&limit=1&id='.$file_id.'', //requete sur le status du dernier remote upload
	CURLOPT_RETURNTRANSFER => true,
];
curl_setopt_array($curl2, $opts);

$response = json_decode(curl_exec($curl2), true);

echo '<pre>';
print_r($response); //affichage des infos du json de retour
echo '</pre>';

$extid = $response['result'][''.$file_id.'']['extid'];

echo $code_embed = 'https://streamango.com/embed/'.$extid.'/'; //affiche le nouveau code embed

?>
