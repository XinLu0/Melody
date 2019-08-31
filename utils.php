<?php
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    function getPasswordByMemberID($memberID){
        global $wpdb;    
        $result = $wpdb->get_results( "SELECT Password FROM Teacher_infor WHERE Member=".$memberID);
        return $result[0]->Password;
    }

    function comparePassword($input,$fromDatabase){
        return strcmp($input,$fromDatabase);
    }

    function isAdminByMemberId($mId){
        global $wpdb;
        $sum = $wpdb->get_results("SELECT isAdmin FROM `Teacher_infor` WHERE Member = $mId");
        return ($sum[0]->isAdmin); 
    }

    function updateLoginTimesByMID($Mid,$login){
        global $wpdb;
        $wpdb->query($wpdb->prepare( "UPDATE `Teacher_infor` SET loginTimes=$login WHERE Member = $Mid"));
    }

    function getLoginTimesFromMID($mId){
        global $wpdb;
        $result = $wpdb->get_results("SELECT loginTimes FROM Teacher_infor WHERE Member=$mId");
        return $result[0]->loginTimes;
    }

    function getPriceCNByItemNo($itemNo){
		global $wpdb;
		$result = $wpdb->get_results("SELECT Price_CN FROM Melody_items_New WHERE Item_no=$itemNo");
		return $result[0]->Price_CN;
        }
        
    function getPriceSGByItemNo($itemNo){
		global $wpdb;
		$result = $wpdb->get_results("SELECT Price_SG FROM Melody_items_New WHERE Item_no=$itemNo");
		return $result[0]->Price_SG;
    }

    function getTotalItemNumber(){
        global $wpdb;
        $sum = $wpdb->get_results("SELECT * FROM Melody_items_New");
        return sizeof($sum);
      }

    function getMajorPropsCNByItemNo($itemNo){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Major_Proportion_CN FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Major_Proportion_CN;
    }
    function getMinorPropsCNByItemNo($itemNo){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Minor_Proportion_CN FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Minor_Proportion_CN;
    }
    function getMajorPropsSGByItemNo($itemNo){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Major_Proportion_SG FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Major_Proportion_SG;
    }
    function getMinorPropsSGByItemNo($itemNo){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Minor_Proportion_SG FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Minor_Proportion_SG;
    }

    function getNameByMemberID($memberID){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Name FROM Teacher_infor WHERE Member=$memberID");
        return $result[0]->Name;
    }

    function getNumOfItemByItemIDAndMemeberID($memberID, $item_no){
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Number FROM Melody_performance WHERE Member =$memberID AND Item_no=$item_no");

        
        if(sizeof($sum)==0)
            return 0;
        else 
        {
            $result;
            for($x=0;$x<sizeof($sum);$x++){
                $result = $result+ $sum[$x]->Number;
                
            }
            return $result;
        }
    }

    function getNumOfItemByItemIDAndMemeberIDAndDate($memberID, $item_no, $dateFrom)
    {
        global $wpdb;

        $sum = $wpdb->get_results("SELECT Number FROM Melody_performance WHERE Member =$memberID AND Item_no=$item_no AND dDate >=\" $dateFrom \"");

        if(sizeof($sum)==0)
            return 0;
        else 
        {
            $result;
            for($x=0;$x<sizeof($sum);$x++){
            $result = $result+ $sum[$x]->Number;
            
            }
            return $result;
        }	  
    }

    function getBelowTeacherListFromName($Name){
        global $wpdb;
        $result = $wpdb->get_results( "SELECT Name FROM Teacher_infor WHERE Major=\"".$Name."\"");

        $nameArray;
        $size = sizeof($result);
        for($x = 0; $x < $size; $x ++){
            $nameArray[$x]=$result[$x]->Name;
        }
        return $nameArray;
    }

    function getMemberIDFromName($Name){
        global $wpdb;
        $result = $wpdb->get_results( "SELECT Member FROM Teacher_infor WHERE Name=\"$Name\"");
        return $result[0]->Member;
    }

    function getItemNameByItemID($item_id){
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Item FROM Melody_items WHERE item_no=$item_id");
        return $sum[0]->Item;
    }

    function getDatefromToByMonth($yyyymm){
        $month = substr($yyyymm, -2);
        $year = substr($yyyymm,0, 4);
        $toyear = substr($yyyymm,0, 4);
        $nextMonth = $month+1;
        if($nextMonth>12)
            {
            $nextMonth="01";
            $toyear++;
            }
        else if($nextMonth<10)
            $nextMonth = "0".$nextMonth;
        global $dateFrom;
        $dateFrom = $year."-".$month."-01";
        global $dateTo;
        $dateTo = $toyear."-".$nextMonth."-01";
    }

    function getDatefromToByCurrent(){
        $currentDate = date('Y-m-d');
        $currentMonth = substr($currentDate,5,2);
        $nextMonth = $currentMonth+1;
        $year = substr($currentDate,0,4);
        if($nextMonth>12)
            {
            $nextMonth="01";
            $year++;
            }
        else if($nextMonth<10)
            $nextMonth = "0".$nextMonth;
        global $dateFrom;
        global $dateTo;
        $dateFrom = substr($currentDate,0,7)."-01";
        $dateTo = $year."-".$nextMonth."-01";
    }
    function getIsInChinaByMemberId($memberId){
        global $wpdb;
        $result = $wpdb->get_results("SELECT isInChina FROM Teacher_infor WHERE Member=$memberId");
        return $result[0]->isInChina;   
    }

    function getCreditChangeByMemberID($memberID)
    {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT CreditChange FROM Melody_Admin_Actions WHERE Member = $memberID");
        if(sizeof($sum) == 0)
            return 0;
        else
        {
            $result = 0;
            for($x = 0; $x < sizeof($sum); $x++){
            $result = $result + $sum[$x]->CreditChange;
            }
            return $result;
        }
    }

    function getGradePropSGByCredit($credit)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Grade_Major_Prop_SG FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit <= $credit");
        return $results[sizeof($results)-1]->Grade_Major_Prop_SG;
    }

    function getCreditEarnedWithRefByMemberID($memberID)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT *, IFNULL(Melody_performance.dDate,\"\") AS FinalDate, IFNULL(Melody_performance.Member, \"\") AS FinalMember
        FROM `Melody_performance`
        LEFT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
        UNION
        SELECT *, IFNULL(Melody_Referring_Performance.dDate, \"\") AS FinalDate, IFNULL(Melody_Referring_Performance.Member, \"\") AS FinalMember
        FROM `Melody_performance`
        RIGHT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
        ORDER BY FinalDate ASC");


        $map = array();
        $prop = getGradePropSGByCredit(0);
        for($x = 0; $x < sizeof($results); $x++){
            if(!is_null($results[$x]->Item_no))
            {
                //sell performance
                $sublist = getBelowTeacherListFromName(getNameByMemberID($results[$x]->FinalMember));
                $currentSum =0;
                for($y = 0; $y < sizeof($sublist); $y++){
                    $subMemberId = getMemberIDFromName($sublist[$y]);
                    if(is_null($map[$subMemberId]))
                    {
                        $map[$subMemberId] = 0;
                    }
                    $currentSum += $map[$subMemberId];
                }
                $currentSum += $map[$results[$x]->FinalMember];
                $prop = getGradePropSGByCredit($currentSum);
                if($results[$x]->props == 0)
                {
                    $wpdb->update(Melody_performance, array('props'=>$prop), array('id' => $results[$x]->id ));
                }
                $map[$results[$x]->FinalMember] +=$results[$x]->Number * $results[$x]->PricePerItem * $prop;
                $map[$results[$x]->FinalMember] +=$results[$x]->Number * $results[$x]->RentPricePerItem * $prop;
            }
            else
            {
                $map[$results[$x]->FinalMember] += $results[$x]->Credit;
            }
        }
        return $map[$memberID];

    }

    function getReferringCreditEarnedByMemberId($memberID)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Credit FROM Melody_Referring_Performance WHERE Member = $memberID");
        $sum =0;
        for($x = 0; $x < sizeof($results); $x++){
            $sum += $results[$x]->Credit;
        }
        return $sum;
    }

    function getAllCreditIncSubByMemberId($memberID)
    {
        $belowTeacherList = getBelowTeacherListFromName(getNameByMemberID($memberID));
        $CreditEarnedBysubMember = 0;
        for($x = 0; $x < sizeof($belowTeacherList); $x++)
        {
            $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
            $CreditEarnedBysubMember += getCreditEarnedWithRefByMemberID($subMemberID);
        }
        $total = $CreditEarnedBysubMember + getCreditEarnedWithRefByMemberID($memberID);
        return $total;
    }

    function getGradeNameSGByCredit($credit)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Grade_Name FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit <= $credit");
        return $result[sizeof($result)-1]->Grade_Name;
    }

    function getAllTeacherMemberID(){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Member FROM Teacher_infor ");
        $mList;
        $size = sizeof($result);
        for($x = 0; $x < $size; $x++){
            $mList[$x] = $result[$x]->Member;
        }
        return $mList;
    }

    function getIsAGroupByMemberId($memberId){
        global $wpdb;
        $result = $wpdb->get_results("SELECT isAGroup FROM Teacher_infor WHERE Member=$memberId");
        return $result[0]->isAGroup;
    }

    function insertAdminActionByMemberIdAndCreditChange($memberID, $creditChange)
    {
        global $wpdb;
        $result = $wpdb->insert('Melody_Admin_Actions', 
        array(
            "Member" => $memberID,
            "CreditChange" => $creditChange,
            "Date" => date('Y-m-d')
        )
        );
        return $result;
    }

    function alertWithHistoryBack($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
        echo "<script type='text/javascript'>window.history.back();</script>";
    }

    function getAllPerformanceInfoByMemberID($memberId)
    {
      global $wpdb;
      $results = $wpdb->get_results("SELECT Melody_performance.dDate, Melody_items_New.Product_Or_Size_SG, Melody_items_New.Model_SG, Melody_performance.Number, Melody_performance.PricePerItem, Melody_performance.RentPricePerItem, Melody_performance.props FROM Melody_performance INNER JOIN Melody_items_New ON Melody_items_New.Item_no=Melody_performance.Item_no WHERE Member = $memberId ORDER BY dDate");
      return $results;
    }

    function getCreditEarnedWithoutRefByMemberID($memberID)
	{
		global $wpdb;
		$results = $wpdb->get_results("SELECT *, IFNULL(Melody_performance.dDate,\"\") AS FinalDate, IFNULL(Melody_performance.Member, \"\") AS FinalMember
		FROM `Melody_performance`
		LEFT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
		UNION
		SELECT *, IFNULL(Melody_Referring_Performance.dDate, \"\") AS FinalDate, IFNULL(Melody_Referring_Performance.Member, \"\") AS FinalMember
		FROM `Melody_performance`
		RIGHT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
		ORDER BY FinalDate ASC");
	

		$map = array();
		$submap = array();
		$prop = getGradePropSGByCredit(0);
		for($x = 0; $x < sizeof($results); $x++){
			if(!is_null($results[$x]->Item_no))
			{
				//sell performance
				$sublist = getBelowTeacherListFromName(getNameByMemberID($results[$x]->FinalMember));
				$currentSum =0;
				for($y = 0; $y < sizeof($sublist); $y++){
					$subMemberId = getMemberIDFromName($sublist[$y]);
					if(is_null($map[$subMemberId]))
					{
						$map[$subMemberId] = 0;
					}
					$currentSum += $map[$subMemberId];
				}
				$currentSum += $map[$results[$x]->FinalMember];
				$prop = getGradePropSGByCredit($currentSum);
				if($results[$x]->props == 0)
				{
					$wpdb->update(Melody_performance, array('props'=>$prop), array('id' => $results[$x]->id ));
				}
				$map[$results[$x]->FinalMember] += $results[$x]->Number * $results[$x]->PricePerItem * $prop;
				$submap[$results[$x]->FinalMember] += $results[$x]->Number * $results[$x]->PricePerItem * $prop;
				$map[$results[$x]->FinalMember] += $results[$x]->Number * $results[$x]->RentPricePerItem * $prop;
				$submap[$results[$x]->FinalMember] += $results[$x]->Number * $results[$x]->RentPricePerItem * $prop;
			}
			else
			{
				$map[$results[$x]->FinalMember] += $results[$x]->Credit;
			}
		}
		return $submap[$memberID];

	}

    function getRefereeListByMemberId($memberID)
	{
		global $wpdb;
		$results = $wpdb->get_results("SELECT Referee, dDate, Credit FROM Melody_Referring_Performance WHERE Member = $memberID");
		return $results;
    }
    
    function getDatefromByMonth($yyyymm){
        $month = substr($yyyymm, -2);
        $year = substr($yyyymm,0, 4);
        global $dateFrom;
        $dateFrom = $year."-".$month."-01";
    }

    function getDatefromByCurrentYear(){
        $currentDate = date('Y-m-d');
        $currentYear = substr($currentDate,0,4);
        global $dateFrom;
        $dateFrom = $currentYear."-01-01";
    }

    function getDateToByCurrentMonth(){
        $currentDate = date('Y-m-d');
        global $dateTo;
        $dateTo = $currentDate;
    }

    function getCreditChangeByMemberIDANDDateFromANDDateTo($memberID, $dateFrom, $dateTo)
    {
      global $wpdb;
      $sum = $wpdb->get_results("SELECT CreditChange FROM Melody_Admin_Actions WHERE Member = $memberID AND dDate >= \"$dateFrom\" AND dDate< \"$dateTo\"");
      $result = 0;
      for($x = 0; $x < sizeof($sum); $x++){
        $result = $result + $sum[$x]->CreditChange;
      }
      return $result;
    }

    function getAllCreditFromSubByMemberId($memberID)
    {
      $belowTeacherList = getBelowTeacherListFromName(getNameByMemberID($memberID));
      $CreditEarnedBysubMember = 0;
      for($x = 0; $x < sizeof($belowTeacherList); $x++)
      {
        $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
        $CreditEarnedBysubMember += getCreditEarnedWithRefByMemberID($subMemberID);
      }
      return $CreditEarnedBysubMember;
    }

    function getBalanceByMemberId($memberID)
    {
      return getAllCreditIncSubByMemberId($memberID) + getCreditChangeByMemberID($memberID);
    }

    function getCreditEarnedWithRefByMemberIDANDDateTo($memberID, $dateTo)
    {
      global $wpdb;
      $results = $wpdb->get_results("SELECT *, IFNULL(Melody_performance.dDate,\"\") AS FinalDate, IFNULL(Melody_performance.Member, \"\") AS FinalMember
      FROM `Melody_performance`
      LEFT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
      HAVING FinalDate < \"$dateTo\"
      UNION
      SELECT *, IFNULL(Melody_Referring_Performance.dDate, \"\") AS FinalDate, IFNULL(Melody_Referring_Performance.Member, \"\") AS FinalMember
      FROM `Melody_performance`
      RIGHT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
      HAVING FinalDate < \"$dateTo\"
      ORDER BY FinalDate ASC");

      $map = array();
      $prop = getGradePropSGByCredit(0);
      for($x = 0; $x < sizeof($results); $x++){
        if(!is_null($results[$x]->Item_no))
        {
          //sell performance
          $sublist = getBelowTeacherListFromName(getNameByMemberID($results[$x]->FinalMember));
          $currentSum =0;
          for($y = 0; $y < sizeof($sublist); $y++){
            $subMemberId = getMemberIDFromName($sublist[$y]);
            if(is_null($map[$subMemberId]))
            {
              $map[$subMemberId] = 0;
            }
            $currentSum += $map[$subMemberId];
          }
          $currentSum += $map[$results[$x]->FinalMember];
          $prop = getGradePropSGByCredit($currentSum);
          $map[$results[$x]->FinalMember] +=$results[$x]->Number * $results[$x]->PricePerItem * $prop;
          $map[$results[$x]->FinalMember] +=$results[$x]->Number * $results[$x]->RentPricePerItem * $prop;

        }
        else
        {
          $map[$results[$x]->FinalMember] += $results[$x]->Credit;
        }
      }
      return $map[$memberID];
    }

    function getAllCreditIncSubByMemberIdANDDateTo($memberID, $dateTo)
    {
      $belowTeacherList = getBelowTeacherListFromName(getNameByMemberID($memberID));
      $CreditEarnedBysubMember = 0;
      for($x = 0; $x < sizeof($belowTeacherList); $x++)
      {
        $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
        $CreditEarnedBysubMember += getCreditEarnedWithRefByMemberIDANDDateTo($subMemberID, $dateTo);
      }
      $total = $CreditEarnedBysubMember + getCreditEarnedWithRefByMemberIDANDDateTo($memberID, $dateTo);
      return $total;
    }


?>