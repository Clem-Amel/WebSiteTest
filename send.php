<?php

// ������� ������ �����

$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['text'];

// ��������� ���������� ������


$name = htmlspecialchars($name); // �������������� �������� ��������
$email = htmlspecialchars($email);
$text = htmlspecialchars($text);

$name = urldecode($name); // ������������� URL
$email = urldecode($email);
$text = urldecode($text);

$name = trim($name); // �������� ���������� �������� � ����� �����
$email = trim($email);
$text = trim($text);

// �������� ������ �� �����

if(mail("clementine.amelina@gmail.com", 
    "����� ������ � �����", 
    "���: ".$name."\n".
    "Email: ". $email."\n".
    "���������: ". $text.
    "From: no-reply@mydomain.ru \r\n")
    ) {
    echo ('Gut');
}
else {
    echo ('Bad');
}

?>