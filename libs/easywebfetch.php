<?php

/*

 * EasyWebFetch - Fetch a page via cURL, a minimally modified version of

 * the original EasyWebFetch, replacing socket connections, allowing

 * for cookies, following redirects

 *

 * PHP version 5+

 *

 * This program is free software: you can redistribute it and/or modify

 * it under the terms of the GNU General Public License as published by

 * the Free Software Foundation, either version 3 of the License, or

 * (at your option) any later version.

 *

 * This program is distributed in the hope that it will be useful,

 * but WITHOUT ANY WARRANTY; without even the implied warranty of

 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

 * GNU General Public License for more details.

 *

 * You should have received a copy of the GNU General Public License

 * along with this program.  If not, see <http://www.gnu.org/licenses/>.

 *

 * @author 	  Nashruddin Amin <me@nashruddin.com>

 * @copyright Nashruddin Amin 2008

 * @license	  GNU General Public License 3.0

 * @package   EasyWebFetch

 * @version   1.1

 *

 * @author    Ray Paseur

 * @copyright none 2017

 * @version   1.2

 */



class EasyWebFetch

{

	private	$_request_url;

	private $_response_url;

	private $_scheme;

	private $_host;

	private $_path;

	private $_query;

	private $_fragment;

	private $_headers_only;

	private $_portnum		= 80;

	private $_prefix        = 'EasyWebFetch';

	private $_user_agent	= "SimpleHttpClient/1.0";

	private $_referer       = 'https://www.google.com';

	private $_req_timeout	= 30;

	private $_maxredirs		= 5;

	private $_extra_headers = null;



	private $_use_proxy		= false;

	private $_proxy_host;

	private $_proxy_port;

	private $_proxy_user;

	private $_proxy_pass;



	private $_status;

	private $_resp_headers;

	private $_resp_body;



	private $_is_error;

	private $_errmsg;



	/**

	 * class constructor

	 */

	public function __construct()

	{

		if (!extension_loaded('cURL')) trigger_error('PHP cURL Support is required for EasyWebFetch', E_USER_WARNING);

		$this->_resp_headers = array();

		$this->_resp_body	 = "";

	}



	/**

	 * get the requested page

	 *

	 * @param string  $url			URL of the requested page

	 * @param boolean $headers_only	true to return headers only,

	 *								false to return headers and body

	 *

	 * @return 	boolean	true on success, false on failure

	 */

	public function get($url = '', $headers_only = false)

	{

	    $this->parseURL($url);

		$this->_request_url	 = $url;

		$this->_response_url = $url;

		$this->_headers_only = $headers_only;



        $this->runCURL($url);



        // IF THE SERVER REDIRECTED US...

        if ($this->_resp_headers['location']) {

            $this->_response_url = $this->_resp_headers['location'];

            $this->parseURL($this->_resp_headers['location']);

        }

		return(true);

	}



	/**

	 * THIS METHOD IS _UN*USED_ BUT THE CODE IS LEFT IN PLACE BECAUSE

	 * I DO NOT KNOW WHETHER PROXY IS IN PLAY SOMEWHERE ELSE!

	 *

	 * build HTTP header and perform HTTP request

	 *

	 * @return 	mixed	HTTP response on success, false on failure

	 */

	private function makeRequest()

	{

		$method   	= ($this->_headers_only == true) ? "HEAD" : "GET";

		$proxy_auth = base64_encode("$this->_proxy_user:$this->_proxy_pass");

		$response 	= "";



		if ($this->_use_proxy) {

			$headers = "$method $this->_request_url HTTP/1.1\r\n"

					 . "Host: $this->_host\r\n"

					 . "Proxy-Authorization: Basic $proxy_auth\r\n"

					 . "User-Agent: $this->_user_agent\r\n"

					 . "Connection: Close\r\n";

			if ($this->_extra_headers) {

				foreach ($this->extra_headers as $header) $headers .= $header . "\r\n";

			}

			$headers .= "\r\n";



			$fp = fsockopen($this->_proxy_host, $this->_proxy_port, $errno, $errmsg, $this->_req_timeout);

		} else {

			$headers = "$method $this->_path$this->_query$this->_fragment HTTP/1.1\r\n"

					 . "Host: $this->_host\r\n"

					 . "User-Agent: $this->_user_agent\r\n"

					 . "Connection: Close\r\n";

			if ($this->_extra_headers) {

				foreach ($this->_extra_headers as $header) $headers .= $header . "\r\n";

			}

			$headers .= "\r\n";



			$fp = fsockopen($this->_host, $this->_portnum, $errno, $errmsg, $this->_req_timeout);

		}



		if (!$fp) {

			$this->_is_error = true;

			$this->_errmsg   = "Unknown error";

			return(false);

		}

		fwrite($fp, $headers);



		while(!feof($fp)) {

			$response .= fgets($fp, 4096);

		}

		fclose($fp);



		return($response);

	}



