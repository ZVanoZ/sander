<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Тестируем сессию и куки</title>
    <style>
        table, td {
            border: 1px solid green;
        }
    </style>
</head>
<?php
session_start();
$timeLastRequest = $_COOKIE['timeLastRequest'];
setcookie( 'timeLastRequest', time()); // Эта кука для текущего URL (при использовании динамической ссылки забиваются куки в браузере)
setcookie( 'timeLastRequest', time(), 0, '/' ); // Эта кука для всего сайта
$timeThisRequest = $_COOKIE['timeLastRequest'];
if ( $_REQUEST['userLogin'] ) {
    $_SESSION['user'] = array(
        'login' => $_REQUEST['userLogin'],
        'password' => $_REQUEST['userPassw']
    );
}
?>
<body>
<form method="post">
    <br><label>Логин:</label>
    <br><input name="userLogin" value="<?= "" ?>"/>
    <br><label>Пароль:</label>
    <br><input name="userPassw" value="<?= "" ?>"/>
    <br><input type="submit"/>
</form>
<br><a href="<?= $_SERVER['REQUEST_URI'] ?>">Перейти на эту же страницу (без повторной отправки параметров)</a>
<br><a href="<?= $_SERVER['REQUEST_URI'] . '/' . $timeThisRequest ?>">Перейти на эту же страницу (без повторной
    отправки параметров) + генерация рандомного субпути</a>
<table>
    <tr>
        <th>Ключ</th>
        <th>Значение</th>
    </tr>
    <tr>
        <td>session_id()</td>
        <td><?= session_id(); ?></td>
    </tr>
    <tr>
        <td>session_get_cookie_params()</td>
        <td><?= print_r( session_get_cookie_params(), true ); ?></td>
    </tr>
    <tr>
        <td>$_SESSION</td>
        <td><?= print_r( $_SESSION, true ); ?></td>
    </tr>
    <tr>
        <td>$_COOKIE</td>
        <td><?= print_r( $_COOKIE, true ); ?></td>
    </tr>
</table>
</body>
