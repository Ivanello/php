# Task 1 
run:

`$ php parse.php`

# Task 2 

## Software requirements: 
* installed docker 
* installed composer

## run docker 

`$ docker run -d -name selenium-chrome -p 4444:4444 -p 5901:5900 selenium/standalone-chrome-debug:3.4.0-bismuth`

to connect to docker use any VNC viewer (password: secret)

`$ vncview 127.0.0.1:5901`

* useful comands for docker $ docker ps $ docker stop selenium-chrome 

`$ docker start selenium-chrome`

## run test 

`$ composer install `

`$ composer dump-autoload `

`$ ./vendor/bin/steward run staging chrome`

* to debug run

`$ ./vendor/bin/steward run staging chrome -vvv`
