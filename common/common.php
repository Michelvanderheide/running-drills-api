<?php
/***
* common class
* with the most common well known methods
* JV February 2016
*/

class Common {
	

	/**
	 * well known HTML template tag parser
	 */
	public function parse ($tags, $template='') {
		if (is_array ($tags)) {
			foreach ($tags as $k => $v) {
				$f [] = '<!--%%'.$k . '%%-->';
				$r [] = $v;
			}
			$template = str_replace ($f, $r, $template );
		}
		
		$html = preg_replace ("/<\!--%%.*?%%--\>/", '', $template);

		return $html;
	}

	/**
	 * send an single email
	 */ 
	public function sendMail ($to, $from, $fromname, $cc, $bcc, $subject, $html, $text = '') {
		global $apiConfig;
	
						
		//create a boundary for the email. This 
		$boundary = uniqid('np');
						
		//headers - specify your from email address and name here
		//and specify the boundary for the email
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From: $fromname <$from> \r\n";
		$headers .= "To: ".$to."\r\n";
		if ($cc!='') {
			$headers .= "CC: ".$cc."\r\n";
		}
		if ($bcc!='') {
			$headers .= "BCC: ".$bcc."\r\n";
		}
		$headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";

		//here is the content body
		$message = $html;
		$message .= "\r\n\r\n--" . $boundary . "\r\n";
		$message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";

		//Plain text body
		$message .= $text;
		
		$message .= "\r\n\r\n--" . $boundary . "\r\n";
		$message .= "Content-type: text/html;charset=utf-8\r\n\r\n";

		//Html body
		$message .= $html;
		$message .= "\r\n\r\n--" . $boundary . "--";

		//invoke the PHP mail function
		if ( mail($to, $subject, $message, $headers)) {
			$rv = "ok";
		} else {
			$rv = "error";
		}
		return $rv;
		
	}

	/**
	 * get a email template
	 */
	public function getMailTemplate ($template) {
		return $this -> getFile ('www/emailtemplates/' . $template . '.html');
	}

	/**
	 * get a HTML template
	 */
	public function getHTMLTemplate ($template) {
		return $this -> getFile ('www/templates/' . $template . '.html');
	}

	/**
	* common file function: read a (text, HTML) file from givven location
	*/
	private function getFile ($file) {
		global $apiConfig;
		$file = $apiConfig['basedir'].$file;
		$rv = '[error] no file available';
		
		if (is_file ($file)) {
			$rv = file_get_contents ($file);
		}

		return $rv;
	}



}