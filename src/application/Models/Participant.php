<?

namespace App\Models;
use App\Core\Validator;
use App\Core\Database;
use App\Core\Model;

class Participant extends Model
{
    protected static $table = 'participant';

    public function __construct()
    {
        parent::__construct();   
    }    
    
    public static function isEmailExists($errors, $email)
    {
        if (count($errors) === 0) {
            $where = "email = '$email'"; //TODO: перенести в модель check if email exists
            $tmp = Database::select(self::$table,  ['id'] , $where);
        }
        return $tmp;
    }
    
    public static function isValidRegistrationData($data)
    {
        $errors =  [];

        if (!Validator::validateLength($data['firstname'])) {
            $errors['firstname'] = "Firstname must not be shorter 2 and longer 255 symbol";
        }

        if (!Validator::validateName($data['firstname'])) {
            $errors['firstname'] = "Firstname can only contain A-Z and a-z";
        }

        if (!Validator::isRequired($data['firstname'])) {
            $errors['firstname'] = "Firstname can't be blank";
        }

        if (!Validator::validateLength($data['lastname'])) {
            $errors['lastname'] = "Lastname must not be shorter 2 and longer 255 symbol";
        }

        if (!Validator::validateName($data['lastname'])) {
            $errors['lastname'] = "Lastname can only contain A-Z and a-z";
        }

        if (!Validator::isRequired($data['lastname'])) {
            $errors['lastname'] = "Lastname can't be blank";
        }

        if (!Validator::validateDate($data['birthdate'])) {
            $errors['birthdate'] = "Invalid birthdate";
        }

        if (!Validator::isRequired($data['birthdate'])) {
            $errors['birthdate'] = "Birthdate can't be blank";
        }

        if (!Validator::validateLength($data['reportsubject'])) {
            $errors['reportsubject'] = "The subject of report must not be shorter 2 and longer 255 symbol";
        }

        if (!Validator::isRequired($data['reportsubject'])) {
            $errors['reportsubject'] = "The subject of report can't be blank";
        }

        if (!Validator::isRequired($data['country'])) {
            $errors['country'] = "Country can't be blank";
        }

        if (!Validator::validatePhone($data['phone'])) {
            $errors['phone'] = "Phone is not a valid format phone";
        }

        if (!Validator::isRequired($data['phone'])) {
            $errors['phone'] = "Phone can't be blank";
        }

        if (!Validator::validateEmail($data['email'])) {
            $errors['email'] = "Email is not a valid email";
        }

        if (!Validator::isRequired($data['email'])) {
            $errors['email'] = "Email can't be blank";
        }

        return $errors;
    }


    public static function isValidFileType($fileType)
    {  
        $types  = ['image/gif', 'image/png', 'image/jpeg'];        
        return (!in_array($fileType, $types));        
    }

    public static function isValidFileSize($fileSize)
    {  
        $size = 1024000;        
        return ($fileSize > $size);        
    }
    
    public static function cropFile($path, $file)
    { 
        $max_size = 256;
        $quality = 75;

        if ($file['photo']['type'] == 'image/jpeg')
        $source = imagecreatefromjpeg($file['photo']['tmp_name']);
        elseif ($file['photo']['type'] == 'image/png')
        $source = imagecreatefrompng($file['photo']['tmp_name']);
        elseif ($file['photo']['type'] == 'image/gif')
        $source = imagecreatefromgif($file['photo']['tmp_name']);
        else
        return false;

        $w_src = imagesx($source);
        $h_src = imagesy($source);

        if ($w_src > $max_size) {

            $ratio = $w_src/$max_size;
            $w_dest = round($w_src/$ratio);
            $h_dest = round($h_src/$ratio);
            $dest = imagecreatetruecolor($w_dest, $h_dest);
            imagecopyresampled($dest, $source, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);            
            imagejpeg($dest, $path, $quality);
            imagedestroy($dest);
            imagedestroy($source);

            } else {
                imagejpeg($source, $path, $quality);
                imagedestroy($source);
            }

         return true;
    }    

}



