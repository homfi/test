## Usage

- git clone https://github.com/homfi/test.git
- authorize using login _homfi_
- git checkout -b _your_name_surname_
- copy .env.example to .env
- (optional) change default mysql docker volume location (DOCKER_MYSQL_VOLUME variable)
- make sure port 80 is free
- run **./laravel** without arguments for usage information
- run **./laravel -u** to start the app
- point your browser to http://0.0.0.0 (localhost) to test endpoints using grqphiql
- the app is already populated with the required data
- try:
  - `query q { order(id: 1) { id status items { id amount product { id name } } } }`
  - `mutation m { upsertOrderItem(id: 4, order_id: 1, product_id: 1, amount: 13) { id } }`
- test operations using query and mutation from graphql.txt file
