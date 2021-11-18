# doctaforumpodcast
Technical test for doctafurum


VERSIONS: 
  - PHP: 7.4.19
  - MYSQL: 5.7.33
  - APACHE: 2.4.47
  
 INSTRUCCTIONS:
  1. git clone https://github.com/dgarciaortiz94/doctaforumpodcast.git
  2. Rename .envprueba.local to .env
  3. Config .env database credentials
  4. Composer install
  5. Config your v-host
  6. You make sure that Environment Variables are configured in your machine.
  7. To get the database you can do:
     1. php bin/console doctrine:migrations:migrate
                
                or
                
     2. import in your database doctaforumpodcast.sql (I recommend you this option to get records)
  8. You should be able to use this app
