# Notes
# https://stackoverflow.com/questions/72817829/install-drupal-project-with-drupal-in-a-subdirectory
# ddev config --composer-root=maresmuseum --project-type=drupal9 --webserver-type=nginx-fpm --docroot=maresmuseum/web --create-docroot --web-working-dir=/var/www/html/maresmuseum
# ddev config --composer-root=demo --project-type=drupal10 --docroot=demo/web --web-working-dir=/var/www/html/demo --project-name=drupal
# ddev composer create drupal/recommended-project:^10
# ddev composer create drupal/recommended-project:^10 demo
# ddev config --composer-root=demo
# 
# Kill deads
# ddev stop --unlist drupal
#
# Installation by calling DDEV's wrappers for composer and drush
#  it does not work well with the current setup (drupal in a subdirectory)
# cd demo && \
# ddev composer create drupal/recommended-project:^10
# ddev composer require drush/drush && \
# ddev drush site:install --account-name=admin --account-pass=admin -y && \
# ddev drush uli && \
# ddev launch

setup:
	sudo rm -rf demo
	mkdir demo
	# Do not create the DDEV suggested configuration. It conflicts with composer's creation of the project
	ddev config --project-type=drupal10 --php-version=8.3 --docroot=demo/web --project-name=drupal --disable-settings-management 
	ddev start

drupal:
	# Require Drupal and Drush
	rm -rf demo/web
	ddev exec composer create drupal/recommended-project:^10 demo
	ddev exec composer -d demo require drush/drush
	# Install stock Drupal with drush
	ddev exec --dir=/var/www/html/demo ./vendor/bin/drush status
	ddev exec --dir=/var/www/html/demo ./vendor/bin/drush site:install --db-url=mysql://db:db@db:3306/db --account-name=admin --account-pass=admin -y
	# Link custom modules
	ddev exec ./link.sh
	# mkdir -p demo/web/modules/custom
	# ddev exec ln -s /var/www/html/ /var/www/html/demo/web/modules/custom/mt_domain_navigator
	ddev exec --dir=/var/www/html/demo ./vendor/bin/drush en mt_domain_navigator

down:
	ddev stop --unlist drupal

drush-cr:
	ddev exec --dir=/var/www/html/demo ./vendor/bin/drush cr

module-reinstall:
	ddev exec --dir=/var/www/html/demo ./vendor/bin/drush pm:uninstall mt_domain_navigator -y
	ddev exec --dir=/var/www/html/demo ./vendor/bin/drush en mt_domain_navigator
    
