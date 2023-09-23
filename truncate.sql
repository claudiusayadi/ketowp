-- Temporarily disable strict SQL mode
SET @old_sql_mode=@@sql_mode, sql_mode='';

-- Your truncate commands here...

-- Delete all posts, comments, meta data and terms
TRUNCATE TABLE wp_posts;
TRUNCATE TABLE wp_postmeta;
TRUNCATE TABLE wp_comments;
TRUNCATE TABLE wp_commentmeta;
TRUNCATE TABLE wp_terms;
TRUNCATE TABLE wp_termmeta;
TRUNCATE TABLE wp_term_relationships;
TRUNCATE TABLE wp_term_taxonomy;

-- Delete all users except admin
DELETE FROM wp_users WHERE ID != 1;
DELETE FROM wp_usermeta WHERE user_id != 1;

-- Delete all links
TRUNCATE TABLE wp_links;

-- Delete all options
DELETE FROM wp_options WHERE option_name != 'siteurl' AND option_name != 'home';

-- Reset auto increment values
ALTER TABLE wp_posts AUTO_INCREMENT = 1;
ALTER TABLE wp_postmeta AUTO_INCREMENT = 1;
ALTER TABLE wp_comments AUTO_INCREMENT = 1;
ALTER TABLE wp_commentmeta AUTO_INCREMENT = 1;
ALTER TABLE wp_terms AUTO_INCREMENT = 1;
ALTER TABLE wp_termmeta AUTO_INCREMENT = 1;
ALTER TABLE wp_term_relationships AUTO_INCREMENT = 1;
ALTER TABLE wp_term_taxonomy AUTO_INCREMENT = 1;
ALTER TABLE wp_users AUTO_INCREMENT = 2;
ALTER TABLE wp_usermeta AUTO_INCREMENT = 1;
ALTER TABLE wp_links AUTO_INCREMENT = 1;
ALTER TABLE wp_options AUTO_INCREMENT = 1;

-- Revert to the original SQL mode
SET sql_mode=@old_sql_mode;