<?php
namespace Deployer;
require 'recipe/zend_framework.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('repository', 'https://github.com/ZVanoZ/sander.git');

add('shared_files', []);
add('shared_dirs', []);

add('writable_dirs', []);

// Servers

server('testserver1', '127.0.0.1')
    //->user('ivan')
    //->identityFile()
    //->pty(true)
    ->set('deploy_path', __DIR__ . '/testserver1.deploy_path')
;
server('testserver2', '127.0.0.1')
    //->user('ivan')
    //->identityFile()
    //->pty(true)
    ->set('deploy_path', __DIR__ . '/testserver2.deploy_path')
;
 

// Tasks
task('deploy:vendors', function () {
    writeln("Переопределили deploy:vendors...");
})->desc('Описание для deploy:vendors');

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    writeln("Перезапуск PHP...");
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
//    run('sudo systemctl restart php-fpm.service');
});


after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
