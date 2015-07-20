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
