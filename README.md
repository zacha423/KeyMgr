# KeyMgr
## KeyMgr
KeyMgr (Key Manager) is a Linux based tool for facilities departments to track and manage keys to buildings for their organization. KeyMgr includes tools for different levels of staff, and for all key holders.
## Begin Development
This project utilizes VSCode's Dev Containers. Development can be done locally inside the container, or on GitHub Codespaces.  
[![Open in GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/zacha423/KeyMgr)  
**Important:** When first creating the Dev Containers let the container run for a few minutes to finish the postCreate command.  

### Environment Setup
1. `cd KeyMgr`
2. `cp .env.example .env`
3. `php artisan key:generate`
4. `composer install`
5. `npm install`
6. `php artisan migrate:fresh --seed`
7. Start programming!

## Containers and Connections
### Web Server 
Local Port: 8080  
### Database
Local Port: 5432  
### PGAdmin4
Local Port: 8081  
Username: admin@keymgr.com  
Password: keymgr  
