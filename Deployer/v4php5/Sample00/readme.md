# Sample00

В этом эксперименте эмуляция деплоя на два сервера (test1, test2), которые идентифицированы как 127.0.0.1.

Во время деплоя выполняется два SSH подключения на 127.0.0.1 и производится деплой.
* test1.deploy_path - директроия для test1
* test2.deploy_path - директроия для test2

## Команды

``` sh
dep deploy
dep rollback
dep deploy test2
dep rollback test1
```
