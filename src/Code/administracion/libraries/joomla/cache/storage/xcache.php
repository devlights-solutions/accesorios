<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Cache
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * XCache cache storage handler
 *
 * @link   http://xcache.lighttpd.net/
 * @since  11.1
 */
class JCacheStorageXcache extends JCacheStorage
{
	/**
	 * Get cached data by id and group
	 *
	 * @param   string   $id         The cache data id
	 * @param   string   $group      The cache data group
	 * @param   boolean  $checkTime  True to verify cache time expiration threshold
	 *
	 * @return  mixed  Boolean false on failure or a cached data string
	 *
	 * @since   11.1
	 */
	public function get($id, $group, $checkTime = true)
	{
		// Make sure XCache is configured properly
		if (self::isSupported() == false)
		{
			return false;
		}

		$cache_id = $this->_getCacheId($id, $group);
		$cache_content = xcache_get($cache_id);

		if ($cache_content === null)
		{
			return false;
		}

		return $cache_content;
	}

	/**
	 * Get all cached data
	 *
	 * This requires the php.ini setting xcache.admin.enable_auth = Off.
	 *
	 * @return  array  data
	 *
	 * @since   11.1
	 */
	public function getAll()
	{
		parent::getAll();

		// Make sure XCache is configured properly
		if (self::isSupported() == false)
		{
			return array();
		}

		$allinfo = xcache_list(XC_TYPE_VAR, 0);
		$keys = $allinfo['cache_list'];
		$secret = $this->_hash;

		$data = array();

		foreach ($keys as $key)
		{
			$namearr = explode('-', $key['name']);

			if ($namearr !== false && $namearr[0] == $secret && $namearr[1] == 'cache')
			{
				$group = $namearr[2];

				if (!isset($data[$group]))
				{
					$item = new JCacheStorageHelper($group);
				}
				else
				{
					$item = $data[$group];
				}

				$item->updateSize($key['size'] / 1024);

				$data[$group] = $item;
			}
		}

		return $data;
	}

	/**
	 * Store the data by id and group
	 *
	 * @param   string  $id     The cache data id
	 * @param   string  $group  The cache data group
	 * @param   string  $data   The data to store in cache
	 *
	 * @return  boolean  True on success, false otherwise
	 *
	 * @since   11.1
	 */
	public function store($id, $group, $data)
	{
		// Make sure XCache is configured properly
		if (self::isSupported() == false)
		{
			return false;
		}

		$cache_id = $this->_getCacheId($id, $group);
		$store = xcache_set($cache_id, $data, $this->_lifetime);

		return $store;
	}

	/**
	 * Remove a cached data entry by id and group
	 *
	 * @param   string  $id     The cache data id
	 * @param   string  $group  The cache data group
	 *
	 * @return  boolean  True on success, false otherwise
	 *
	 * @since   11.1
	 */
	public function remove($id, $group)
	{
		// Make sure XCache is configured properly
		if (self::isSupported() == false)
		{
			return false;
		}

		$cache_id = $this->_getCacheId($id, $group);

		if (!xcache_isset($cache_id))
		{
			return true;
		}

		return xcache_unset($cache_id);
	}

	/**
	 * Clean cache for a group given a mode.
	 *
	 * This requires the php.ini setting xcache.admin.enable_auth = Off.
	 *
	 * @param   string  $group  The cache data group
	 * @param   string  $mode   The mode for cleaning cache [group|notgroup]
	 * group mode  : cleans all cache in the group
	 * notgroup mode  : cleans all cache not in the group
	 *
	 * @return  boolean  True on success, false otherwise
	 *
	 * @since   11.1
	 */
	public function clean($group, $mode = null)
	{
		// Make sure XCache is configured properly
		if (self::isSupported() == false)
		{
			return true;
		}

		$allinfo = xcache_list(XC_TYPE_VAR, 0);
		$keys = $allinfo['cache_list'];
		$secret = $this->_hash;

		foreach ($keys as $key)
		{
			if (strpos($key['name'], $secret . '-cache-' . $group . '-') === 0 xor $mode != 'group')
			{
				xcache_unset($key['name']);
			}
		}

		return true;
	}

	/**
	 * Garbage collect expired cache data
	 *
	 * This is a dummy, since xcache has built in garbage collector, turn it
	 * on in php.ini by changing default xcache.gc_interval setting from
	 * 0 to 3600 (=1 hour)
	 *
	 * @return  boolean  True on success, false otherwise.
	 *
	 * @since   11.1
	 */
	public function gc()
	{
		/*
		$now = time();

		$cachecount = xcache_count(XC_TYPE_VAR);

			for ($i = 0; $i < $cachecount; $i ++) {

				$allinfo  = xcache_list(XC_TYPE_VAR, $i);
				$keys = $allinfo ['cache_list'];

				foreach($keys as $key) {

					if (strstr($key['name'], $this->_hash)) {
						if (($key['ctime'] + $this->_lifetime ) < $this->_now) xcache_unset($key['name']);
					}
				}
			}

		 */

		return true;
	}

	/**
	 * Test to see if the cache storage is available.
	 *
	 * @return boolean True on success, false otherwise.
	 *
	 * @since   12.1
	 */
	public static function isSupported()
	{
		if (extension_loaded('xcache'))
		{
			// XCache Admin must be disabled for Joomla to use XCache
			$xcache_admin_enable_auth = ini_get('xcache.admin.enable_auth');

			// Some extensions ini variables are reported as strings
			if ($xcache_admin_enable_auth == 'Off')
			{
				return true;
			}

			// We require a string with contents 0, not a null value because it is not set since that then defaults to On/True
			if ($xcache_admin_enable_auth === '0')
			{
				return true;
			}

			// In some enviorments empty is equivalent to Off; See JC: #34044 && Github: #4083
			if ($xcache_admin_enable_auth === '')
			{
				return true;
			}
		}

		// If the settings are not correct, give up
		return false;
	}
}
