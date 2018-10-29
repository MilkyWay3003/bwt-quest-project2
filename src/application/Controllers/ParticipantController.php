<?

namespace App\Controllers;
use App\Models\Participant;
use App\Core\Database;
use App\Core\Controller;


class ParticipantController extends Controller
{
    protected $table = 'participant';

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
    }

    public function actionIndex()
    {
        $data = [];
        if (is_array($_SESSION) && array_key_exists('errors', $_SESSION)) {
            $data['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        $data['page_url'] = htmlspecialchars("//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}", ENT_QUOTES, 'UTF-8');

        $this->view->generate('template', 'participant', $data);
    }

    public function actionUserRegistrationSubmit()
    {
        $userRegistrationData = [
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'birthdate' => $_POST['birthdate'],
            'reportsubject' => $_POST['reportsubject'],
            'country' => $_POST['country'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email']
        ];       

        $errors = Participant::isValidRegistrationData($userRegistrationData);

        $email = $userRegistrationData['email'];
        $tmp = Participant::isEmailExists($errors,$email);
        if ($tmp) {
            $errors [] = "This email is already in use";
        }

        $userRegistrationData['birthdate'] = implode('-', array_reverse(explode('/', $_POST['birthdate'])));

        if (count($errors) === 0) {            
            $result = $this->db->insert($this->table, $userRegistrationData);
            $where = "email = '$email'"; // remember id user
            $userId = $this->db->select($this->table, ['id'], $where);
            $id = $userId[0]['id'];
            echo json_encode([
                'status' => $result ? 'ok' : 'error',
                'id' => $id,
                'userRegistrationData' => $userRegistrationData
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'errors' => $errors
            ]);
        }
    }


    public function actionUserAdditionalInfo()
    {
        $errors =  [];    

        if(!empty($_FILES['photo'])) {        
        
        $type = Participant::isValidFileType($_FILES['photo']['type']);
        if ($type) {
            $errors [] = "Invalid type of file";
        }

        $size = Participant::isValidFileSize($_FILES['photo']['size']);
        if ($size) {
            $errors [] = "Size of file is big";
        }

        $tmp_path = $_SERVER['DOCUMENT_ROOT'] . "/uploads/pic/";        
        $tmp_path = $tmp_path . $_FILES['photo']['name'];      
        Participant::cropFile($tmp_path, $_FILES);

        $path = "/uploads/pic/" . $_FILES['photo']['name']; 

        } else {
            $path = "/uploads/pic/default.jpg";
        } 

        $userAdditionalInfo = [
                'company' => $_POST['company'],
                'position'=> $_POST['position'],
                'aboutme'=> $_POST['aboutme'],
                'photo' => $path
            ];

        $id = $_POST['id'];
        $id = "id = '$id'";

        if (count($errors) === 0) {
            $result =$this->db->update($this->table, $userAdditionalInfo, $id);
            echo json_encode([
                'status' => $result ? 'ok' : 'error',
                'userAdditionalInfo' => $userAdditionalInfo
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'errors' => $errors
            ]);
        }
    }

    public function actionAllMembers()
    {
        $data = ['photo', 'firstname', 'lastname', 'reportsubject', 'email'];
        $membersList = $this->db->select($this->table, $data);
        $this->view->generate('template', 'allmembers', [
            'members' => $membersList,
        ]);
    }

}
