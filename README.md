
## About Server Shop

Server Shop is a single page web application buit in Laravel & React. 

## Specifications
- The web page is for a situation where Product Owner wants to offer a list of server information to customers.
- The functional requirements are that the list should help customers to quickly find what they are looking for.

- The list is quite large, so having several filters is a must.  
- Customers want to compare server specs and prices to each other.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Tech Stacks

- PHP     : >= "^7.2.5", 
- Laravel : PHP Framework(V7)
- React   : Laravel React scaffolding
- Template Engine - Twing : for Import page
- Docker  : Docker is a set of platform as a service products that use OS-level virtualization to deliver software in packages called containers. 
- Mysql   : Relational Database
- Bootstrap : CSS Sass framework
- lodash : JavaScript library which provides utility functions for common programming tasks using the functional programming paradigm.

## To setup

Simplicity of deployment is focus here. So, I've commited the frontend overheads to reduce deployment steps. Follow below steps to your system.
 
- git clone https://github.com/amiteshbhartiya/server-shop.git
- composer install -to Run Laravel/Backend dependency
- Copy .env.example into .env  [it's environment file of laravel] 
- Last step is to manage Database configuration dependecy
  - php artisan migrate
  -(Admin Panel) http://127.0.0.1:8001/import-excel
  - User Panel (http://127.0.0.1:8001)


##### Now application is ready to serve

#### Out of the box 
I used Docker for mysql dependencies
   
   - **[download docker](https://www.docker.com/products/docker-desktop)**
   - docker-comoser configuration is already written in **[docker-composer.you](https://github.com/amiteshbhartiya/itemmanager-laravelreact/blob/master/docker-compose.yml)**
   - docker-compose up -d    (To run as background job)
   - mysql is ready to listen on 127.0.0.0:3607 out side of swarm but with in docker n/w host: mysql port: 3306  

## Development highlight

- Repository Service Model Pattern
- Form Request
- Docker
- React scaffolding
- React Functional Components & Hooks (I think it's better than class component - more lightweight & Readable)

## Next Steps
That’s all there is to it. There’s definitely room for improvement—you can implement OAuth2 with the Passport package, integrate a pagination and transformation layer (I recommend Fractal), the list goes on—but I wanted to go through the basics of creating and testing an API in Laravel with no external packages.

- **[Git Repo](https://github.com/amiteshbhartiya/itemmanager-laravelreact.git)**
