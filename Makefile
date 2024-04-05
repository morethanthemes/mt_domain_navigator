drupal:
    ddev config --project-type=drupal9 --docroot=web --create-docroot
    ddev composer create "drupal/recommended-project:^9"
    ln -s $(shell pwd) web/modules/custom/mt_domain_navigator
    ddev start