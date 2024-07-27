<?php
define('API_KEY',"7131572490:AAHHcyDTCaEHmbHaeS1sjRsdw97krqeQJuM");

$admin = "5754645972";
//Manba: no dasturchi @sunnat_acc
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}}

function deleteFolder($path){
if(is_dir($path) === true){
$files = array_diff(scandir($path), array('.', '..'));
foreach ($files as $file)
deleteFolder(realpath($path) . '/' . $file);
return rmdir($path);
}else if (is_file($path) === true)
return unlink($path);
return false;
}

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$kanallar=file_get_contents("channel.txt");
if($kanallar == null){
return true;
}else{
$ex = explode("\n",$kanallar);
for($i=0;$i<=count($ex) -1;$i++){
$first_line = $ex[$i];
$first_ex = explode("@",$first_line);
$url = $first_ex[1];
$ism=bot('getChat',['chat_id'=>"@".$url,])->result->title;
$ret = bot("getChatMember",[
"chat_id"=>"@$url",
"user_id"=>$id,
]);
$stat = $ret->result->status;
if((($stat=="creator" or $stat=="administrator" or $stat=="member"))){
$array['inline_keyboard']["$i"][0]['text'] = "✅ ". $ism;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
}else{
$array['inline_keyboard']["$i"][0]['text'] = "❌ ". $ism;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
$uns = true;
}
}
$array['inline_keyboard']["$i"][0]['text'] = "🔄 Tekshirish";
$array['inline_keyboard']["$i"][0]['callback_data'] = "azo_boldim";
if($uns == true){
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>⚠️ Botdan to'liq foydalanish uchun quyidagi kanallarimizga obuna bo'ling!</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode($array),
]);
return false;
}else{
return true;
}}}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$tx = $message->text;
$mid = $message->message_id;
$name = $message->from->first_name;
$fid = $message->from->id;
$callback = $update->callback_query;
$data = $callback->data;
$callid = $callback->id;
$ccid = $callback->message->chat->id;
$cmid = $callback->message->message_id;
$from_id = $update->message->from->id;
$token = $message->text;
$text = $message->text;
$name = $message->from->first_name;
$message_id = $callback->message->message_id;
$data = $update->callback_query->data;
$callcid=$update->callback_query->message->chat->id;
$cqid = $update->callback_query->id;
$callfrid = $update->callback_query->from->id;
$botname = bot('getme',['bot'])->result->username;
#-----------------------------
mkdir("statistika");
mkdir("step");
mkdir("ban");
#-----------------------------

if(!file_exists("channel.txt")){
file_put_contents("channel.txt","");
}
if(file_get_contents("statistika/obunachi.txt")){
} else{
file_put_contents("statistika/obunachi.txt", "0");
}

$saved = file_get_contents("step/odam.txt");
$ban = file_get_contents("ban/$fid.txt");
$statistika = file_get_contents("statistika/obunachi.txt");
$soat=date("H:i",strtotime("2 hour"));
$userstep=file_get_contents("step/$fid.txt");
$kanallar=file_get_contents("channel.txt");

if($tx){
if($ban == "ban"){
exit();
}else{
}}

if($data){
$ban = file_get_contents("ban/$ccid.txt");
if($ban == "ban"){
exit();
}else{
}}

if(isset($callback)){
$get = file_get_contents("statistika/obunachi.txt");
if(mb_stripos($get,$callfrid)==false){
file_put_contents("statistika/obunachi.txt", "$get\n$callfrid");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>$name 🤨 Kimdur botga /start bosdi🙄. Eye yangi obunachi ekanu😜!</b>",
'parse_mode'=>"html"
]);
}}

if(isset($message)){
$get = file_get_contents("statistika/obunachi.txt");
if(mb_stripos($get,$fid)==false){
file_put_contents("statistika/obunachi.txt", "$get\n$fid");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>$name 🤨 Kimdur botga /start bosdi🙄. Eye yangi obunachi ekanu😜!</b>",
'parse_mode'=>"html"
]);
}}

if($tx=="/start" and joinchat($cid)=="true"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>ASOSIY MENYUDASIZ</b>!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🦀XM GLOBAL",'url'=>"http://t.me/MT5_TREDINGBOT/APP"],['text'=>"MT5📈",'url'=>"http://t.me/MT5_TREDINGBOT/Mt5"]],
[['text'=>"💷 Valyuta kursi",'callback_data'=>"valyuta"]],
[['text'=>"Signal",'callback_data'=>"ramma"],['text'=>"VIP kanal",'callback_data'=>"raaim"]],
[['text'=>"💌 Adminga xabar👮",'callback_data'=>"boglanish"],['text'=>"Bot haqida maʼlumot",'callback_data'=>"rapm"]],
]])
]);
unlink("step/$cid.txt");
unlink("fbsh.txt");
}

