<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><? __FILE__ ?></title>
</head>
<body>
<?
$result = '';
$isError = false;
$isFound = false;
try {
    $template = $_REQUEST['fieldTemplate'];
    $data = $_REQUEST['fieldData'];
    $isFound = preg_match($template, $data, $matches);
    $result = print_r($matches, true);
} catch (Exception $e) {
    $result = print_r($e, true);
    $isError = true;
}
?>

<form method="post">
    <br><label>Шаблон:</label>
    <br><textarea name="fieldTemplate" cols="120" rows="3"><?=$template?></textarea>
    <br><label>Данные:</label>
    <br><textarea name="fieldData" cols="120" rows="5"><?=$data?></textarea>
    <br><label>Результат:</label>
    <br><textarea  cols="120" rows="10"><?=$result?></textarea>
    <br><label>TEMP:</label>
    <br><textarea name="fieldTemp" cols="120" rows="3"><?=$_REQUEST['fieldTemp']?></textarea>
    <br><input type="submit"/>
</form>
<div style="border: 1px solid red">
    <p style="border: 1px solid blue"><?=($isError ? 'Ошибка': 'Выполнено корректно') .'/'.($isFound ? 'Найдено' : 'Не найдено')?>
    <p style="border: 1px solid blue"><?=$template?>
    <p style="border: 1px solid blue"><?=$data?>
    <p style="border: 1px solid blue"><?=$result?>
</div>
</body>
