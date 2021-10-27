#!/bin/sh
set -xe

# Detect the host IP
export DOCKER_BRIDGE_IP=$(ip ro | grep default | cut -d' ' -f 3)


# Start Apache with the right permissions after removing pre-existing PID file
rm -f /var/run/apache2/apache2.pid
#service ssh start
#service cron start
docker_conf/apache/start_safe_perms -DFOREGROUND

