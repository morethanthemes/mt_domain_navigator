setup:
	rm -rf demo
	mkdir demo
	cd demo && \
	ddev config --project-type=drupal10 --php-version=8.3 --docroot=web && \
	ddev start

drupal:
	cd demo && \
	ddev composer create drupal/recommended-project:^10 && \
	ddev composer require drush/drush && \
	ddev drush site:install --account-name=admin --account-pass=admin -y && \
	ddev drush uli && \
	ddev launch
	
	

drush:
	# ddev exec --dir=/var/www/html/web vendor/bin/drush site:install --db-url=mysql://db:db@db:3306/db --account-name=admin --account-pass=password

module:
	mkdir -p demo/web/modules/custom
	ln -s $(shell pwd) demo/web/modules/custom/mt_domain_navigator
