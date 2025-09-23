<?php
class auth {

    // Replace placeholders {{var}} in templates
    public function bindEmailTemplate($template, $variables) {
        foreach ($variables as $key => $value) {
            $template = str_replace("{{" . $key . "}}", $value, $template);
        }
        return $template;
    }

    public function signup($conf, $ObjFncs, $lang, $ObjSendMail) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {

            $errors = [];

            $fullname = $_SESSION['fullname'] = ucwords(strtolower(trim($_POST['fullname'])));
            $email    = $_SESSION['email']    = strtolower(trim($_POST['email']));
            $password = $_SESSION['password'] = $_POST['password'];

            // Validate fullname
            if (empty($fullname) || !preg_match("/^[a-zA-Z ]*$/", $fullname)) {
                $errors['fullname_error'] = "Only letters and spaces allowed in fullname.";
            }

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['mailFormat_error'] = "Invalid email format.";
            }

            // Validate email domain
            $email_domain = substr(strrchr($email, "@"), 1);
            if (!in_array($email_domain, $conf['valid_email_domain'])) {
                $errors['mailDomain_error'] = "Email domain must be one of: " . implode(", ", $conf['valid_email_domain']);
            }

            // Validate password length
            if (strlen($password) < $conf['min_password_length']) {
                $errors['password_error'] = "Password must be at least {$conf['min_password_length']} characters.";
            }

            // If no errors, proceed
            if (!count($errors)) {
                $email_variables = [
                    'site_name'       => $conf['site_name'],
                    'fullname'        => $fullname,
                    'activation_code' => $conf['reg_ver_code']
                ];

                $mailCnt = [
                    'name_from' => $conf['site_name'],
                    'mail_from' => $conf['admin_email'],
                    'name_to'   => $fullname,
                    'mail_to'   => $email,
                    'subject'   => $this->bindEmailTemplate($lang["ver_reg_subj"], $email_variables),
                    'body'      => nl2br($this->bindEmailTemplate($lang["ver_reg_body"], $email_variables))
                ];

                $result = $ObjSendMail->sendMail($conf, $mailCnt);

                if ($result === true) {
                    $ObjFncs->setMsg('msg', 'Signup successful! Please check your email for activation instructions.', 'success');

                    // Clear session data
                    unset($_SESSION['fullname'], $_SESSION['email'], $_SESSION['password']);
                } else {
                    $ObjFncs->setMsg('msg', "Signup succeeded, but email could not be sent. Error: $result", 'danger');
                }

            } else {
                $ObjFncs->setMsg('errors', $errors, 'danger');
                $ObjFncs->setMsg('msg', 'Please fix the errors and try again.', 'danger');
            }
        }
    }
}
