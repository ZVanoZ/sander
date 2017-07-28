<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>BASE-64 Encode/Decode</title>
</head>
<body>
<form method="post">
    <br><label>Данные в текстовом виде (fieldText):</label>
    <br><textarea name="fieldText" cols="120" rows="5"><?=$_REQUEST['fieldText']?></textarea>
    <br><label>Данные в формате BASE64 (fieldBase64):</label>
    <br><textarea name="fieldBase64" cols="120" rows="5"><?=$_REQUEST['fieldBase64']?></textarea>
    <br><input type="submit"/>
</form>
<?
$base64value = base64_encode($_REQUEST['fieldText']);
$origValue = base64_decode($_REQUEST['fieldBase64']);
echo '<br><br><b>' . 'fieldText в base64(' . strlen($base64value) . '):' . '</b><br>' . $base64value;
echo '<br><br><b>' . 'fieldBase64 в текст(' . strlen($origValue) . '):' . '</b><br>' . $origValue;
echo '<br><br><b>' . '$_REQUEST:' . '</b><br>' . print_r($_REQUEST, true);
?>
</body>