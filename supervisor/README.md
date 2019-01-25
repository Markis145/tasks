Path:

``
/etc/supervisor/conf.d/tasks.marcmestre.scool.cat.conf
``

Contingut:

LOCAL:
``
[program:laravel-worker-tasks-marcmestre-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/marcmestre/Code/Markis145/tasks/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=marcmestre
numprocs=8
redirect_stderr=true
stdout_logfile=/home/marcmestre/Code/Markis145/tasks/storage/logs/worker.log
``

EXPLOT