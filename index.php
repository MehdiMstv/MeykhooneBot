<?php
$path = "https://api.telegram.org/bot<YOUR_TOKEN>";
$update_tel = json_decode(file_get_contents("php://input"), TRUE);
$chatId = $update_tel["message"]["chat"]["id"];
$message = $update_tel["message"]["text"];
$name = $update_tel["message"]["chat"]["first_name"];
$user = $update_tel["message"]["chat"]["username"];
$keyboard = array(
    array("حافظ","سعدی","مولوی","صائب"),
    array("اوحدی","خیام","شهریار","ابوسعید ابوالخیر"),
    array("باباطاهر","عراقی","فروغی بسطامی","عبید زاکانی","سیف فرغانی"),
    array("هاتف اصفهانی","رهی معیری","سلمان ساوجی","خواجو","محتشم کاشانی","امیرخسرو دهلوی")
);
$resp = array("keyboard" => $keyboard,"resize_keyboard" => false,"one_time_keyboard" => false);
$reply = json_encode($resp);
switch($message){
  case "/start":
     $msg = urlencode($name." عزیز، خوش اومدی\n برای دریافت بیت، کافیه اسم شاعر رو بفرستی. هر پیامی به جز اسم شاعر، یک بیت تصادفی برات میاره :) \n اگر پیام خالی برات اومد، مشکل از سرور سایت گنجور هست، کافیه دوباره امتحان کنی");
    file_get_contents($path."/sendMessage?chat_id=".$chatId."&text=".$msg."&parse_mode=Markdown&reply_markup=".$reply);
        $newuser = true;
    break;
    case "حافظ":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=2&a=1")); 
        break;
           case "سعدی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=7&a=1")); 
        break;
           case "مولوی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=5&a=1")); 
        break;
           case "صائب":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=22&a=1")); 
        break;
           case "اوحدی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=19&a=1")); 
        break;
           case "خیام":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=3&a=1")); 
        break;
           case "شهریار":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=35&a=1")); 
        break;
           case "ابوسعید ابوالخیر":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=26&a=1")); 
        break;
            case "باباطاهر":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=28&a=1")); 
        break;
            case "خواجو":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=20&a=1")); 
        break;
case "عراقی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=21&a=1")); 
        break;
                   case "فروغی بسطامی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=32&a=1")); 
        break;
                   
    case "سلمان ساوجی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=40&a=1")); 
        break;           
    case "محتشم کاشانی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=29&a=1")); 
        break;           
    case "امیرخسرو دهلوی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=34&a=1")); 
        break;
                  
    case "سیف فرغانی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=31&a=1")); 
        break;          
    case "عبید زاکانی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=33&a=1")); 
        break;           
    case "هاتف اصفهانی":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=25&a=1")); 
        break;
                   case "رهی معیری":
$xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?p=41&a=1")); 
        break;
    default:
        $xml = simpleXML_load_string(file_get_contents("http://c.ganjoor.net/beyt-xml.php?a=1")); 
        break;
}
if($newuser != true){
    if($xml -> poem -> count == "1"){
$msg = urlencode($xml -> poem -> b1 -> m1 ."\n".$xml -> poem -> b1 -> m2."\n [".$xml -> poem -> poet."](".$xml -> poem -> url.") \n @MeykhooneBot");
    }else{
  $msg = urlencode($xml -> poem -> b1 -> m1 ."\n".$xml -> poem -> b1 -> m2."\n"
                   .$xml -> poem -> b2 -> m1."\n".$xml -> poem -> b2 -> m2.
                   "\n [".$xml -> poem -> poet."](".$xml -> poem -> url.") \n @MeykhooneBot");
    }
file_get_contents($path."/sendMessage?chat_id=".$chatId."&text=".$msg."&parse_mode=Markdown");
}
>
