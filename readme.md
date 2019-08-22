<h3>Start</h3>
<p>
  <ul>
    <li>
      run composer install
    </li>
    <li>
      run npm install
    </li>
    <li>
      copy .env.example to .env
    </li>
    <li>
      php artisan key:generate
    </li>
    <li>
      create empty db for this project
    </li>
    <li>
      In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created. 
    </li>
    <li>
      php artisan migrate
    </li>
    <li>
      php artisan db:seed
    </li>
    <li>
      php artisan passport:install
    </li>
    <li>
      In the .env file fill in the PASSWORD_CLIENT_ID, PASSWORD_CLIENT_SECRET with data in DB table oauth_clients
    </li>
  </ul>
</p>