if($data == "azo_boldim"){
if(joinchat($ccid) == "true"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>ASOSIY MENYUDASIZ</b>!",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🦀XM GLOBAL",'url'=>"http://t.me/MT5_TREDINGBOT/APP"],['text'=>"MT5📈",'url'=>"http://t.me/MT5_TREDINGBOT/Mt5"]],
[['text'=>"💷 Valyuta kursi",'callback_data'=>"valyuta"]],
[['text'=>"Signal",'callback_data'=>"ramma"],['text'=>"VIP kanal",'callback_data'=>"raaim"]],
[['text'=>"💌 Adminga xabar👮",'callback_data'=>"boglanish"],['text'=>"Bot haqida maʼlumot",'callback_data'=>"rapm"]],
]])
]);
}else{
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
}}

if($data == "menyu" and joinchat($ccid) == "true"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>ASOSIY MENYUDASIZ</b>!",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🦀XM GLOBAL",'url'=>"http://t.me/MT5_TREDINGBOT/APP"],['text'=>"MT5📈",'url'=>"http://t.me/MT5_TREDINGBOT/Mt5"]],
[['text'=>"💷 Valyuta kursi",'callback_data'=>"valyuta"]],
[['text'=>"Signal",'callback_data'=>"ramma"],['text'=>"VIP kanal",'callback_data'=>"raaim"]],
[['text'=>"💌 Adminga xabar👮",'callback_data'=>"boglanish"],['text'=>"Bot haqida maʼlumot",'callback_data'=>"rapm"]],
]])
]);
unlink("step/$ccid.txt");
}

if($data=="valyuta"){
function kurs(){
$response = "";
$xml = file_get_contents("http://cbu.uz/uzc/arkhiv-kursov-valyut/xml/");
$m = new SimpleXMLElement($xml);
foreach ($m as $val) {
if($val->Ccy == 'RUB'){
$response .= "🇷🇺 1 Rossiya rubli = ".$val->Rate." so'm\n";
}
if($val->Ccy == 'USD'){
$response .= "🇺🇸 1 Amerika dollari = ".$val->Rate." so'm\n";
}
if($val->Ccy == 'EUR'){
$response .= "🇪🇺 1 EVRO = ".$val->Rate." so'm\n";
}}
return $response;
} function Parse($p1, $p2, $p3) {
$num1 = strpos($p1, $p2);
if($num1 === false) return 0;
$num2 = substr($p1, $num1);
return strip_tags(substr($num2, 0, strpos($num2, $p3)));
}
$marhamat = kurs();
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>💷 Valyuta kursi sahifasiga xush kelibsiz!</b>

$marhamat",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"❌ Ortga Qaytish",'callback_data'=>"menyu"],['text'=>"🔁 Yangilash",'callback_data'=>"valyuta"]],


]])
]);
}

if($data == "raaim" and joinchat($ccid) == "true"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendphoto',[
'chat_id'=>$ccid,
'photo'=>"https://t.me/baza_III/107",
'caption'=>"<b>VIP KANALGA QOʻSHILISH PULLIK.
Siz ishonchli va aniq signallarni Vip kanaldan topishingiz mumkin. Qoʻshilmoqchi boʻlsangiz ADMIN murojaat qiling.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"ADMINISTRATOR",'url'=>"https://t.me/TReDiNG_404"]],
[['text'=>"🔙 Ortga",'callback_data'=>"menyu"]],
]])
]);
}

////

if($data == "ramma" and joinchat($ccid) == "true"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendphoto',[
'chat_id'=>$ccid,
'photo'=>"https://t.me/baza_III/106",
'caption'=>"<b>TEKIN SIGNAL PASTDAGI KANALDA BERIB BORILADI.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"KANALGA OʻTISH",'url'=>"https://t.me/TReDiNG_404"]],
[['text'=>"🔙 Ortga",'callback_data'=>"menyu"]],
]])
]);
}

////

