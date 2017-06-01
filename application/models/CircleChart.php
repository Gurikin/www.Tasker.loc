<?php

class CircleChart {
    public $image;
    public $filename;
    
//    public function __construct($filename, $userEffectivity = array('Garry'=>10, 'Jinny'=>20, 'Ronald'=>5)) {
//        //image size
//        $width = 250;
//        $height = 250;
//        // создание изображения
//        $this->image = imagecreatetruecolor($width, $height);
//        // Включение сглаживания для одного из них
//        imageantialias($this->image, true);
//        //цвет фона
//        imagefilledrectangle($this->image,0,0,$width,$height,imagecolorallocate($this->image, 255, 255, 255));
//        // определение цветов
//        for ($i = 1; $i<500; $i++) {
//            $colors[$i] = imagecolorallocate($this->image, rand(0,255), rand(0,255), rand(0,255));
//        }
//        /*$colors = array('gray'=>imagecolorallocate($this->image, 0xC0, 0xC0, 0xC0),
//            'darkgray'=>imagecolorallocate($this->image, 0x90, 0x90, 0x90),
//            'navy'=>imagecolorallocate($this->image, 0x00, 0x00, 0x80),
//            'darknavy'=>imagecolorallocate($this->image, 0x00, 0x00, 0x50),
//            'red'=>imagecolorallocate($this->image, 0xFF, 0x00, 0x00),
//            'darkred'=>imagecolorallocate($this->image, 0x90, 0x00, 0x00));*/
//        
//
//        // делаем эффект 3Д
////        for ($i = 60; $i > 50; $i--) {
////           imagefilledarc($this->image, 50, $i, 100, 50, 0, 45, $darknavy, IMG_ARC_PIE);
////           imagefilledarc($this->image, 50, $i, 100, 50, 45, 75 , $darkgray, IMG_ARC_PIE);
////           imagefilledarc($this->image, 50, $i, 100, 50, 75, 360 , $darkred, IMG_ARC_PIE);
////        }
//        $startAngle = 0;
//        foreach ($userEffectivity as $taskCount) {
//            $percent = $taskCount/array_sum($userEffectivity);
//            $endAngle = $percent*360;
//            imagefilledarc($this->image, $width/2, $height/2, $width*0.8, $height*0.8, $startAngle, $endAngle, $colors[array_rand($colors)], IMG_ARC_PIE);
//            $startAngle = $endAngle;
//        }
//        $this->filename = $filename;
//        @ImagePNG($this->image, $this->filename); 
//        ImageDestroy($this->image);        
//    }
//    
//    public function outputImg($filename) {
//        printf("<img src='%s'> ", "/".$filename);
//    }
    public function __construct($userEffectivity = array('Garry'=>10, 'Jinny'=>20, 'Ronald'=>5)) {
        
    }
    
    public function outputImg() {
        
    }
    
}
