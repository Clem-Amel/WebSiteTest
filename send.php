<?php

// получим данные формы

$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['text'];

// обработка полученных данных


$name = htmlspecialchars($name); // преобразование символов сущности
$email = htmlspecialchars($email);
$text = htmlspecialchars($text);

$name = urldecode($name); // декодирование URL
$email = urldecode($email);
$text = urldecode($text);

$name = trim($name); // удаление пробельных символов с обеих строн
$email = trim($email);
$text = trim($text);

// отправка данных на почту

if(mail("clementine.amelina@gmail.com", 
    "Новое письмо с сайта", 
    "Имя: ".$name."\n".
    "Email: ". $email."\n".
    "Сообщение: ". $text.
    "From: no-reply@mydomain.ru \r\n")
    ) {
    echo ('Gut');
}
else {
    echo ('Bad');
}

?>