ALTER TABLE `users` ADD `uploadpos` ENUM( 'yes', 'no' ) DEFAULT 'yes' NOT NULL;
ALTER TABLE `users` ADD `forumpost` ENUM( 'yes', 'no' ) DEFAULT 'yes' NOT NULL;
ALTER TABLE `users` ADD `downloadpos` ENUM( 'yes', 'no' ) DEFAULT 'yes' NOT NULL;
