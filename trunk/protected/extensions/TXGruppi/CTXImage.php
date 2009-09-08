<?php
class CTXImage {
    protected $path = ".";

    public $gd = null;

    protected $image = array();

    public function  __construct($path = null) {
        $path = preg_replace("'\/+$'","",$path);
        if (!is_dir($path) || !is_writable($path)) $path = null;
        $this->path = $path;
    }

    public function loadImage($imagePath) {
        if (!file_exists($imagePath)) return false;
        if (!is_readable($imagePath)) return false;

        $imageData = getimagesize($imagePath);
        switch ($imageData[2]) {
            case 1:
                $gd = imagecreatefromgif($imagePath);
                break;

            case 2:
                $gd = imagecreatefromjpeg($imagePath);
                break;

            case 3:
                $gd = imagecreatefrompng($imagePath);
                break;

            case 15:
                $gd = imagecreatefromwbmp($imagePath);
                break;

            default:
                $gd = imagecreatefromstring(file_get_contents($imagePath));
        }

        if (empty($gd)) return false;

        $this->gd = $gd;

        $this->image = array(
            'path'=>$imagePath,
            'width'=>$imageData[0],
            'height'=>$imageData[1],
            'type'=>$imageData[2]
        );
        return true;
    }

    public function resize($options) {
        if (empty($options)) return false;
        if (empty($this->gd)) return false;
        if (empty($this->image)) return false;

        $options = array_merge(array(
            'width'=>$this->image['width'],
            'height'=>$this->image['height'],
            'force'=>'none'
            ),$options);

        if ($options['force'] == 'none') $options['force'] = 'bigger';

        if ($this->image['width'] == $options['width'] && $this->image['height'] == $options['height']) return true;
        if (($this->image['width'] < $options['width'] || $this->image['height'] < $options['height']) && ($options['force'] != 'fixed' && $options['force'] != 'frame')) return true;
        if ($options['width'] <= 0 || $options['height'] <= 0) return true;

        if ($options['force'] == 'width') {
            $newWidth = $options['width'];
        } elseif ($options['force'] == 'height') {
            $newHeight = $options['height'];
        } elseif ($options['force'] == 'fixed') {
            $newWidth = $options['width'];
            $newHeight = $options['height'];
        } elseif ($options['force'] == 'frame') {
            $bOption = $options['width'] > $options['height'] ? $options['width'] : $options['height'];
            //$sOption = $options['width'] < $options['height'] ? $options['width'] : $options['height'];
            if ($this->image['width'] > $this->image['height']) {
                $newHeight = $bOption;
                $newWidth = $this->percentage($newHeight, $this->image['height'], $this->image['width']);
            } elseif ($this->image['width'] < $this->image['height']) {
                $newWidth = $bOption;
                $newHeight = $this->percentage($newWidth, $this->image['width'], $this->image['height']);
            } else {
                $newWidth = $newHeight = $bOption;
            }

            if ($newWidth < $options['width']) {
                $newWidth = $options['width'];
                unset($newHeight);
            } elseif ($newHeight < $options['height']) {
                $newHeight = $options['width'];
                unset($newWidth);
            }
        } elseif ($options['force'] == 'bigger') {
            if ($this->image['width'] > $this->image['height']) {
                $newWidth = $options['width'];
            } elseif ($this->image['width'] < $this->image['height']) {
                $newHeight = $options['height'];
            } else {
                $newWidth = $newHeight = $options['width'] > $options['height'] ? $options['width'] : $options['height'];
            }
        } elseif ($options['force'] == 'smaller') {
            if ($this->image['width'] < $this->image['height']) {
                $newWidth = $options['width'];
            } elseif ($this->image['width'] > $this->image['height']) {
                $newHeight = $options['height'];
            } else {
                $newWidth = $newHeight = $options['width'] < $options['height'] ? $options['width'] : $options['height'];
            }
        }

        if (!isset($newWidth)) $newWidth = $this->percentage($newHeight, $this->image['height'], $this->image['width']);
        if (!isset($newHeight)) $newHeight = $this->percentage($newWidth, $this->image['width'], $this->image['height']);

        if ($options['force'] == 'frame') {
            $desX = $options['width'] < $newWidth ? -($newWidth-$options['width'])/2 : 0;
            $desY = $options['height'] < $newHeight ? -($newHeight-$options['height'])/2 : 0;
        } else {
            $desX = $desY = 0;
        }

        if (in_array($options['force'],array('frame'))) {
            $newImage = imagecreatetruecolor($options['width'],$options['height']);
        } else {
            $newImage = imagecreatetruecolor($newWidth, $newHeight);
        }
        $op = imagecopyresampled($newImage,$this->gd,$desX,$desY,0,0,$newWidth,$newHeight,$this->image['width'],$this->image['height']);
        if ($op) {
            imagedestroy($this->gd);
            $this->gd = $newImage;

            $this->image['width'] = $options['width'];
            $this->image['height'] = $options['height'];
        }
        return $op;
    }

    public function join(CTXImage $image,$alignH = 'R',$alignV = 'B') {
        $mWidth = imagesx($image->gd);
        $mHeight = imagesy($image->gd);
        $width = imagesx($this->gd);
        $height = imagesy($this->gd);

        if (empty($mWidth) || empty($mHeight) || empty($width)|| empty($height)) return false;

        $alignH = strtoupper($alignH);
        $alignV = strtoupper($alignV);

        if ($alignH == 'L') {
            $x = 0;
        } elseif ($alignH == 'C' || $alignH == 'M') {
            $x = $width/2-$mWidth/2;
        } else {
            $x = $width-$mWidth;
        }

        if ($alignV == 'T') {
            $y = 0;
        } elseif ($alignV == 'C' || $alignV == 'M') {
            $y = $height/2-$mHeight/2;
        } else {
            $y = $height-$mHeight;
        }

        if (!imagecopy($this->gd, $image->gd, $x, $y, 0, 0, $mWidth, $mHeight)) return false;
        return true;
    }

    public function display() {
        if (!headers_sent()) header("Content-Type: image/png");
        imagepng($this->gd);
    }

    public function save($name = null) {
        if (empty($name)) $name = $this->randomName();
        if (!preg_match("'^\/'",$name)) $name = "/$name";

        switch ($this->image['type']) {
            case 1:
                $name .= ".gif";
                $op = imagegif($this->gd,$this->path.$name);
                break;

            case 2:
                $name .= ".jpg";
                $op = imagejpeg($this->gd,$this->path.$name);
                break;

            case 3:
                $name .= ".png";
                $op = imagepng($this->gd,$this->path.$name);
                break;

            default:
                $name .= ".jpg";
                $op = imagejpeg($this->gd,$this->path.$name);
        }

        return $op ? substr($name,1) : false;
    }

    protected function randomName() {
        return md5(microtime());
    }

    protected function percentage($value1,$value2,$value3) {
        return $value3*($value1*100/$value2)/100;
    }

    public static function getPost($formName) {
        if (!isset($_FILES[$formName])) return array();
        if (is_array($_FILES[$formName]['name'])) {
            $files = array();
            foreach ($_FILES[$formName]['name'] as $k=>$name) {
                $type = $_FILES[$formName]['type'][$k];
                $tmpName = $_FILES[$formName]['tmp_name'][$k];
                $error = $_FILES[$formName]['error'][$k];
                $size = $_FILES[$formName]['size'][$k];
                $files[] = array('name'=>$name,'type'=>$type,'tmp_name'=>$tmpName,'error'=>$error,'size'=>$size);
            }
            return $files;
        } else {
            return $_FILES[$name];
        }
    }
}