if($data == "rapm" and joinchat($ccid) == "true"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendphoto',[
'chat_id'=>$ccid,
'photo'=>"https://t.me/baza_III/111",
'caption'=>"<b>BOTIMIZ QULAYLIKLARI. 
Siz botdan chiqmagan holatda Savdo qilishingiz va Xm brokkerlik kompaniyasi orqali haqiqiy hisob yaratishingiz mumkin.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"ADMINGA MUROJAAT",'url'=>"http://t.me/"]],
[['text'=>"🔙 Ortga",'callback_data'=>"menyu"]],
]])
]);
}




if($data=="boglanish"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<blockquote>📝 Murojaat matnini yuboring:</blockquote>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"❌ Ortga Qaytish",'callback_data'=>"menyu"]],
]])
]);
file_put_contents("step/$ccid.txt","murojat");
}

if($userstep=="murojat"){
if($data=="menyu"){
unlink("step/$cid.txt");
}else{
file_put_contents("step/$cid.murojat","$cid");
$murojat=file_get_contents("step/$cid.murojat");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<blockquote>📨 Yangi murojat keldi:</blockquote> <a href='tg://user?id=$murojat'>$murojat</a>

<blockquote>📑 Murojat matni:</blockquote> $tx

<blockquote>⏰ Kelgan vaqti:</blockquote> $soat",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💌 Javob yozish",'callback_data'=>"yozish=$murojat"]],
]])
]);
unlink("step/$murojat.txt");
bot('sendMessage',[
'chat_id'=>$murojat,
'text'=>"<blockquote>✅ Murojaatingiz yuborildi.</blockquote>

<i>Tez orada javob qaytaramiz!</i>",
'parse_mode'=>'html',
]);
}}

if(mb_stripos($data,"yozish=")!==false){
$odam=explode("=",$data)[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<blockquote>Javob matnini yuboring:</blockquote>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"❌ Ortga Qaytish",'callback_data'=>"menyu"]],
]])
]);
file_put_contents("step/$ccid.txt","javob");
file_put_contents("step/$ccid.javob","$odam");
}

if($userstep=="javob"){
if($data=="menyu"){
unlink("step/$admin.txt");
unlink("step/$admin.javob");
}else{
$murojat=file_get_contents("step/$cid.javob");
bot('sendMessage',[
'chat_id'=>$murojat,
'text'=>"<blockquote>☎️ Administrator:</blockquote>

<i> $tx </i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Javob yozish",'callback_data'=>"boglanish"]],
]])
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<blockquote>Javob yuborildi</blockquote>",
'parse_mode'=>"html",
]);
unlink("step/$murojat.murojat");
unlink("step/$admin.txt");
unlink("step/$admin.javob");
}}



$admin1_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📨 Xabar yuborish"]],
[['text'=>"📢 Kanallar"],['text'=>"📊 Statistika"]],
]]);

if($tx == "🗄 Boshqaruv" and $cid == $admin){
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🗄 Boshqaruv paneliga xush kelibsiz!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu
]);
unlink("step/$cid.txt");
unlink("miqdor.txt");
unlink("fbsh.txt");
}

$oddiy_xabar = file_get_contents("oddiy.txt");
if($data == "oddiy_xabar" and $ccid==$admin){
$lich=substr_count($statistika,"\n");
bot('deleteMessage',[
'chat_id'=>$admin,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>$lich ta foydalanuvchiga yuboriladigan xabar matnini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("oddiy.txt","oddiy");
}
if($oddiy_xabar=="oddiy" and $cid==$admin){
if($tx=="🗄 Boshqaruv"){
unlink("oddiy.txt");
}else{
$lich=substr_count($statistika,"\n");
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"<b>$lich ta foydalanuvchiga xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
$lichka = explode("\n",$statistika);
foreach($lichka as $lichkalar){
$usr=bot("sendMessage",[
'chat_id'=>$lichkalar,
'text'=>$text,
'parse_mode'=>'HTML'
]);
unlink("oddiy.txt");
}}}
if($usr){
$lich=substr_count($statistika,"\n");
bot("sendmessage",[
'chat_id'=>$admin,
'text'=>"<b>$lich ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("oddiy.txt");
}

$forward_xabar = file_get_contents("forward.txt");
if($data =="forward_xabar" and $ccid==$admin){
$lich=substr_count($statistika,"\n");
bot('deleteMessage',[
'chat_id'=>$admin,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>$lich ta foydalanuvchiga yuboriladigan xabarni forward shaklida yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("forward.txt","forward");
}
if($forward_xabar=="forward" and $cid==$admin){
if($tx=="🗄 Boshqaruv"){
unlink("forward.txt");
}else{
$lich=substr_count($statistika,"\n");
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"<b>$lich ta foydalanuvchiga xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin1_menu,
]);
$lichka = explode("\n",$statistika);
foreach($lichka as $lichkalar){
$fors=bot("forwardMessage",[
'from_chat_id'=>$cid,
'chat_id'=>$lichkalar,
'message_id'=>$mid,
]);
unlink("forward.txt");
}}}
if($fors){
$lich=substr_count($statistika,"\n");
bot("sendmessage",[
'chat_id'=>$admin,
'text'=>"<b>$lich ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("forward.txt");
}

if($tx=="📨 Xabar yuborish" and $cid==$admin){
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📨 Yuboriladigan xabar turini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=> json_encode([
'inline_keyboard'=>[
[['text'=>"Oddiy xabar",'callback_data'=>"oddiy_xabar"]],
[['text'=>"Forward xabar",'callback_data'=>"forward_xabar"]],
]])
]);
}

$admin6_menu = json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obuna",'callback_data'=>"majburiy_obuna"]],
]]);

if($data=="kanalsoz" and $ccid==$admin){
bot('deleteMessage',[
'chat_id'=>$admin,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Majburiy obuna",'callback_data'=>"majburiy_obuna"]],
]])
]);
unlink("step/$ccid.txt");
}

