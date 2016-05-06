# moodle-local_abintegro
Auth Token Authentication and SSO For Moodle Users Into Abintegro

Abintegro SSO Plugin
=======

Copyright 2016 Josh Willcock (www.joshwillcock.co.uk)

This is a local plugin which you can install in your Moodle system to enable access to your Abintegro.

This plugin was created By Josh Willcock and has no official status by Moodle
or Abintegro at this time. This plugin is available for anybody to use and can
be configured easily.


Branch:

This is branch is the master branch with the latest code available ready for a production
environment. If you would like to contribute to this plugin please create a branch with
adiquate explanation of the changes and request the change.

Support:

I cannot offer direct support. However, Please feel free to contact me directly and
I will assist you to the best of my ability. For Abintegro related issues please
contact: https://www.abintegro.com/public/contact-us. For issues relating to this plugin
please feel free to contact me.

Reliability:

Please note this code is tested on our own development and production servers however
I have to rely on the community for testing on other systems.

Requires:

Moodle 2.8+
Postgres / MySQL

Install:

Place the contents of this source tree into your Moodle installation so that
within your Moodle root, this file is local/abintegro/README. Then visit the
Moodle notifications page to install.

Once you have added your settings the plugin will be ready to use. If you need
to change these at any time you can find the settings in:
Site Administration > Plugins > Local > Abintegro.

Once this has been done you can create a link to: http://mysiteurl.com/local/abintegro/
This can be a text link anywhere in the site or adding a URL resource to any course.

Default permissions allow anybody with a login to access Abintegro, this can be configured
so only certain roles are able to. In the event of any error a message will be cleanly
displayed advising the user to contact the site administrator.
