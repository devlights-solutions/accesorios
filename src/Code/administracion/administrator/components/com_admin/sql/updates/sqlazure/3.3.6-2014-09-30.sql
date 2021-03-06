INSERT INTO [#__update_sites] ([name], [type], [location], [enabled])
SELECT 'Joomla! Update Component Update Site', 'extension', 'http://update.joomla.org/core/extensions/com_joomlaupdate.xml', 1;

INSERT INTO [#__update_sites_extensions] ([update_site_id], [extension_id])
SELECT (SELECT [update_site_id] FROM [#__update_sites] WHERE [name] = 'Joomla! Update Component Update Site'), (SELECT [extension_id] FROM [#__extensions] WHERE [name] = 'com_joomlaupdate');
