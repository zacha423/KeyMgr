# KeyMgr
## KeyMgr
KeyMgr (Key Manager) is a Linux based tool for facilities departments to track and manage keys to buildings for their organization. KeyMgr includes tools for different levels of staff, and for all key holders.
## Begin Development
This project utilizes VSCode's Dev Containers. Development can be done locally inside the container, or on GitHub Codespaces.
[![Open in GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/zacha423/KeyMgr)

### 1. Prepare Laravel environment variables.
Copy KeyMgr/.env.example to KeyMgr/.env
(I'm out of date, make sure the database credentials are correct.)
### 2. Reload VSCode in a DevContainer
>Dev Containers: Rebuild and reload container.
### 3. Install composer dependencies
cd KeyMgr; composer install

## Containers and Connections
### Web Server
Local Port: 8080
### Database
Local Port: 5432
### PGAdmin4
Local Port: 8081
Username: admin@keymgr.com
Password: keymgr


