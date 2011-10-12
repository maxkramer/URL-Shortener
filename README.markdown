##PHP & MySQL URL Shortener

This is a simple and easy to set up URL shortener for your site. All you need to do is set up some values in the includes.php file and create your MySQL Database which should be created using the code in the below section.

### MySQL Table Code

    CREATE TABLE IF NOT EXISTS `urls` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `url` text NOT NULL,
      `short_url` text NOT NULL,
      `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `number_of_visits` int(11) NOT NULL,
      `uploader_ip` text NOT NULL,
      `uploader_browser` text NOT NULL,
      `last_visit` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;
