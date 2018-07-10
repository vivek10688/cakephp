<?php
App::uses('Component','Controller');
App::uses('HttpSocket', 'Network/Http');
define('WATERMARK_MARGIN_ADJUST', 5);
define('WATERMARK_FONT_REALPATH', APP.'tmp'.DS);
class CustomfunctionComponent extends Component
{
    public $components = array('Session');
    public function secondsToWords($seconds,$msg="Unlimited")
    {
        $ret = "";
        if($seconds>0)
        {
            /*** get the hours ***/
            $hours = intval(intval($seconds) / 3600);
            if($hours > 0)
            {
                $ret .= $hours.' '.__('Hours').' ';
            }
            /*** get the minutes ***/
            $minutes = bcmod((intval($seconds) / 60),60);
            if($hours > 0 && $minutes > 0)
            {
                $ret .= $minutes.' '.__('Mins').' ';
            }
            $tarMinutes = bcmod((intval($seconds)),60);
            if(strlen($ret)==0 || $tarMinutes>0)
            {
                if($tarMinutes>0)
                $ret .= $tarMinutes.' '.__('Sec');
                else
                $ret .= $seconds.' '.__('Sec');
            }
        }
        else
        {
            $ret=$msg;
        }
        return $ret;
    }
    public function generate_rand($digit=6)
    {
      $no=substr(strtoupper(md5(uniqid(rand()))),0,$digit);
      return $no;
    }
    public function secondsToHourMinute($seconds)
    {
        $ret = "";
        if($seconds>0)
        {
            /*** get the hours ***/
            $hours = intval(intval($seconds) / 3600);
            if($hours > 0)
            {
                $ret .= "$hours.";
            }
            /*** get the minutes ***/
            $minutes = bcmod((intval($seconds) / 60),60);
            if($hours > 0 || $minutes > 0)
            {
                $ret .= "$minutes";
            }
        }
        else
        {
            $ret="";
        }
        return (float) $ret;
    }
    public function sendSms($mobileNo,$message,$smsArr=array())
    {
        $url=$smsArr['Smssetting']['api'];
        $postType=$smsArr['Smssetting']['post_type'];
        $postData=array($smsArr['Smssetting']['husername']=>$smsArr['Smssetting']['username'],$smsArr['Smssetting']['hpassword']=>$smsArr['Smssetting']['password'],$smsArr['Smssetting']['hsenderid']=>$smsArr['Smssetting']['senderid'],$smsArr['Smssetting']['hmobile']=>$mobileNo,$smsArr['Smssetting']['hmessage']=>$message);
        $othersFields=$smsArr['Smssetting']['others'];
        if(strlen($othersFields)>0){
            $othersFieldsArr=explode("&",$othersFields);
            foreach($othersFieldsArr as $fldArr){
                $fieldValArr=explode("=",$fldArr);
                $heading=$fieldValArr[0];
                $value=$fieldValArr[1];
                $postData[$heading]=$value;
            }
            $query=$postData;            
        }
        else{
            $query=$postData;
        }
        //$file = new File(TMP.'sms.txt',true,0777);
        //$file->write($url.'\n'.$mobileNo.'\n'.$message.'\n','a',true);
        //$file->close();
        if (!$this->HttpSocket) {
            $this->HttpSocket = new HttpSocket();
        }
        if($postType=="GET") {
            $response=$this->HttpSocket->get($url, $query);
        }
        else {
            $response=$this->HttpSocket->post($url, $query);
        }
        $parsed = str_replace(array('{"{\"','\"','}":""}'),"",json_encode($this->parseApiResponse($response)));
        return$parsed;
    }
    public function parseApiResponse($response) {
		parse_str($response , $parsed);
		return $parsed;
	}
    public function upload($tmpFile,$file,$path,$watermark=null,$isThumb=true,$width=150,$height=150,$fileName="",$extArr=array("jpg","gif","png","jpeg","JPG"))
    {
        if(strlen($file)>0)
        {
            $pathinfo   = pathinfo(trim($file));
            if(strlen($fileName)==0)
            if(in_array($pathinfo['extension'],$extArr))
            {
                $imageDir = APP.'webroot'.DS;
                $fileName=date('Y-m-d').'-'.rand().'.'.$pathinfo['extension'];
                $uploadPath=$imageDir.'img'.DS.$path.DS;
                $thumbPath=$imageDir.'img'.DS."$path"."_thumb".DS;
                if(move_uploaded_file($tmpFile,$uploadPath.$fileName))
                {
                    $imgSizeArr=getimagesize($uploadPath.$fileName);
                    if($imgSizeArr[0]>800 && $imgSizeArr[1]>600){
                        $this->resizedUrl($watermark,$fileName,$uploadPath,$uploadPath,'800','600');
                    }
                    else{
                        if(strlen($watermark)>0){
                           $this->resizedUrl($watermark,$fileName,$uploadPath,$uploadPath,$imgSizeArr[0],$imgSizeArr[1]);
                        }
                    }
                    if($isThumb==true)
                    {
                        $this->resizedUrl(null,$fileName,$uploadPath,$thumbPath,$width,$height);
                    }
                    return $fileName;
                }
            }
        }
        $fileName="";
        return$fileName;
    }
    public function uploadFile($tmpFile,$file,$path,$fileName="",$extArr=array("mp4","webm","ogg","mp3","wav"))
    {
        if(strlen($file)>0)
        {
            $pathinfo   = pathinfo(trim($file));
            if(strlen($fileName)==0)
            if(in_array($pathinfo['extension'],$extArr))
            {
                $imageDir = APP.'webroot'.DS;
                $fileName=date('Y-m-d').'-'.rand().'.'.$pathinfo['extension'];
                $uploadPath=$imageDir.'img'.DS.$path.DS;
                if(move_uploaded_file($tmpFile,$uploadPath.$fileName))
                {
                    return $fileName;
                }
            }
        }
        $fileName="";
        return$fileName;
    }
    public function resizedUrl($watermark,$file,$uploadPath,$thumbPath, $max_width, $max_height, $quality = 100){
        # We define the image dir include Theme support
        # We find the right file
        $pathinfo   = pathinfo(trim($file, '/'));
        $targetFile= $uploadPath.$file;
        $output     = $thumbPath.$file;
        if (file_exists($targetFile)) {
            # Setting defaults and meta
            $info  = getimagesize($targetFile);
            list($orig_width, $orig_height) = $info;
            # Create image ressource
            switch ( $info[2] ) {
                case IMAGETYPE_GIF:   $image = imagecreatefromgif($targetFile);   break;
                case IMAGETYPE_JPEG:  $image = imagecreatefromjpeg($targetFile);  break;
                case IMAGETYPE_PNG:   $image = imagecreatefrompng($targetFile);   break;
                default: return false;
            }
            $width = $orig_width;
            $height = $orig_height;
        
            # wider
            if ($width > $max_width) {
                $height = floor(($max_width / $width) * $height);
                $width = $max_width;
            }
            
            $image_resized = imagecreatetruecolor($width, $height);
            # This is the resizing/resampling/transparency-preserving magic
            if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
                $transparency = imagecolortransparent($image);
                if ($transparency >= 0) {
                    $transparent_color  = imagecolorsforindex($image, $trnprt_indx);
                    $transparency       = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                    imagefill($image_resized, 0, 0, $transparency);
                    imagecolortransparent($image_resized, $transparency);
                    imagefill($image_resized, 0, 0, $transparency);
                    imagecolortransparent($image_resized, $transparency);
                }elseif ($info[2] == IMAGETYPE_PNG) {
                    imagealphablending($image_resized, false);
                    imagealphablending($image_resized, false);
                    $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                    imagefill($image_resized, 0, 0, $color);
                    imagesavealpha($image_resized, true);
                    imagefill($image_resized, 0, 0, $color);
                    imagesavealpha($image_resized, true);
                }
            }
            ImageCopyResized($image_resized, $image, 0, 0, 0, 0,$width,$height,$orig_width,$orig_height);
            # Writing image according to type to the output destination and image quality
            switch ( $info[2] ) {
              case IMAGETYPE_GIF:   imagegif($image_resized, $output, $quality);    break;
              case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
              case IMAGETYPE_PNG:   imagepng($image_resized, $output, 9);    break;
              default: return false;
            }
            if(strlen($watermark)>0){
                $output=$this->watermarkImage($image_resized,$height,$watermark,$output,$info[2],$quality);
            }
        }
        return $output;
    }
    private function watermarkImage($image_resized,$height,$watermark,$output,$imgType,$quality)
    {
        if($height>0 && $height<=150){
            $fontSize=8;
        }
        elseif($height>150 && $height<=200){
            $fontSize=14;
        }
        elseif($height>200 && $height<=300){
            $fontSize=20;
        }
        elseif($height>300 && $height<=400){
            $fontSize=25;
        }
        elseif($height>400 && $height<=500){
            $fontSize=30;
        }
        elseif($height>500 && $height<=600){
            $fontSize=35;
        }
        elseif($height>600 && $height<=700){
            $fontSize=40;
        }
        elseif($height>700 && $height<=800){
            $fontSize=45;
        }
        elseif($height>800 && $height<=900){
            $fontSize=50;
        }
        elseif($height>900 && $height<=1000){
            $fontSize=60;
        }
        elseif($height>1000 && $height<=1500){
            $fontSize=65;
        }
        else{
           $fontSize=70; 
        }
        switch ($imgType) {
        case IMAGETYPE_GIF:
            $image_resized = imagecreatefromgif($output);
            break;
        case IMAGETYPE_JPEG:
            $image_resized = imagecreatefromjpeg($output);
            break;
        case IMAGETYPE_PNG:
            $image_resized = imagecreatefrompng($output);
            break;
        default:
            return false;
        }
        $color='CCCCCC';
        $this->render_text_on_gd_image($image_resized,$watermark,'arial.ttf',$fontSize,$color,50,45,32);
        imagejpeg($image_resized, $output, $quality);
        imagedestroy($image_resized);
        return $output;
    }
    private function render_text_on_gd_image(&$source_gd_image, $text, $font, $size, $color, $opacity, $rotation, $align)
    {
        $source_width = imagesx($source_gd_image);
        $source_height = imagesy($source_gd_image);
        $bb = $this->imagettfbbox_fixed($size, $rotation, $font, $text);
        $x0 = min($bb[0], $bb[2], $bb[4], $bb[6]) - WATERMARK_MARGIN_ADJUST;
        $x1 = max($bb[0], $bb[2], $bb[4], $bb[6]) + WATERMARK_MARGIN_ADJUST;
        $y0 = min($bb[1], $bb[3], $bb[5], $bb[7]) - WATERMARK_MARGIN_ADJUST;
        $y1 = max($bb[1], $bb[3], $bb[5], $bb[7]) + WATERMARK_MARGIN_ADJUST;
        $bb_width = abs($x1 - $x0);
        $bb_height = abs($y1 - $y0);
        switch ($align) {
            case 11:
                $bpy = -$y0;
                $bpx = -$x0;
                break;
            case 12:
                $bpy = -$y0;
                $bpx = $source_width / 2 - $bb_width / 2 - $x0;
                break;
            case 13:
                $bpy = -$y0;
                $bpx = $source_width - $x1;
                break;
            case 21:
                $bpy = $source_height / 2 - $bb_height / 2 - $y0;
                $bpx = -$x0;
                break;
            case 22:
                $bpy = $source_height / 2 - $bb_height / 2 - $y0;
                $bpx = $source_width / 2 - $bb_width / 2 - $x0;
                break;
            case 23:
                $bpy = $source_height / 2 - $bb_height / 2 - $y0;
                $bpx = $source_width - $x1;
                break;
            case 31:
                $bpy = $source_height - $y1;
                $bpx = -$x0;
                break;
            case 32:
                $bpy = $source_height - $y1;
                $bpx = $source_width / 2 - $bb_width / 2 - $x0;
                break;
            case 33;
                $bpy = $source_height - $y1;
                $bpx = $source_width - $x1;
                break;
        }
        $alpha_color = imagecolorallocatealpha(
            $source_gd_image,
            hexdec(substr($color, 0, 2)),
            hexdec(substr($color, 2, 2)),
            hexdec(substr($color, 4, 2)),
            127 * (100 - $opacity) / 100
        );
        return imagettftext($source_gd_image, $size, $rotation, $bpx, $bpy, $alpha_color, WATERMARK_FONT_REALPATH . $font, $text);
    }
    
    /*
     * Fix for the buggy imagettfbbox implementation in gd library
     */
    
    private function imagettfbbox_fixed($size, $rotation, $font, $text)
    {
        $bb = imagettfbbox($size, 0, WATERMARK_FONT_REALPATH . $font, $text);
        $aa = deg2rad($rotation);
        $cc = cos($aa);
        $ss = sin($aa);
        $rr = array();
        for ($i = 0; $i < 7; $i += 2) {
            $rr[$i + 0] = round($bb[$i + 0] * $cc + $bb[$i + 1] * $ss);
            $rr[$i + 1] = round($bb[$i + 1] * $cc - $bb[$i + 0] * $ss);
        }
        return $rr;
    }
    public function fileDelete($fileName,$imageDir,$isThumb=true,$path=null)
    {
        $fileThumb=null;
        if($path==null)
        {
            $file=APP.WEBROOT_DIR.DS.'img'.DS.$imageDir.DS.$fileName;
            if($isThumb==true)
            $fileThumb=APP.WEBROOT_DIR.DS.'img'.DS.$imageDir.'_thumb'.DS.$fileName;
        }
        else
        {
            $file=$path.$fileName;
        }
        if(file_exists($file))
        {
            unlink($file);
        }
        if(file_exists($fileThumb) && $isThumb==true)
        {
            unlink($fileThumb);
        }
    }
    public function memberPlanContact($userId,$planId,$date)
    {
        $recordArr=array();
        $MembersContact=ClassRegistry::init('MembersContact');
        $Plan=ClassRegistry::init('Plan');
        $userContactArr=$MembersContact->findByMemberId($userId,array(),array('MembersContact.id'=>'desc'));
        $planArr=$Plan->findById($planId);
        $duration=$planArr['Plan']['duration'];
        if(!$userContactArr)
        {
            $totalContact=$planArr['Plan']['expiry'];
            if($totalContact==0){
                $totalContact=2147483647;
            }
            if($duration==0){
                $expiryDate=NULL;
            }
            else{
                $expiryDate=date('Y-m-d',strtotime($date."+$duration months"));
            }
            $recordArr=array('member_id'=>$userId,'plan_id'=>$planId,'total_contact'=>$totalContact,'expiry_date'=>$expiryDate);
        }
        else
        {            
            $userContactPlan=$MembersContact->findByMemberIdAndPlanId($userId,$planId,array(),array('MembersContact.id'=>'desc'));
            if(!$userContactPlan){
                $totalContact=$planArr['Plan']['expiry'];
                if($totalContact==0){
                    $totalContact=2147483647;
                }
                if($duration==0){
                    $expiryDate=NULL;
                }
                else{
                    $expiryDate=date('Y-m-d',strtotime($date."+$duration months"));
                }
                $recordArr=array('member_id'=>$userId,'plan_id'=>$planId,'total_contact'=>$totalContact,'expiry_date'=>$expiryDate);
            }
            else{
                if($duration==0){
                    $expiryDate=NULL;
                }
                else{
                    $expiryDate=date('Y-m-d',strtotime($userContactPlan['MembersContact']['expiry_date']."+$duration months"));
                }
                if($planArr['Plan']['expiry']==0){
                    $totalContact=2147483647;
                }
                else{
                    $totalContact=$planArr['Plan']['expiry']+$userContactArr['MembersContact']['total_contact'];    
                }
                $recordArr=array('id'=>$userContactArr['MembersContact']['id'],'member_id'=>$userId,'plan_id'=>$planId,'total_contact'=>$totalContact,'expiry_date'=>$expiryDate);
            }            
        }
        $MembersContact->save($recordArr);
        return $expiryDate;
    }
    public function favouriteMember($favUrl,$memberId,$status=null)
    {
        $Member=ClassRegistry::init('Member');
        $Favourite=ClassRegistry::init('Favourite');
        $post=$Member->findById($memberId);
        if(isset($_SESSION['Member']))
        {
           $fpost=$Favourite->findBymemberIdAndViewerId($memberId,$_SESSION['Member']['Member']['id']);
        }
        if($post)
        {
            if($status=="add")
            {
                if(!$fpost)
                {
                    if($this->Session->check('Member'))
                    {
                        $memberArr=$this->Session->read('Member');
                        $viewerId=$memberArr['Member']['id'];
                        $favArr=array('viewer_id'=>$viewerId,'member_id'=>$memberId);
                    }
                    $Favourite->save($favArr);
                    return '<span class="'.$memberId.'printajax"><button onclick="favouriteMember(\''.$favUrl.'\',\''.$memberId.'\',\'remove\');" class="vertical"><i class="fa fa-heart"></i>&nbsp;<span>'.__('Remove to favorites').'</span></button></span>';
                }
            }
            else
            {
                if($fpost)
                {
                    $id=$fpost['Favourite']['id'];
                    $Favourite->delete($id);
                    return '<span class="'.$memberId.'printajax"><button onclick="favouriteMember(\''.$favUrl.'\',\''.$memberId.'\',\'add\');" class="vertical"><i class="fa fa-heart-o"></i>&nbsp;<span>'.__('Add to favorites').'</span></button></span>';
                }
            }
        }
    }
     public function shortlistMember($favUrl,$memberId,$status=null)
    {
        $Member=ClassRegistry::init('Member');
        $Favourite=ClassRegistry::init('Shortlist');
        $post=$Member->findById($memberId);
        if(isset($_SESSION['Member']))
        {
           $fpost=$Favourite->findByMemberIdAndViewerId($memberId,$_SESSION['Member']['Member']['id']);
        }
        if($post)
        {
            if($status=="add")
            {
                if(!$fpost)
                {
                    if($this->Session->check('Member'))
                    {
                        $memberArr=$this->Session->read('Member');
                        $viewerId=$memberArr['Member']['id'];
                        $favArr=array('viewer_id'=>$viewerId,'member_id'=>$memberId);
                    }
                    $Favourite->save($favArr);
                    return '<span class="'.$memberId.'sprintajax"><button onclick="shortlistMember(\''.$favUrl.'\',\''.$memberId.'\',\'remove\');" class="vertical"><i class="fa fa-check-square"></i>&nbsp;<span>'.__('Remove to shortlist').'</span></button></span>';
                }
            }
            else
            {
                if($fpost)
                {
                    $id=$fpost['Shortlist']['id'];
                    $Favourite->delete($id);
                    return '<span class="'.$memberId.'sprintajax"><button onclick="shortlistMember(\''.$favUrl.'\',\''.$memberId.'\',\'add\');" class="vertical"><i class="fa fa-check-square-o"></i>&nbsp;<span>'.__('Add to shortlist').'</span></button></span>';
                }
            }
        }
    }
}