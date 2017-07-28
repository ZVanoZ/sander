# Sample01


Добавляем в Sample00 предварительную обработку файлов.
  
Попытаемся реорганизовать структуру папок.

## Команды

``` sh
$dep list
$dep config:dump
$dep config:dump testserver1
$dep config:dump testserver2

$dep deploy
$dep deploy testserver1
$dep deploy testserver2 -vv
$dep deploy testserver2 -vvv
dep deploy teststage

$dep rollback
$dep rollback testserver1
$dep rollback testserver2
```
