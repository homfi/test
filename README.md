## Usage

- git clone https://github.com/homfi/test.git
- copy .env.example to .env
- (optional) change default mysql docker volume location (DOCKER_MYSQL_VOLUME variable)
- make sure port 80 is free or change APP_EXTERNAL_LISTEN_PORT variable in env file
- make sure port 33069 is free or change MYSQL_EXTERNAL_LISTEN_PORT variable in env file
- run **./laravel** without arguments for usage information
- run **./laravel -u** to start the app
- point your browser to http://localhost (add your port, if changed APP_EXTERNAL_LISTEN_PORT) to test endpoints using grqphiql
- the app is already populated with the required data
- try following requests:
  - `query order { order(id: 1) { id status items { id amount product { id name } } } }`
  - `mutation upsertOrderItem { upsertOrderItem(id: 4, order_id: 1, product_id: 1, amount: 13) { id } }`
