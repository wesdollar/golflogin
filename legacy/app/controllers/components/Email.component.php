<?php
/**
 * E-Mail component
 * @author Dimitar Ivanov, riverside[at]phpjabbers[dot]com
 *
 */
class Email
{
	var $emailRegExp = '/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i';
	
	var $eol = "\r\n";
	
	var $contentType = "text/plain";
	
	var $charset = "utf-8";
	
	function Email()
	{
		//constructor
	}
	
	function send($to, $subject, $message, $sender)
	{
		if (!preg_match($this->emailRegExp, $to))
		{
			return false;
		}
		
		if (!preg_match($this->emailRegExp, $sender))
		{
			return false;
		}

        // overwrite sender with GL system email address
        $sender = 'system@golflogin.com';
		
		$headers  = "MIME-Version: 1.0" . $this->eol;
		$headers .= "Content-type: ".$this->contentType."; charset=" . $this->charset . $this->eol;
		$headers .= "From: $sender" . $this->eol;
		$headers .= "Reply-To: $sender" . $this->eol;
		$headers .= "Return-Path: $sender" . $this->eol;
		$headers .= "X-Mailer: PHP/" . phpversion() . $this->eol;
		$headers .= "Message-Id:" . md5(time()) . $this->eol;
		$headers .= "X-Originating-IP:" . $_SERVER['REMOTE_ADDR'];
		
		$subject = '=?UTF-8?B?'.base64_encode($subject).'?=';

        try {
            mail($to, $subject, $message, $headers);
        }
        catch (\Exception $e) {
            die('Failed to send email.' . "\n\n" . $e->getMessage());
        }
	}
	
	function setCharset($charset)
	{
		$this->charset = $charset;
	}
	
	function setContentType($contentType)
	{
		if (!in_array($contentType, array('text/plain', 'text/html')))
		{
			return false;
		}
		$this->contentType = $contentType;
	}
	
	function setEol($eol)
	{
		$this->eol = $eol;
	}
}
?>