	/**

	 * parse the requested URL to its scheme, host, path, query and fragment

	 *

	 * @return void

	 */

	private function parseUrl($url)

	{

		$this->_scheme	 = parse_url($url, PHP_URL_SCHEME);

		$this->_host	 = parse_url($url, PHP_URL_HOST);

		$this->_path	 = parse_url($url, PHP_URL_PATH);

		$this->_query	 = parse_url($url, PHP_URL_QUERY);

		$this->_fragment = parse_url($url, PHP_URL_FRAGMENT);



		if (empty($this->_path)) {

			$this->_path = '/';

		}

	}



	/**

	 * set the requested URL

	 *

	 * @param string $url URL of the requested page

	 */

	public function setRequestUrl($url)

	{

		$this->_request_url = $url;

	}



	/**

	 * set to return headers only

	 *

	 * @param boolean $headers_only true to return headers only,

	 *								false to return headers and body

	 */

	public function returnHeadersOnly($headers_only)

	{

		$this->_headers_only = $headers_only;

	}



	/**

	 * set proxy host and port

	 *

	 * @param string $hostport proxy host and proxy port in format proxy_host:proxy_port

	 */

	public function setProxyHost($hostport)

	{

		list($this->_proxy_host, $this->_proxy_port) = explode(':', $hostport);

		$this->_use_proxy = true;

	}



	/**

	 * Set a custom UserAgent for the request

	 *

	 * @param string $useragent Check out http://www.useragentstring.com/pages/useragentstring.php for a list of valid user agents.

	 */

	public function setUserAgent($useragent) {

		$this->_user_agent = $useragent;

	}



	/**

	 * Set any additional http request headers

	 * such as "Accept-Encoding: gzip, deflate"

	 *

	 * @param string|array One or more header lines

	 */

	public function setExtraHeaders($headers) {

		if ( is_array($headers) ) {

			$this->_extra_headers = $headers;

		} else {

			$this->_extra_headers[] = $headers;

		}

	}



	/**

	 * set proxy user and password

	 *

	 * @param string $userpass proxy user and password in format proxy_user:proxy_password

	 */

	public function setProxyUser($userpass)

	{

		list($this->_proxy_user, $this->_proxy_pass) = explode(':', $userpass);

	}



	/**

	 * get the HTTP response status (200, 404, etc)

	 *

	 * @return string

	 */

	public function getStatus()

	{

		return($this->_status);

	}



	/**

	 * get the requested URL

	 *

	 * @return string

	 */

	public function getRequestUrl()

	{

		return($this->_request_url);

	}



	/**

	 * set maximum redirects

	 *

	 * @param int $maxredirs

	 */

	public function setMaxRedirs($maxredirs)

	{

		$this->_maxredirs = $maxredirs;

	}



	/**

	 * get HTTP response headers

	 *

	 * @param string $header Set this param if you want an individual header. cAsE-inSENSiTivE

	 * @return array|string

	 */

	public function getHeaders($header = null)

	{

		if ($header) {

			foreach (array_keys($this->_resp_headers) as $array_key ) {

				if ($array_key === strtolower($header) ) return( $this->_resp_headers[$array_key] ) ;

			}

		} else {

			return($this->_resp_headers);

		}

	}



	/**

	 * get the HTTP response body, usually in HTML

	 *

	 * @return string

	 */

	public function getContents()

	{

		return($this->_resp_body);

	}



	/**

	 * get the HTTP/HTTPS scheme

	 *

	 * @return string

	 */

