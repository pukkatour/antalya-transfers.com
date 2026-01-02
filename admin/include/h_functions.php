<?php

///
/// 1- redirect
/// 2- getIP
/// 3- partition
/// 4- url_slug
/// 5- tirnak
/// 6- tagsil
/// 7- $spam_list
/// 8- telefon
///


### Redirect
function redirect($url)
{
if (headers_sent()) {
echo "<script>document.location='$url';</script>";
} else {
header('Location: '.$url);
}
exit;
}
### Redirect



### Real IP
function getIP()
{
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
$ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
$ip=$_SERVER['REMOTE_ADDR'];
}
return $ip;
}
### Real IP



### Partition
function partition(Array $list, $p)
{
$listlen = count($list);
$partlen = floor($listlen / $p);
$partrem = $listlen % $p;
$partition = array();
$mark = 0;
for($px = 0; $px < $p; $px ++) {
$incr = ($px < $partrem) ? $partlen + 1 : $partlen;
$partition[$px] = array_slice($list, $mark, $incr);
$mark += $incr;
}
return $partition;
}
### Partition



### Slug Generator
function url_slug($str, $options = array())
{

//$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

$defaults = array(
'delimiter' => '-',
'limit' => null,
'lowercase' => true,
'replacements' => array(),
'transliterate' => true,
);

$options = array_merge($defaults, $options);

$char_map = array('À' => 'A','Á' => 'A','Â' => 'A','Ã' => 'A','Ä' => 'A','Å' => 'A','Æ' => 'AE','Ç' => 'C','È' => 'E','É' => 'E','Ê' => 'E','Ë' => 'E','Ì' => 'I','Í' => 'I','Î' => 'I','Ï' => 'I','Ð' => 'D','Ñ' => 'N','Ò' => 'O','Ó' => 'O','Ô' => 'O','Õ' => 'O','Ö' => 'O','Ő' => 'O','Ø' => 'O','Ù' => 'U','Ú' => 'U','Û' => 'U','Ü' => 'U','Ű' => 'U','Ý' => 'Y','Þ' => 'TH','ß' => 'ss','à' => 'a','á' => 'a','â' => 'a','ã' => 'a','ä' => 'a','å' => 'a','æ' => 'ae','ç' => 'c','è' => 'e','é' => 'e','ê' => 'e','ë' => 'e','ì' => 'i','í' => 'i','î' => 'i','ï' => 'i','ð' => 'd','ñ' => 'n','ò' => 'o','ó' => 'o','ô' => 'o','õ' => 'o','ö' => 'o','ő' => 'o','ø' => 'o','ù' => 'u','ú' => 'u','û' => 'u','ü' => 'u','ű' => 'u','ý' => 'y','þ' => 'th','ÿ' => 'y','©' => '-','Α' => 'A','Β' => 'B','Γ' => 'G','Δ' => 'D','Ε' => 'E','Ζ' => 'Z','Η' => 'H','Θ' => '8','Ι' => 'I','Κ' => 'K','Λ' => 'L','Μ' => 'M','Ν' => 'N','Ξ' => '3','Ο' => 'O','Π' => 'P','Ρ' => 'R','Σ' => 'S','Τ' => 'T','Υ' => 'Y','Φ' => 'F','Χ' => 'X','Ψ' => 'PS','Ω' => 'W','Ά' => 'A','Έ' => 'E','Ί' => 'I','Ό' => 'O','Ύ' => 'Y','Ή' => 'H','Ώ' => 'W','Ϊ' => 'I','Ϋ' => 'Y','α' => 'a','β' => 'b','γ' => 'g','δ' => 'd','ε' => 'e','ζ' => 'z','η' => 'h','θ' => '8','ι' => 'i','κ' => 'k','λ' => 'l','μ' => 'm','ν' => 'n','ξ' => '3','ο' => 'o','π' => 'p','ρ' => 'r','σ' => 's','τ' => 't','υ' => 'y','φ' => 'f','χ' => 'x','ψ' => 'ps','ω' => 'w','ά' => 'a','έ' => 'e','ί' => 'i','ό' => 'o','ύ' => 'y','ή' => 'h','ώ' => 'w','ς' => 's','ϊ' => 'i','ΰ' => 'y','ϋ' => 'y','ΐ' => 'i','Ş' => 'S','İ' => 'I','Ğ' => 'G','ş' => 's','ı' => 'i','ğ' => 'g','А' => 'A','Б' => 'B','В' => 'V','Г' => 'G','Д' => 'D','Е' => 'E','Ё' => 'Yo','Ж' => 'Zh','З' => 'Z','И' => 'I','Й' => 'J','К' => 'K','Л' => 'L','М' => 'M','Н' => 'N','О' => 'O','П' => 'P','Р' => 'R','С' => 'S','Т' => 'T','У' => 'U','Ф' => 'F','Х' => 'H','Ц' => 'C','Ч' => 'Ch','Ш' => 'Sh','Щ' => 'Sh','Ъ' => '','Ы' => 'Y','Ь' => '','Э' => 'E','Ю' => 'Yu','Я' => 'Ya','а' => 'a','б' => 'b','в' => 'v','г' => 'g','д' => 'd','е' => 'e','ё' => 'yo','ж' => 'zh','з' => 'z','и' => 'i','й' => 'j','к' => 'k','л' => 'l','м' => 'm','н' => 'n','о' => 'o','п' => 'p','р' => 'r','с' => 's','т' => 't','у' => 'u','ф' => 'f','х' => 'h','ц' => 'c','ч' => 'ch','ш' => 'sh','щ' => 'sh','ъ' => '','ы' => 'y','ь' => '','э' => 'e','ю' => 'yu','я' => 'ya','Є' => 'Ye','І' => 'I','Ї' => 'Yi','Ґ' => 'G','є' => 'ye','і' => 'i','ї' => 'yi','ґ' => 'g','Č' => 'C','Ď' => 'D','Ě' => 'E','Ň' => 'N','Ř' => 'R','Š' => 'S','Ť' => 'T','Ů' => 'U','Ž' => 'Z','č' => 'c','ď' => 'd','ě' => 'e','ň' => 'n','ř' => 'r','š' => 's','ť' => 't','ů' => 'u','ž' => 'z','Ą' => 'A','Ć' => 'C','Ę' => 'e','Ł' => 'L','Ń' => 'N','Ś' => 'S','Ź' => 'Z','Ż' => 'Z','ą' => 'a','ć' => 'c','ę' => 'e','ł' => 'l','ń' => 'n','ś' => 's','ź' => 'z','ż' => 'z','Ā' => 'A','Ē' => 'E','Ģ' => 'G','Ī' => 'i','Ķ' => 'k','Ļ' => 'L','Ņ' => 'N','Ū' => 'u','ā' => 'a','ē' => 'e','ģ' => 'g','ī' => 'i','ķ' => 'k','ļ' => 'l','ņ' => 'n','ū' => 'u');

$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

if ($options['transliterate']) { $str = str_replace(array_keys($char_map), $char_map, $str); }
$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
$str = trim($str, $options['delimiter']);

return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}
### Slug Generator



