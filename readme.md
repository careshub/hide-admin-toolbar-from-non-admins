# CARES Hide Admin Bar from Non-Admins

On user creation, set the user meta that controls whether logged-in users see the front-end WP Toolbar to `false` for users who are not site admins. To use, just install this plugin, and all future users will have their user meta `show_admin_bar_front` set to `false`. To hide the toolbar from existing users, you can edit them one at a time by visiting wp-admin/users.php, selecting a user, and unchecking "Show Toolbar when viewing site".
