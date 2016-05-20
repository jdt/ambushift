# ambucheck
An online ambulance shift planning tool

## The Vagrant environment
The vagrant server automatically forwards ports 80 and 3306 (HTTP and MySQL). If those are in use on your local machine, change them in the vagrantfile to another port in order to access the application.

## Running
Simply 'vagrant up' and point a browser to http://localhost/app_dev.php Note that the installation downloads and installs required libraries via composer, but that there is no output for this on the vagrant output. It might seem as if the installation hangs for a bit, but it is recommended to let it run for some time before aborting. While this is happening you should see files and directories being created in the Source/vendor directory.

## Adding modules
Add modules to the Puppet directory with
puppet module install <module name> --target-dir /vagrant/Build/Puppet/dev/modules

### Modules used
example42-mysql
example42-apache
willdurand-composer

### Custom modules
php
phpunit

## Themes ##
Based on the 'Paper Kit' theme from http://www.creative-tim.com/product/paper-kit