### Tek Tırnak
function tirnak($str) 
{
$str = str_replace("'", "&#39;", $str);
$str = str_replace("\"", "&quot;", $str);
$str = str_replace("–", "-", $str);
$str = str_replace(chr(130), " ", $str);
//$str = str_replace(chr(132), " ", $str);
$str = str_replace(chr(145), "\"", $str);
$str = str_replace(chr(146), "\"", $str);
$str = str_replace(chr(147), "&quot;", $str);
$str = str_replace(chr(148), "&quot;", $str);
$str = str_replace(chr(151), "-", $str);
return $str;
}
### Tek Tırnak



### WYSWYG Editör Boş Tag Silme
function tagsil($tag) 
{
$pattern = "/<p[^>]*><\\/p[^>]*>/";
$tag = preg_replace($pattern, "", $tag);
$tag = str_replace("<p></p>", "", $tag);
$tag = str_replace("<p><p>", "", $tag);
$tag = str_replace("</p></p>", "", $tag);
$tag = str_replace("<i></i>", "", $tag);
$tag = str_replace("<b></b>", "", $tag);
$tag = str_replace("<div></div>", "", $tag);
return $tag;
}
### WYSWYG Editör Boş Tag Silme



### Email Spam Kontrol
function contains($spam_list, $message) {

if (count(array_intersect($spam_list, explode(" ", preg_replace("/[^A-Za-z0-9' -]/", "", $message)))) > 0) {
$res_ = 1;
} else {
$res_ = 0;
}

if (strpos($message, 'seks') !== false) { $res_ = 1; }
if (strpos($message, 'sex') !== false) { $res_ = 1; }
if (strpos($message, 'SEKS') !== false) { $res_ = 1; }
if (strpos($message, 'SEX') !== false) { $res_ = 1; }
if (strpos($message, 'Seks') !== false) { $res_ = 1; }
if (strpos($message, 'Sex') !== false) { $res_ = 1; }
if (strpos($message, 'html') !== false) { $res_ = 1; }
if (strpos($message, 'HTML') !== false) { $res_ = 1; }	
if (strpos($message, 'HTTP') !== false) { $res_ = 1; }	
if (strpos($message, 'http') !== false) { $res_ = 1; }
if (strpos($message, 'crypto') !== false) { $res_ = 1; }
if (strpos($message, 'Crypto') !== false) { $res_ = 1; }
if (strpos($message, 'CRYPTO') !== false) { $res_ = 1; }
if (strpos($message, 'Casino') !== false) { $res_ = 1; }
if (strpos($message, 'casino') !== false) { $res_ = 1; }
if (strpos($message, 'CASINO') !== false) { $res_ = 1; }

return $res_;

}

$spam_list = array('html', 'HTML', 'http', 'HTTP', 'href', 'HREF', '</a>', '</A>', '/">', 'bitcoin', 'BITCOIN', 'viagra', 'VIAGRA', '$$$', 'casino', 'CASINO', 'dvd', 'DVD', 'Egitim Seti', 'Egitim Bilgisi', 'TANITIM', 'tanıtım', 'SEKTOREL', 'sektörel', 'Egitim Seti', 'EGITIM SETI', 'EĞİTİM SETİ', '/ CD', '/ cd', '- cd', '- CD', 'https:', 'HTTPS:', 'sexy', 'SEXY', 'sex', 'SEX', 'cost of sending', 'Skype', 'Kennethdup', 'FeedbackForm2019');
### Email Spam Kontrol



### Telefon 0 boşluk () silme
function telefon($tel) 
{
$tel1 = ltrim($tel, "0");
$tel2 = preg_replace('/\s+/', '', $tel1);
$tel3 = str_replace(")","",$tel2);
$tel  = str_replace("(","",$tel3);
return $tel;
}
### Email Spam Kontrol

?>