<meta name="viewport" content="width=device-width, initial-scale=1.0">
<center>
<?php
// Parse config.json
$config_json = file_get_contents('config.json');
if(!$config_json) {throw new Exception("Config file is invalid");}
$config = json_decode($config_json);

// Display Errors if debug is true
if($config->debug == "true") {ini_set('display_errors', 1);ini_set('display_startup_errors', 1);error_reporting(E_ALL);}

// include MadelineProto
if (!file_exists('madeline.php')) { copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');}
include 'madeline.php';

$profilepic = array();
$images = glob($config->picfolder . "/*.jpg");
/* Get profile pictures from folder */
foreach($images as $image) {array_push($profilepic,$image);}
// Create folders if not exist
if (!file_exists($config->picfolder)) {mkdir($config->picfolder, 0777, true);}
if (!file_exists('sessions/')) {mkdir('sessions', 0777, true);}
$stroke = $config->stroke;
$fontc = $config->text;

$MadelineProto = new \danog\MadelineProto\API('sessions/session.madeline');
$MadelineProto->start();

echo "\n Session Loaded !<br>";

date_default_timezone_set($config->timezone); /* Your Time Zone Here*/

$time= date('h A'); echo "Time is : $time<br>";
//$time=""; 
$date=date('d-m-y');

echo "date is $date<br>";
$names = $config->names; /* set random name */
$name=$names[array_rand($names)];
echo "Name is $name<br>";
$bios=$config->bios;
/* Don't use too large bio/name */
$bio=$bios[array_rand($bios)];
echo "Bio Text : $bio <br>";

$bioformat = "$bio|📆$date";
$nameformat = "$name|⏰$time";
$prof_image =$profilepic[array_rand($profilepic)];
$temp_image="temp.jpg";
// update name & bio
$MadelineProto->account->updateProfile(['first_name'=>substr($nameformat,0,64),'about'=>substr($bioformat,0,70)]);
$MadelineProto->account->updateStatus(['offline' => false ]);
echo "Successful<br>";

$a = $date;
//header('content-type: image/jpg');
//unlink("goto.jpg");
$img = imagecreatefromjpeg($prof_image);
$font = __DIR__ ."/font.ttf"; 

$txt = $a;
/** FIND MIDDLE OF IMAGE **/
//Get image dimensions
  $width = imagesx($img);
  $height = imagesy($img);
// Get center coordinates of image
  $centerX = $width / 2;
  $centerY = $height / 2;
  // Get size of text
$tsize = $config->text_size_multiplier * $height;
  list($left, $bottom, $right, $top) = imageftbbox($tsize, 0, $font, $txt);
// Determine offset of text
  $left_offset = ($right - $left) / 2;
  $top_offset = ($bottom - $top) / 2;
// Generate coordinates
  $x = $centerX - $left_offset;
  $y = $centerY - $top_offset;
// Add text to image
echo "x:$x ; y:$y";
echo "<br>USED IMAGE :<br><img style=\"width:100px;height:100px;\" src='$prof_image'>";
echo "<br> Text size is - $tsize ";
#imagettftext($img, $tsize, 0, $x,$y, $oq, $font, $txt);
function imagettfstroketext(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {
for($c1 = ($x-abs($px)); $c1 <= ($x+abs($px)); $c1++)
    for($c2 = ($y-abs($px)); $c2 <= ($y+abs($px)); $c2++)
        $bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);
    return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
}
// copied

$stroke_color = imagecolorallocate($img, $stroke[0], $stroke[1], $stroke[2]);
$font_color = imagecolorallocate($img, $fontc[0], $fontc[1], $fontc[2]);


imagettfstroketext($img, $tsize ,0, $x, $y, $font_color, $stroke_color, $font, $date, 2);
imagejpeg($img,$temp_image);
//header ('location: goto.jpg');

$logopic=$temp_image;
file_put_contents($temp_image,file_get_contents($logopic));
$info = $MadelineProto->get_full_info('me');
$inputPhoto = ['_' => 'inputPhoto', 'id' => $info['User']['photo']['photo_id'], 'access_hash' => $info['User']['access_hash'], 'file_reference' => 'bytes'];
$deletePhoto = $MadelineProto->photos->deletePhotos(['id'=>[$inputPhoto]]);
// delete old photo

$InputFile = $temp_image;
$photos_Photo = $MadelineProto->photos->uploadProfilePhoto(["file"=>$InputFile]);
// upload new photo

$base64_img = base64_encode(file_get_contents($InputFile));
if (php_sapi_name() === 'cli') {
echo "Uploaded Image from $InputFile";
} else {
echo "<br>Result :<br><img style=\"width:100px;height:100px;\" src='data:image/png;base64,$base64_img'>";
}

unlink("MadelineProto.log");
unlink($InputFile);
unlink("sessions/session.madeline");
?>
</center>