	public function getScheme()

	{

		return($this->_scheme);

	}



	/**

	 * get error message

	 *

	 * @return string

	 */

	public function getErrorMessage()

	{

		return($this->_errmsg);

	}



	/**

	 * print debug information

	 */

	private function debug($text)

	{

		print "$text\n";

	}



	/**

	 * RUN A cURL REQUEST AND POPULATE OBJECT PROPERTIES

	 */

	protected function runCURL($url, $user=NULL, $pass=NULL)

	{

		// PREPARE THE CURL CALL

		$curl = curl_init();



		// HEADERS APPEAR TO BE A BROWSER

		$header[] = "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";

		$header[] = "Cache-Control: max-age=0";

		$header[] = "Connection: keep-alive";

		$header[] = "Keep-Alive: 300";

		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";

		$header[] = "Accept-Language: en-us,en;q=0.5";

		$header[] = "Accept-Encoding: gzip,deflate";

		$header[] = "Pragma: "; // BROWSERS USUALLY LEAVE THIS BLANK



		// SET THE CURL OPTIONS - SEE http://php.net/manual/en/function.curl-setopt.php

		curl_setopt( $curl, CURLOPT_URL,            $url  );

		curl_setopt( $curl, CURLOPT_USERAGENT,      $this->_user_agent  );

		curl_setopt( $curl, CURLOPT_HTTPHEADER,     $header  );

        curl_setopt( $curl, CURLOPT_REFERER,        $this->_referer  );

		curl_setopt( $curl, CURLOPT_ENCODING,       'gzip,deflate'  );

		curl_setopt( $curl, CURLOPT_AUTOREFERER,    TRUE  );

		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE  );

		curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, TRUE  );

		curl_setopt( $curl, CURLOPT_MAXREDIRS,      $this->_maxredirs  );

		curl_setopt( $curl, CURLOPT_TIMEOUT,        $this->_req_timeout  );

		curl_setopt( $curl, CURLOPT_HTTPAUTH,       CURLAUTH_ANY );

		curl_setopt( $curl, CURLOPT_USERPWD,        "$user:$pass" );



		// GET THE RESPONSE HEADERS

		curl_setopt( $curl, CURLOPT_HEADER,         TRUE );



		// GET GOOD ERROR MESSAGES

		curl_setopt( $curl, CURLOPT_VERBOSE,        TRUE );

		curl_setopt( $curl, CURLOPT_FAILONERROR,    TRUE );



		// IF USING SSL, THIS INFORMATION IS IMPORTANT -- UNDERSTAND THE SECURITY RISK!

		curl_setopt( $curl, CURLOPT_SSLVERSION,     CURL_SSLVERSION_DEFAULT );

		curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 2 ); // DEFAULT

		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 1 ); // DEFAULT



		// SET THE LOCATION OF THE COOKIE JAR (THIS FILE WILL BE OVERWRITTEN)

		curl_setopt( $curl, CURLOPT_COOKIEFILE,   $this->_prefix . 'cookie.txt' );

		curl_setopt( $curl, CURLOPT_COOKIEJAR,    $this->_prefix . 'cookie.txt' );



		// RUN THE CURL REQUEST AND GET THE RESULTS

		$response          = curl_exec($curl);

		$header_size       = curl_getinfo($curl, CURLINFO_HEADER_SIZE);

		$header_text       = substr($response, 0, $header_size);

		$this->_resp_body  = substr($response, $header_size);



		$this->_is_error   = curl_errno($curl);

		$this->_errmsg     = curl_error($curl);



		$info              = curl_getinfo($curl);

		$this->_status     = $info['http_code'];



		$this->_resp_headers['http_status'] = (string)$this->_status;

		$lines = explode("\r\n", trim($header_text));

		foreach ($lines as $line) {

		    if (!strpos($line, ':')) continue;



			list($key, $val) = explode(': ', $line);

			$key = str_replace("-", "_", $key);

			$key = strtolower($key);

			$val = trim($val);

			$this->_resp_headers[$key] = $val;

		}



		curl_close($curl);



		if ($this->_is_error) return FALSE;

		return TRUE;

	}



}

