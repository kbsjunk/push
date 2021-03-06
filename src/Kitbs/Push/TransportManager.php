<?php namespace Kitbs\Push;

use Illuminate\Support\Manager;
// use Swift_SmtpTransport as SmtpTransport;
// use Swift_MailTransport as MailTransport;
use Kitbs\Push\Transport\LogTransport;
use Kitbs\Push\Transport\PushoverTransport;
// use Kitbs\Push\Transport\MandrillTransport;
// use Swift_SendmailTransport as SendmailTransport;

class TransportManager extends Manager {

	/**
	 * Create an instance of the SMTP Swift Transport driver.
	 *
	 * @return \Swift_SmtpTransport
	 */
	// protected function createSmtpDriver()
	// {
	// 	$config = $this->app['config']['mail'];

	// 	// The Swift SMTP transport instance will allow us to use any SMTP backend
	// 	// for delivering mail such as Sendgrid, Amazon SES, or a custom server
	// 	// a developer has available. We will just pass this configured host.
	// 	$transport = SmtpTransport::newInstance(
	// 		$config['host'], $config['port']
	// 	);

	// 	if (isset($config['encryption']))
	// 	{
	// 		$transport->setEncryption($config['encryption']);
	// 	}

	// 	// Once we have the transport we will check for the presence of a username
	// 	// and password. If we have it we will set the credentials on the Swift
	// 	// transporter instance so that we'll properly authenticate delivery.
	// 	if (isset($config['username']))
	// 	{
	// 		$transport->setUsername($config['username']);

	// 		$transport->setPassword($config['password']);
	// 	}

	// 	return $transport;
	// }

	/**
	 * Create an instance of the Sendmail Swift Transport driver.
	 *
	 * @return \Swift_SendmailTransport
	 */
	// protected function createPushoverDriver()
	// {
	// 	$command = $this->app['config']['push']['pushover'];

	// 	return SendmailTransport::newInstance($command);
	// }

	/**
	 * Create an instance of the Mail Swift Transport driver.
	 *
	 * @return \Swift_MailTransport
	 */
	// protected function createMailDriver()
	// {
	// 	return MailTransport::newInstance();
	// }

	/**
	 * Create an instance of the Mailgun Swift Transport driver.
	 *
	 * @return \Kitbs\Push\Transport\MailgunTransport
	 */
	protected function createPushoverDriver()
	{
		$config = $this->app['config']->get('services.pushover', array());

		return new PushoverTransport($config['token']);
	}

	/**
	 * Create an instance of the Mandrill Swift Transport driver.
	 *
	 * @return \Kitbs\Push\Transport\MandrillTransport
	 */
	// protected function createMandrillDriver()
	// {
	// 	$config = $this->app['config']->get('services.mandrill', array());

	// 	return new MandrillTransport($config['secret']);
	// }

	/**
	 * Create an instance of the Log Swift Transport driver.
	 *
	 * @return \Kitbs\Push\Transport\LogTransport
	 */
	protected function createLogDriver()
	{
		return new LogTransport($this->app['log']->getMonolog());
	}

	/**
	 * Get the default cache driver name.
	 *
	 * @return string
	 */
	public function getDefaultDriver()
	{
		return $this->app['config']['mail.driver'];
	}

	/**
	 * Set the default cache driver name.
	 *
	 * @param  string  $name
	 * @return void
	 */
	public function setDefaultDriver($name)
	{
		$this->app['config']['mail.driver'] = $name;
	}

}
