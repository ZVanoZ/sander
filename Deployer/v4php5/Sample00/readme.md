# Sample00

В этом эксперименте эмуляция деплоя на два сервера (test1, test2), которые идентифицированы как 127.0.0.1.

Во время деплоя выполняется два SSH подключения на 127.0.0.1 и производится деплой.
* testserver1.deploy_path - директроия для testserver1
* testserver2.deploy_path - директроия для testserver2

## Команды

``` sh
$dep list
$dep config:dump
$dep config:dump testserver1
$dep config:dump testserver2

dep deploy -vv
dep deploy testserver2 -vvv
dep rollback
dep rollback testserver1 
```
