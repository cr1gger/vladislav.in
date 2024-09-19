#!/bin/bash
wait-for-it ${MYSQL_HOST}:${MYSQL_PORT} && cd /app && php yii migrate --interactive=0 && php yii migrate-control --interactive=0 && php yii control/user/create-root && exit