# SiriServer-WebAddons

SiriServer-WebAddons is a PHP script to use with [SiriServer](https://github.com/cedbv/siriserver).

This addons is required to use the [twitter.py](https://github.com/cedbv/SiriServer/blob/master/plugins/twitter.py) and the [facebook.py](https://github.com/cedbv/SiriServer/blob/master/plugins/facebook.py) plugins.

## How To install

1. [Download the code](https://github.com/cedbv/SiriServer-WebAddons/zipball/master) and copy it in a public directory of your web server or clone this repository :
```
git clone https://github.com/cedbv/SiriServer-WebAddons.git
```
2. Rename config-sample.php to config.php
3. Edit config.php to match your config (See https://dev.twitter.com/apps to create a Twitter app and https://developers.facebook.com/apps to create a Facebook app)
4. It's ready. You can now use Twitter and/or Facebook plugin for SiriServer.