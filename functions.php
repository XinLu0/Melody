<?php
	/* 
	Template Name: testing 
	*/ 
	$UserID;

	// get password from member ID
	function getPasswordByMemberID($memberID){
		global $wpdb;    
		$result = $wpdb->get_results("SELECT Password FROM Teacher_infor WHERE Member=$memberID");
		return $result[0]->Password;	
	}

	function comparePassword($input,$fromDatabase){
		return strcmp($input,$fromDatabase);
	}

	// get name from member ID
	function getNameByMemberID($memberID){
		global $wpdb;
		$result = $wpdb->get_results("SELECT Name FROM Teacher_infor WHERE Member=$memberID");
		return $result[0]->Name;
	}

	// get Below Teacher List from Name
	function getBelowTeacherListFromName($Name){
		global $wpdb;
		$result = $wpdb->get_results("SELECT Name FROM Teacher_infor WHERE Major=\"".$Name."\"");
		$nameArray;
		$size = sizeof($result);
		for($x = 0; $x < $size; $x++){
			$nameArray[$x] = $result[$x]->Name;
		}
		return $nameArray;
	}

	function getAllTeacherMemberID(){
		global $wpdb;
		$result = $wpdb->get_results("SELECT Member FROM Teacher_infor");
		$mList;
		$size = sizeof($result);
		for($x = 0; $x < $size; $x++){
			$mList[$x] = $result[$x]->Member;
		}
		return $mList;
	}

	function getMemberIDFromName($Name){
		global $wpdb;
		$result = $wpdb->get_results("SELECT Member FROM Teacher_infor WHERE Name=\"$Name\"");
		return $result[0]->Member;
	}

	//get ItemName, Number, Price by Member ID where Datefrom to DateTo
	function getItemNameNumberPrice($Member, $DateFrom, $DateTo){
		global $wpdb;
		$temp = $wpdb->get_results("SELECT Item, Number, Price FROM Melody_performance INNER JOIN Melody_items ON Melody_performance.item_no = Melody_items.item_no WHERE Member = ".$Member. " AND Date >=\"".$DateFrom."\" AND Date<\"".$DateTo."\""
		 );
		$resultItem = array();
		$resultPrice = array();
		$num = sizeof($temp);
		for($x = 0; $x < $num; $x++){
			if(!array_key_exists($temp[$x]->Item,$resultItem)){
				$resultItem[$temp[$x]->Item] = 1;
			}
			else {
				$resultItem[$temp[$x]->Item] = $resultItem[$temp[$x]->Item]+1;
			}
			$resultPrice[$temp[$x]->Item] = $temp[$x]->Price;
		}
		$result = new stdClass();
		$result->Item = $resultItem;
		$result->Price = $resultPrice;
		return $result;
	}

	function getNumOfItemByItemIDAndMemeberID($memberID, $item_no){
		global $wpdb;
		global $dateFrom;
		global $dateTo;
		$sum = $wpdb->get_results("SELECT Number FROM Melody_performance WHERE Member =$memberID AND Item_no=$item_no AND dDate >=\" $dateFrom \"AND dDate <=\" $dateTo\"");

		if(sizeof($sum) == 0)
			return 0;
		else {
			$result;
			for($x = 0; $x < sizeof($sum); $x++){
				$result = $result + $sum[$x]->Number;
			}
			return $result;
		}
	}

	function getTotalItemNumber(){
		global $wpdb;
		$sum = $wpdb->get_results("SELECT * FROM Melody_items ");

		return sizeof($sum);
	}

	function getMajorprop($item_no){
		global $wpdb;
		$sum = $wpdb->get_results("SELECT Major_proprotion FROM Melody_items WHERE Item_no = $item_no");
		$result = $sum[0]->Major_proprotion;
		return $result;
	}

	function getMinorOneprop($item_no){
		global $wpdb;
		$sum = $wpdb->get_results("SELECT Minor1_proprotion FROM Melody_items WHERE Item_no = $item_no");
		$result = $sum[0]->Minor1_proprotion;
		return $result;
	}

	function getMinorTwoprop($item_no){
		global $wpdb;
		$sum = $wpdb->get_results("SELECT Minor2_proprotion FROM Melody_items WHERE Item_no = $item_no");
		$result = $sum[0]->Minor2_proprotion;
		return $result;
	}

	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}

	function getItemNameByItemID($item_id){
		global $wpdb;
		$sum = $wpdb->get_results("SELECT Item FROM Melody_items WHERE item_no =$item_id");
		return $sum[0]->Item;
	}

	function getItemPriceByItemID($item_id){
		global $wpdb;
		$sum = $wpdb->get_results("SELECT Price FROM Melody_items WHERE item_no =$item_id");
		return $sum[0]->Price;
	}

	function getDatefromToByMonth($yyyymm){
		$month = substr($yyyymm, -2);
		$year = substr($yyyymm,0, 4);
		$nextMonth = $month+1;
		if($nextMonth>12)
			$nextMonth="01";
		else if($nextMonth<10)
			$nextMonth = "0".$nextMonth;
		global $dateFrom;
		$dateFrom = $year."-".$month."-01";
		global $dateTo;
		$dateTo = $year."-".$nextMonth."-01";
	}

	function getDatefromToByCurrent(){
		$currentDate = date('Y-m-d');
		$currentMonth = substr($currentDate,5,2);
		$nextMonth = $currentMonth+1;
		if($nextMonth>12)
			$nextMonth="01";
		else if($nextMonth<10)
			$nextMonth = "0".$nextMonth;
		global $dateFrom;
		global $dateTo;
		$dateFrom = substr($currentDate,0,7)."-01";
		$dateTo = substr($currentDate,0,4)."-".$nextMonth."-01";
	}

	function isAdminByMemberId($mId){
		global $wpdb;
		$sum = $wpdb->get_results("SELECT isAdmin FROM Teacher_infor WHERE Member = $mId");
		return ($sum[0]->isAdmin); 
	}
	function getListofEmail(){
		global $wpdb;
		$sum = $wpdb->get_results("SELECT Email FROM `Teacher_infor`");
		$num = sizeof($sum);
		$result = array();
		for($x=0;$x<$num;$x++){
			if($sum[$x]->Email!="")
				$result[$x]=$sum[$x]->Email;
		}
		return $result;
	}
function updateEmailByMID($Mid,$email){
	global $wpdb;
	$wpdb->query($wpdb->prepare( "UPDATE `Teacher_infor` SET Email=\"$email\" WHERE Member = $Mid"));
}
function updatePasswordByMID($Mid,$password){
	global $wpdb;
	$wpdb->query($wpdb->prepare( "UPDATE `Teacher_infor` SET Password=\"$password\" WHERE Member = $Mid"));
}
function updateContactNoByMID($Mid,$Contact_no){
	global $wpdb;
	$wpdb->query($wpdb->prepare( "UPDATE `Teacher_infor` SET Contact_no=\"$Contact_no\" WHERE Member = $Mid"));
}
function sendEmail($subject, $emailList, $message,$isHTML)
{
	
	for($x = 0; $x<sizeof($emailList);$x++)
	{
		$to = $emailList[$x];
	
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		$headers[] = 'From: Melody Strings Art Center <Melody@Melody.com>';
		if($isHTML)
		{
			mail($to, $subject, $message,implode("\r\n", $headers));
		}
		else mail($to, $subject, $message);
	}
}
function stringCompare($string1, $string2){
	return ($string1==$string2);
}
?>