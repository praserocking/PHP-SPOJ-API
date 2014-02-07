<?php
class SPOJ{

	/*************************************************************************************

	>>> UnOfficial SPOJ API <<<

	SPOJ.com is a well-known site among competitive programmers which is a breed-ground of
	many great competitive programmers.

	@author Shenbaga Prasanna,S
	@country India
	@date 7/2/2014

	USAGE:
	------
	//Constructor
	require_once "spoj.php";
	$handle=new SPOJ('<username>');

	//Member Functions

	$handle->getWorldRank() >>> returns int, world rank of user
	$handle->getPoints() >>> returns float, points scored by the user
	$handle->getSolvedProblems() >>> returns array of strings, all problems solved by the user
	$handle->getCountry() >>> returns string, country specified by the user
	$handle->getInstitution() >>> returns string, Institution of the user
	$handle->getTotalSolved() >>> returns int, total problems solved by the user
	$handle->getTotalSubmitted() >>> returns int, total problems submitted by the user

	//Additional Functions
	**********************
	$handle->getAC();
	$handle->getWA();
	$handle->getCE();
	$handle->getRE();
	$handle->getTLE();

	***** All returns Integer ******
	WA = Wrong Answer
	AC = Accepted
	CE = Compilation Error
	RE = Runtime Error
	TLE= Time Limit Exceeded

	*************************************************************************************/

//Variables to be used

	private $user,$country,$institution,$total_solved,$total_submissions,$ac,$wa,$ce,$re,$tle,$content,$stripped;
	private $problems=array();


//Private Utility functions 

	private function getParameters(){
		$temp=explode("Country:",$this->stripped,2);
		$temp2=explode("Institution:",$temp[1],2);
		$this->country=trim($temp2[0]);
		$temp3=explode("Problems solved",$temp2[1],2);
		$this->institution=trim($temp3[0]);
		$temp4=explode("Time Limit Exceeded",$temp3[1],2);
		$temp4=explode(" ",$temp4[1],2);
		$problems=explode("\n",trim($temp4[0]));
		$this->total_solved=$problems[0];
		$this->total_submissions=$problems[1];
		$this->ac=$problems[2];
		$this->wa=$problems[3];
		$this->ce=$problems[4];
		$this->re=$problems[5];
		$this->tle=$problems[6];
		$temp=explode("solved classical problems:",$this->stripped,2);
		$temp2=explode("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TODO list of classical problems:",$temp[1],2);
		$problemsets=explode("\n\n",$temp2[0]);
		foreach($problemsets as $i){
			$j=explode("\n",$i);
			$this->problems=array_merge($this->problems,$j);
		}
	}

	private function setContent(){
		$URL="http://www.spoj.com/users/{$this->user}/";
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$URL);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
		$this->content=curl_exec($ch);
		curl_close($ch);
		$this->stripped=strip_tags($this->content);
		self::getParameters();
	}
//
//Constructor for class SPOJ
// Parameterized constructor. Argument: String - SPOJ Handle or username {its called either way}
	public function __construct($user){
		$this->user=$user;
		self::setContent();
	}

//Returns Integer, the world rank of the specified user while creating the object
	public function getWorldRank(){
		$temp=explode("Current world rank:",$this->content,2);
		$temp2=explode("</a></b><br><br>",$temp[1],2);
		$rank=explode("#",$temp2[0]);
		return intval($rank[1]);
	}

//Returns float, the points scored by the specified user
	public function getPoints(){
		$temp=explode("</a></b><br><br>",$this->content,2);
		$temp2=explode(" points)</p>",$temp[1]);
		$points=explode("(",$temp2[0]);
		return floatval($points[1]);
	}

//Returns String, the country of origin of the user
	public function getCountry(){
		return $this->country;
	}

//Returns String, the institution with which the user is associated
	public function getInstitution(){
		return $this->institution;
	}

//Returns Integer, the total number of solved problems by the user at SPOJ.com
	public function getTotalSolved(){
		return intval($this->total_solved);
	}

//Returns Integer, the total number of submitted solutions by the user
	public function getTotalSubmitted(){
		return intval($this->total_submissions);
	}

//Returns Integer, the total number of accepted solutions for the user
	public function getAC(){
		return intval($this->ac);
	}

//Returns Integer, the total number of wrong answers for the user
	public function getWA(){
		return intval($this->wa);
	}

//Returns Integer, the total number of Compilation Errors for the user
	public function getCE(){
		return intval($this->ce);
	}

//Returns Integer , the total number of Run Time Errors for the User.
	public function getRE(){
		return intval($this->re);
	}

//Returns Integer, the total number of TLE errors for the User.
	public function getTLE(){
		return intval($this->tle);
	}

//Returns an Array of Strings, All the problems solved by the user.
	public function getSolvedProblems(){
		return intval($this->problems);
	}
}
?>
