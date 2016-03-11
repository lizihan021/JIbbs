<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_model extends CI_Model {
	private $data;
	function __construct(){
		parent::__construct();
		$this->load->database();

		$query = $this->db->get('bbs_mail');
        $settings = $query->result_array();
        foreach ($settings as $setting) {
            $this->data[$setting['item']]=$setting['value'];
        }
	}

	function send($to,$title,$body){
		//******************** 配置信息 ********************************
		$smtpserver = $this->data['mail_host'];//SMTP服务器
		$smtpserverport = $this->data['mail_port'];//SMTP服务器端口
		$smtpusermail = $this->data['mail_from'];//SMTP服务器的用户邮箱
		$smtpemailto = $to;//发送给谁
		$smtpuser = $this->data['mail_user'];//SMTP服务器的用户帐号
		$smtppass = $this->data['mail_pass'];//SMTP服务器的用户密码
		$mailtitle = $title;//邮件主题
		$mailcontent = $body;//邮件内容
		$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
		//************************ 配置信息 ****************************
		$smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = false;//是否显示发送的调试信息
		return $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
	}
}