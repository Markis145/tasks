# Supervisor per a Queueworker
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

EXPLOT:

# Supervisor per a Horizon

LOCAL: 

/etc/supervisor/conf.d/horizon-tasks-marcmestre-scool-cat.conf

``
[program:horizon-tasks-marcmestre-scool-cat]
process_name=%(program_name)s
command=php /home/marcmestre/Code/Markis145/tasks/artisan horizon
autostart=true
autorestart=true
user=marcmestre
redirect_stderr=true
stdout_logfile=/home/marcmestre/Code/Markis145/tasks/storage/logs/horizon.log
``

EXPLOT:
``
[program:horizon-tasks-marcmestre-scool-cat]
process_name=%(program_name)s
command=php /home/forge/tasks.marcmestre.scool.cat/artisan horizon
autostart=true
autorestart=true
user=forge
redirect_stderr=true
stdout_logfile=/home/forge/tasks.marcmestre.scool.cat/storage/logs/horizon.log
``