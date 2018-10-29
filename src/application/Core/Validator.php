<?

namespace App\Core;
use DateTime;

class Validator
{
    const LENGTHMIN = 2;
    const LENGTHMAX = 255;

    public static function validateDate($date, $format = 'd/m/Y')
    {
        $dateDecoded = urldecode($date);
        $d = DateTime::createFromFormat($format, $dateDecoded);
        return $d && $d->format($format) == $dateDecoded;
    }    

    public static function validatePhone($phone)
    {
        $phoneDecoded = urldecode($phone);       
        $pattern = "#^[+]*[0-9 ]{1,4}[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$#";
        return preg_match($pattern, $phoneDecoded);
    }

    public static function validateEmail($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    public  static function validateLength($data)
    {
        return (strlen($data) >= self::LENGTHMIN and strlen($data) <= self::LENGTHMAX);
    }

    public static function isRequired($data)
    {
        return (isset($data) and !empty($data));
    }

    public static function validateName($date)
    {
        $pattern = '/^[a-zA-Z0-9]*$/';
        return preg_match($pattern, $date);
    } 
 

}