if($tx == "📊 Statistika" and $cid == $admin){
$lich=substr_count($statistika,"\n");
$load = sys_getloadavg();
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $lich ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}

if($data=="stats" and $ccid == $admin){
$lich=substr_count($statistika,"\n");
$load = sys_getloadavg();
bot('deleteMessage',[
'chat_id'=>$admin,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

👥 <b>Foydalanuvchilar: $lich ta</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
}

if($tx=="📢 Kanallar" and $cid==$admin){
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=>$admin6_menu
]);
}

if($data=="majburiy_obuna" and $ccid==$admin){
bot('editMessageText',[
'chat_id'=>$admin,
'message_id'=>$cmid,
'text'=>"<b>Majburiy obunalarni sozlash bo'limidasiz:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Ro'yxatni ko'rish",'callback_data'=>"majburiy_obuna3"]],
[['text'=>"➕ Kanal qo'shish",'callback_data'=>"majburiy_obuna1"],['text'=>"🗑 O'chirish",'callback_data'=>"majburiy_obuna2"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanalsoz"]],

]])
]);
unlink("step/$cid.txt");
}

$majburiy = file_get_contents("maj.txt");
if($data=="majburiy_obuna1" and $ccid == $admin){
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📢 Kerakli kanalni manzilini yuboring:</b>

Namuna: @Editphp",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("maj.txt","majburiy1");
}
if($majburiy == "majburiy1" and $cid==$admin){
if($tx=="🗄 Boshqaruv"){
unlink("maj.txt");
}else{
if(stripos($text,"@")!==false){
if($kanallar == null){
file_put_contents("channel.txt",$text);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>$text - kanal qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("maj.txt");
}else{
file_put_contents("channel.txt","$kanallar\n$text");
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>"<b>$text - kanal qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$admin1_menu,
]);
unlink("maj.txt");
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Kanal manzili kiritishda xatolik:</b>

Masalan: @sunnat_acc",
'parse_mode'=>'html',
]);
}}}

if($data=="majburiy_obuna2" and $ccid == $admin){
bot('deleteMessage',[
'chat_id'=>$admin,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>🗑 Kanallar o'chirildi!</b>",
'parse_mode'=>"html",
]);
unlink("channel.txt");
}

if($data=="majburiy_obuna3" and $ccid==$admin){
if($kanallar==null){
bot('editMessageText',[
'chat_id'=>$admin,
'message_id'=>$cmid,
'text'=>"<b>Kanallar ulanmagan!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy_obuna"]],
]])
]);
}else{
$soni = substr_count($kanallar,"@");
bot('editMessageText',[
'chat_id'=>$admin,
'message_id'=>$cmid,
'text'=>"<b>Ulangan kanallar ro'yxati ⤵️</b>
➖➖➖➖➖➖➖➖

<i>$kanallar</i>

<b>Ulangan kanallar soni:</b> $soni ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy_obuna"]],
]])
]);
}}

if($tx=="/panel" and $cid==$admin){
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"🖥",
'reply_markup'=>$admin1_menu,
]);
unlink("admin/$cid.txt");
unlink("fbsh.txt");
}
?>
