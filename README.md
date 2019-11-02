### CRON jobs

`15 * * * * dokku --rm-container run dynastyprocess-api php bin/console app:data-import >/dev/null 2>&1`

`00 06 * * * dokku --rm-container run dynastyprocess-api php bin/console app:store-values >/dev/null 2>&1`
