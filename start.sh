#!/bin/bash
# Start MySQL service
service mysql start

# Initialize the database if not already initialized
if [ ! -d "/var/lib/mysql/empowermental" ]; then
    mysql -u root -e "CREATE DATABASE IF NOT EXISTS empowermental;"
    mysql -u root empowermental < /empowermental.sql
fi

# Start Apache service
apachectl -D FOREGROUND
