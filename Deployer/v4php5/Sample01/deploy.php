<?php

namespace Deployer;

use Deployer\Exception\Exception;

require 'recipe/common.php';
// Configuration
set('ssh_type', 'native');
set('ssh_multiplexing', true);
//set('repository', 'https://github.com/ZVanoZ/sander.git');
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);
add('copy_dirs', []);
serverList('servers.yml');
set('build_path', __DIR__ . '/.build');
set('build_current_path', get('build_path') . '/current');
/**
 * Хардкодная установка параметров в runtime.
 * Должно быть в 'servers.yml'
 */
task('set_env', function () {
    $serverName = get('server')['name'];
    if ($serverName === 'buildserver') {
        set('deploy_path', get('build_path'));
    } else {
        set('deploy_path', __DIR__ . "/{$serverName}.deploy_path");
    }
    writeln("serverName={$serverName}");
    writeln("deploy_path=" . get('deploy_path'));
    writeln("build_path=" . get('build_path'));
    writeln("build_current_path=" . get('build_current_path'));
})->desc('Установка переменных окружения в зависимости от текущего сервера');
/**
 * В этом таске мы обрабатываем файлы, загруженные из репозитария.
 * Выполняется он на локальной машине. Для удаленного билд-сервера нужно адаптировать скрипт деплоя.
 */
task('build:prepare_code', function () {
    $workDir = get('build_path') . '/release';
    $tempDir = $workDir . '/build_tmp_' . time();
    writeln("tempDir=$tempDir");
    if (!runLocally("mkdir $tempDir")) {
        throw new Exception('Не удалось создать временную директорию.');
    }
    //  Загоняем все файлы релиза во временную директорию
    $files = scandir($workDir);
    foreach ($files as $fileName) {
        if ($fileName === '.' || $fileName === '..' || "$workDir/$fileName" === $tempDir) {
            continue;
        }
        runLocally("mv {$workDir}/$fileName {$tempDir}/$fileName");
    }
    // Вытягиваем из временной директории в релиз нужные файлы
    $files = scandir($tempDir . '/PHP/siteSinglePage/');
    foreach ($files as $fileName) {
        if ($fileName === '.' || $fileName === '..') {
            continue;
        }
        runLocally("mv {$tempDir}/PHP/siteSinglePage/$fileName {$workDir}/$fileName");
    }
    // Удаляем временную папку вместе с тем, что осталось.
    runLocally("rm -dr $tempDir");
})->desc('buildserver/Обработка кода');
/**
 * Выполняет сборку проекта в папке .build
 * При сборке деплой не производится.
 * Идеология - "Собрали билд, затем отдеплоили по серверам".
 */
task('build', [
    'set_env',
    'deploy:prepare', // Создать служебные папки в  .build
    'deploy:release', // Подготовить релизную папку в .build
    'deploy:update_code', // Загрузить код из репозитария GIT в релизную папку .build
    //'deploy:vendors', // Не используем. Загрузить зависимости через composer.
    'build:prepare_code', // Обработать файлы в релизной папке .build
    'deploy:symlink' // Перебросить симлинк текущей папки на релизнкю в .build
])
    // ->onlyOn('buildserver')//
    //->onlyForStage('buildstage')
    ->desc('buildserver/Сборка проекта');
task('upload', function () {
    upload(get('build_current_path'), '{{release_path}}');
})->desc('Выгружает текущий релиз с buildserver на текущий сервер.');
/**
 * Деплой релиза на удаленнй сервер.
 */
task('release', [
    'set_env', // На текущем компьютере/Установить параметры работы.
    'deploy:prepare', // На удаленном сервере/Создать служебные папки, если их нет (.dep, releases, shared).
    'deploy:release', // На удаленном сервере/Подготовить релизную папку.
    'upload', // На удаленном сервере/Загрузить в релизную папку файлы с buildserver.
    'deploy:shared',
    'deploy:writable',
    'deploy:symlink' // На удаленном сервере/Перебросить симлинк текущей папки на релизнкю
])->desc('Группа задачь для проливки текущего релиза на текущий сервер');
//task('deploy', [
//    'deploy:prepare',
//    'deploy:lock',
//    'deploy:release',
//    //'deploy:update_code',
//    'upload',
//    'deploy:copy_dirs',
//    'deploy:symlink',
//    'deploy:unlock',
//    'cleanup',
//])->desc('Deploy your project');
task('deploy', [
    //'build',
    'release',
    'cleanup',
    'success'
]);
//desc('Restart PHP-FPM service');
//task('php-fpm:restart', function () {
//    writeln("Перезапуск PHP...");
//    // The user must have rights for restart service
//    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
////    run('sudo systemctl restart php-fpm.service');
//});
//after('deploy:symlink', 'php-fpm:restart');
//// [Optional] if deploy fails automatically unlock.
//after('deploy:failed', 'deploy:unlock');
