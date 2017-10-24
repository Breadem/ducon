<?php
/**
 * Created by PhpStorm.
 * User: leeeeee
 * Date: 2017/10/23
 * Time: 9:15
 */

class MailValid
{
    //判断是否是正确的邮箱格式;
    public static function isEmail($email){
        $mode = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
        if(preg_match($mode,$email)){
            return true;
        }
        else{
            return false;
        }
    }
}