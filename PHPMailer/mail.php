<? require_once($_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/SMTP.php');

class mail extends PHPMailer
{
    public function __construct()
    {
        $this->isSMTP();
        $this->isHTML(true);
        $this->CharSet = 'UTF-8';
        $this->Host = 'ssl://smtp.mail.ru';
        $this->SMTPSecure = 'SSL';
        $this->Port = 465;
        $this->SMTPAuth = true;
        $this->Username = 'lintes@list.ru'; // логин 
        $this->Password = 'toropchin_artem25';
        $this->setFrom('lintes@list.ru', 'apelsinka'); // почта и имя отправителя (эта информация будет приходить получателю. Почту я всегда указываю реальную.)
    }
}
?>