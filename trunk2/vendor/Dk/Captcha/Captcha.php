<?php

namespace Dk\Captcha;

class Captcha {

	static $imageH;
	static $imageW;
	static $image;
	static $fontSize = 20;
	static $textColor;
	static $codeSet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

	public static function randTextEN($length = "32") {
		$result = "";
		for ($i = 0; $i < $length; $i++) {
			$num[$i] = rand(0, 61);
			$result .= $self::$codeSet[$num[$i]];
		}
		return $result;
	}

	public static function randTextCN($length = "5") {
		$string = '';
		for ($i = 0; $i < $length; $i++) {
			$string .= chr(rand(0xB0, 0xD7)) . chr(rand(0xA1, 0xFE));
		}
		return $string;
	}

	public static function getImage($text, $im_x = 230, $im_y = 32) {
		self::$imageH = $im_y;
		self::$imageW = $im_x;
		$im = imagecreatetruecolor($im_x, $im_y);
		$text_c = ImageColorAllocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
		$tmpC0 = mt_rand(210, 255);
		$tmpC1 = mt_rand(210, 255);
		$tmpC2 = mt_rand(210, 255);
		$buttum_c = ImageColorAllocate($im, $tmpC0, $tmpC1, $tmpC2);
		imagefill($im, 16, 13, $buttum_c);
		//echo $text;
		$font = 'c://WINDOWS//Fonts//msyh.ttf';
		//echo strlen($text);

		$text = iconv("gb2312", "UTF-8", $text);
		//echo mb_strlen($text,"UTF-8");
		for ($i = 0; $i < mb_strlen($text); $i++) {
			$tmp = mb_substr($text, $i, 1, "UTF-8");
			$array = array(-1, 0, 1);
			$p = array_rand($array);
			//角度
			$an = $array[$p] * mt_rand(-20, 20);
			//文字大小
			$size = 20;
			$textY = intval($im_y / 2 + $size / 2);
			imagettftext($im, self::$fontSize, $an, 10 + $i * self::$fontSize * 2, $textY, $text_c, $font, $tmp);
		}

		$distortion_im = imagecreatetruecolor($im_x, $im_y);
		imagefill($distortion_im, 16, 13, $buttum_c);
		for ($i = 0; $i < $im_x; $i++) {
			for ($j = 0; $j < $im_y; $j++) {
				$rgb = imagecolorat($im, $i, $j);
				if ((int)($i + 20 + sin($j / $im_y * 2 * M_PI) * 10) <= imagesx($distortion_im) && (int)($i + 20 + sin($j / $im_y * 2 * M_PI) * 10) >= 0) {
					imagesetpixel($distortion_im, (int)($i + 10 + sin($j / $im_y * 2 * M_PI - M_PI * 0.5) * 3), $j, $rgb);
				}
			}
		}
		self::$image = $distortion_im;
		self::writeCurve();
		self::writeNoise($distortion_im, $im_x, $im_y, $text_c);
		

		Header("Content-type: image/PNG");

		//以PNG格式将图像输出到浏览器或文件;
		//ImagePNG($im);
		ImagePNG($distortion_im);

		//销毁一图像,释放与image关联的内存;
		ImageDestroy($distortion_im);
		ImageDestroy($im);
	}

	static function writeCurve() {
		for($i = 0; $i < 10; $i++){   
            //杂点颜色   
            $noiseColor = imagecolorallocate(   
                              self::$image,    
                              mt_rand(150,225),    
                              mt_rand(150,225),    
                              mt_rand(150,225)   
                          );   
            for($j = 0; $j < 5; $j++) {   
                // 绘杂点   
                imagestring(   
                    self::$image,   
                    5,    
                    mt_rand(-10, self::$imageW),    
                    mt_rand(-10, self::$imageH),    
                    self::$codeSet[mt_rand(0, 28)], // 杂点文本为随机的字母或数字   
                    $noiseColor  
                );   
            }   
        }
	}

	static function writeNoise($distortion_im, $im_x, $im_y, $text_c) {
		$A = mt_rand(1, self::$imageH / 2);
		// 振幅
		$b = mt_rand(-self::$imageH / 4, self::$imageH / 4);
		// Y轴方向偏移量
		$f = mt_rand(-self::$imageH / 4, self::$imageH / 4);
		// X轴方向偏移量
		$T = mt_rand(self::$imageH * 1.5, self::$imageW * 2);
		// 周期
		$w = (2 * M_PI) / $T;

		$px1 = 0;
		// 曲线横坐标起始位置
		$px2 = mt_rand(self::$imageW / 2, self::$imageW * 0.667);
		// 曲线横坐标结束位置
		for ($px = $px1; $px <= $px2; $px = $px + 0.9) {
			if ($w != 0) {
				$py = $A * sin($w * $px + $f) + $b + self::$imageH / 2;
				// y = Asin(ωx+φ) + b
				$i = (int)((self::$fontSize - 6) / 4);
				while ($i > 0) {
					imagesetpixel(self::$image, $px + $i, $py + $i, $text_c);
					//这里画像素点比imagettftext和imagestring性能要好很多
					$i--;
				}
			}
		}

		$A = mt_rand(1, self::$imageH / 2);
		// 振幅
		$f = mt_rand(-self::$imageH / 4, self::$imageH / 4);
		// X轴方向偏移量
		$T = mt_rand(self::$imageH * 1.5, self::$imageW * 2);
		// 周期
		$w = (2 * M_PI) / $T;
		$b = $py - $A * sin($w * $px + $f) - self::$imageH / 2;
		$px1 = $px2;
		$px2 = self::$imageW;
		for ($px = $px1; $px <= $px2; $px = $px + 0.9) {
			if ($w != 0) {
				$py = $A * sin($w * $px + $f) + $b + self::$imageH / 2;
				// y = Asin(ωx+φ) + b
				$i = (int)((self::$fontSize - 8) / 4);
				while ($i > 0) {
					imagesetpixel(self::$image, $px + $i, $py + $i, $text_c);
					//这里(while)循环画像素点比imagettftext和imagestring用字体大小一次画出
					//的（不用while循环）性能要好很多
					$i--;
				}
			}
		}
	}

}