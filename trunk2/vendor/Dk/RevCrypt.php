<?php
namespace Dk;

//可逆加密函数  UTF-8编码
class RevCrypt {
    //密锁串，不能出现重复字符，内有A-Z,a-z,0-9,/,=,+,_,-
    static $lockstream = 'st=lDEFAVWXYZPyzghi_jQRST-Uwxkabcdef+IJK6/7nopBCNOqr89LMGmH012345uv';
    //加密
    public static function encode($txtStream,$key){
        //随机找一个数字，并从密锁串中找到一个密锁值
        $lockLen = strlen(self::$lockstream);
        $lockCount = rand(0,$lockLen-1);
        $randomLock = self::$lockstream[$lockCount];
        //结合随机密锁值生成MD5后的密码
        $key = md5($key.$randomLock);
        //开始对字符串加密
        $txtStream = base64_encode($txtStream);
        $tmpStream = '';
        $i=0;$j=0;$k = 0;
        for ($i=0; $i<strlen($txtStream); $i++) {
            $k = $k == strlen($key) ? 0 : $k;
            $j = (strpos(self::$lockstream,$txtStream[$i])+$lockCount+ord($key[$k]))%($lockLen);
            $tmpStream .= self::$lockstream[$j];
            $k++;
        }
        return $tmpStream.$randomLock;
    }
    public static function decode($txtStream,$key){
        $lockLen = strlen(self::$lockstream);
        //获得字符串长度
        $txtLen = strlen($txtStream);
        //截取随机密锁值
        $randomLock = $txtStream[$txtLen - 1];
        //获得随机密码值的位置
        $lockCount = strpos(self::$lockstream,$randomLock);
        //结合随机密锁值生成MD5后的密码
        $key = md5($key.$randomLock);
        //开始对字符串解密
        $txtStream = substr($txtStream,0,$txtLen-1);
        $tmpStream = '';
        $i=0;$j=0;$k = 0;
        for ($i=0; $i<strlen($txtStream); $i++) {
            $k = $k == strlen($key) ? 0 : $k;
            $j = strpos(self::$lockstream,$txtStream[$i]) - $lockCount - ord($key[$k]);
            while($j < 0){
                $j = $j + ($lockLen);
            }
            $tmpStream .= self::$lockstream[$j];
            $k++;
        }
        return base64_decode($tmpStream);
    }
}
