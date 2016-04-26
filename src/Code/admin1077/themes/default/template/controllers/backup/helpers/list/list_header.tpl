{*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{extends file="helpers/list/list_header.tpl"}

{block name="override_header"}

	{if isset($backup_url) && isset($backup_weight)}
		<fieldset>
			<legend><img src="../img/admin/AdminBackup.gif" alt="" class="icon" /> {l s='Download'}</legend>
			<p style="font-size: 13px;">
				<a href="{$backup_url}"><img src="../img/admin/AdminBackup.gif" alt="" class="icon" /></a>
				<b><a href="{$backup_url}">{l s='Download the backup file'} ({$backup_weight}{l s='MB'})</a></b><br /><br />
				{l s='Tip: You can also download this file over to your FTP. Backup files are located in the "admin/backups" directory.'}</p>
		</fieldset><br /><br />
	{/if}

	<div class="error width1" style="float: left; margin-right: 10px;">
		<p>{l s='Disclaimer before creating a new backup'}</p>
		<ol style="font-size: 11px; font-weight: normal; line-height: 20px; padding-left: 10px;">
			<li>{l s='PrestaShop is not responsible for your database, its backups and/or recovery.'}</li>
			<li>{l s='PrestaShop is open-source software. You are using it at your own risk under the license agreement.'}</li>
			<li>{l s='You should backup your data on a regular basis (both files and database).'}</li>
			<li>{l s='This function only backs up your database, not your files.'}</li>
			<li>{l s='By default, your existing database tables will be dropped during the backup recovery (see "Backup options" below).'}</li>
			<li>{l s='Always verify the quality and integrity of your backup files!'}</li>
			<li>{l s='Always verify that your backup files are complete, up-to-date and valid, even if you had a success message appear during the backup process.'}</li>
			<li>{l s='Always check your data.'}</li>
			<li>{l s='Never restore a backup on a live site.'}</li>
		</ol>
		<br />

		<form action="{$currentIndex}&add{$table}&token={$token}" method="post" style="text-align:center;">
			<input type="submit" class="button" value="{l s='I have read the disclaimer. Please create a new backup.'}" style="padding:10px;font-weight:bold;border:1px solid;cursor:pointer;" />
		</form>

	</div>

	<div class="warn width2" style="float: left;">
		<p>{l s='How to restore a database backup in 10 easy steps:'}</p>
		<ol style="font-size: 11px; font-weight: normal; line-height: 20px;">
			<li>{l s='Set "Enable Shop" to "No" in the "Maintenance" page under the "Preferences" menu.'}</li>
			<li>{l s='Download the backup from the list below or from your FTP server (in the folder "admin/backups").'}</li>
			<li>{l s='Check the backup integrity: Look for errors, incomplete file, etc... Be sure to verify all of your data.'}</li>
			<li>{l s='Please ask your hosting provider for "phpMyAdmin" access to your database.'}</li>
			<li>{l s='Connect to "phpMyAdmin" and select your current database.'}</li>
			<li>{l s='Unless you enabled the "Drop existing tables" option, you must delete all tables from your current database.'}</li>
			<li>{l s='At the top of the screen, please select the "Import" tab'}</li>
			<li>{l s='Click on the "Browse" button and select the backup file from your hard drive.'}</li>
			<li>{l s='Check the maximum filesize allowed (e.g. Max: 16MB)'}<br />{l s='If your backup file exceeds this limit, contact your hosting provider for assistence. '}</li>
			<li>{l s='Click on the "Go" button and please wait patiently for the import  process to conclude. This may take several minutes.'}</li>
		</ol>
	</div>

	<div class="clear"></div>

{/block}