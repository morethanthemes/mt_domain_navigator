setup:
	rm -rf demo
	mkdir demo
	# cd demo && \
	ddev config --project-type=drupal10 --php-version=8.3 --docroot=demo/web --project-name=drupal && \
	ddev start

drupal:
	ddev exec composer create drupal/recommended-project:^10 demo
	ddev exec composer -d demo require drush/drush
	ddev exec --dir=/var/www/html/demo ./vendor/bin/drush status
	ddev exec --dir=/var/www/html/demo ./vendor/bin/drush site:install --account-name=admin --account-pass=admin -y
	# ddev exec drush site:install --account-name=admin --account-pass=admin -y
	# cd demo && \
	# ddev composer create drupal/recommended-project:^10
	# ddev composer require drush/drush && \
	# ddev drush site:install --account-name=admin --account-pass=admin -y && \
	# ddev drush uli && \
	# ddev launch
	
	

drush:
	# ddev exec --dir=/var/www/html/web vendor/bin/drush site:install --db-url=mysql://db:db@db:3306/db --account-name=admin --account-pass=password

link:
	mkdir -p demo/web/modules/custom
	ddev exec ln -s /var/www/html/module /var/www/html/demo/web/modules/custom
	# ln -s $(shell pwd) demo/web/modules/custom/mt_domain_navigator
    
