<?php
require 'ClassAutoLoad.php';

$mailCnt = [
    'name_from' => 'sender name',
    'mail_from' => 'sender@yahoo.com',
    'name_to' => 'receiver name',
    'mail_to' => 'recipient@gmail.com',
    'subject' => 'Hello From Alex',
    'body' => 'Welcome to Alex testing mail! <br> This is a test mail. '
];

// $ObjSendMail->Send_Mail($conf, $mailCnt);


print rand(100000, 999999);