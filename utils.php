<?php
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    function getPasswordByMemberID($memberID){
        global $wpdb;
        $result = $wpdb->get_results( "SELECT Password FROM Teacher_infor WHERE Member=".$memberID);
        return $result[0]->Password;
    }

    function getPasswordByMemberEmail($memberEmail){
        global $wpdb;
        $result = $wpdb->get_results( "SELECT Password FROM Teacher_infor WHERE Email=\"$memberEmail\"");
        if(sizeof($result)>1)
        {
            alert("there are more than one records about your email in our system, please contact system admin");
        }
        return $result[0]->Password;

    }

    function getMemberIdByMemberEmail($memberEmail){
        global $wpdb;
        $result = $wpdb->get_results( "SELECT Member FROM Teacher_infor WHERE Email=\"$memberEmail\"");
        return $result[0]->Member;
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
        $sum = $wpdb->get_results("SELECT qty FROM Melody_performance WHERE Member =$memberID AND Item_no=$item_no");


        if(sizeof($sum)==0)
            return 0;
        else
        {
            $result;
            for($x=0;$x<sizeof($sum);$x++){
                $result = $result+ $sum[$x]->qty;

            }
            return $result;
        }
    }

    function getNumOfItemByItemIDAndMemeberIDAndDate($memberID, $item_no, $dateFrom)
    {
        global $wpdb;

        $sum = $wpdb->get_results("SELECT qty FROM Melody_performance WHERE Member =$memberID AND Item_no=$item_no AND dDate >=\" $dateFrom \"");

        if(sizeof($sum)==0)
            return 0;
        else
        {
            $result;
            for($x=0;$x<sizeof($sum);$x++){
            $result = $result+ $sum[$x]->qty;

            }
            return $result;
        }
    }

    function getBelowTeacherListFromMemberId($MemberID){
        global $wpdb;
        $result = $wpdb->get_results( "SELECT Name FROM Teacher_infor WHERE MajorID=$MemberID");

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

    function getBonusCreditChangeByMemberID($memberID)
    {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT CreditChange FROM Melody_Admin_Actions WHERE Member = $memberID");
        $result = 0;
        for($x = 0; $x < sizeof($sum); $x++){
            if($sum[$x]->CreditChange > 0)
            {
                $result = $result + $sum[$x]->CreditChange;
            }
        }
        return $result;
    }

    function getRedeemedCreditChangeByMemberID($memberID)
    {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT CreditChange FROM Melody_Admin_Actions WHERE Member = $memberID");
        $result = 0;
        for($x = 0; $x < sizeof($sum); $x++){
            if($sum[$x]->CreditChange < 0)
            {
                $result = $result + $sum[$x]->CreditChange;
            }
        }
        return $result;
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
        $results = $wpdb->get_results("SELECT Grade_Major_Prop FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit_SG <= $credit");
        return $results[sizeof($results)-1]->Grade_Major_Prop;
    }

    function getGradePropCNByCredit($credit)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Grade_Major_Prop FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit_CN <= $credit");
        return $results[sizeof($results)-1]->Grade_Major_Prop;
    }

    function getCreditEarnedWithRefSGByMemberID($memberID)
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
                $sublist = getBelowTeacherListFromMemberId($results[$x]->FinalMember);
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
                if($results[$x]->props != $prop)
                {
                    $wpdb->update(Melody_performance, array('props'=>$prop), array('id' => $results[$x]->id ));
                }
                $map[$results[$x]->FinalMember] +=$results[$x]->qty * $results[$x]->PricePerItem * $prop;
                $map[$results[$x]->FinalMember] +=$results[$x]->qty * $results[$x]->RentPricePerItem * $prop;
            }
            else
            {
                $map[$results[$x]->FinalMember] += $results[$x]->Credit;
            }
        }
        return $map[$memberID];

    }

    function getCreditEarnedWithRefCNByMemberID($memberID)
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
        $prop = getGradePropCNByCredit(0);
        for($x = 0; $x < sizeof($results); $x++){
            if(!is_null($results[$x]->Item_no))
            {
                //sell performance
                $sublist = getBelowTeacherListFromMemberId($results[$x]->FinalMember);
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
                $prop = getGradePropCNByCredit($currentSum);
                if($results[$x]->props != $prop)
                {
                    $wpdb->update(Melody_performance, array('props'=>$prop), array('id' => $results[$x]->id ));
                }
                $map[$results[$x]->FinalMember] +=$results[$x]->qty * $results[$x]->PricePerItem * $prop;
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

    function getAllCreditIncSubSGByMemberId($memberID)
    {
        $belowTeacherList = getBelowTeacherListFromMemberId($memberID);
        $CreditEarnedBysubMember = 0;
        for($x = 0; $x < sizeof($belowTeacherList); $x++)
        {
            $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
            $CreditEarnedBysubMember += getCreditEarnedWithRefSGByMemberID($subMemberID);
        }
        $total = $CreditEarnedBysubMember + getCreditEarnedWithRefSGByMemberID($memberID);
        return $total;
    }
    function getAllCreditIncSubCNByMemberId($memberID)
    {
        $belowTeacherList = getBelowTeacherListFromMemberId($memberID);
        $CreditEarnedBysubMember = 0;
        for($x = 0; $x < sizeof($belowTeacherList); $x++)
        {
            $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
            $CreditEarnedBysubMember += getCreditEarnedWithRefCNByMemberID($subMemberID);
        }
        $total = $CreditEarnedBysubMember + getCreditEarnedWithRefCNByMemberID($memberID);
        return $total;
    }

    function getGradeNameSGByCredit($credit)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Grade_Name_SG FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit_SG <= $credit");
        return $result[sizeof($result)-1]->Grade_Name_SG;
    }

    function getGradeNameCNByCredit($credit)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Grade_Name_CN FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit_CN <= $credit");
        return $result[sizeof($result)-1]->Grade_Name_CN;
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
            "dDate" => date('Y-m-d')
        )
        );
        return $result;
    }

    function alertWithHistoryBack($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
        echo "<script type='text/javascript'>window.history.back();</script>";
    }

    function getAllPerformanceInfoSGByMemberID($memberId)
    {
      global $wpdb;
      $results = $wpdb->get_results("SELECT Melody_performance.dDate, Melody_items_New.Product_Or_Size_SG, Melody_performance.qty, Melody_performance.PricePerItem, Melody_performance.RentPricePerItem, Melody_performance.props FROM Melody_performance INNER JOIN Melody_items_New ON Melody_items_New.Item_no=Melody_performance.Item_no WHERE Member = $memberId ORDER BY dDate");
      return $results;
    }

    function getAllPerformanceInfoCNByMemberID($memberId)
    {
      global $wpdb;
      $results = $wpdb->get_results("SELECT Melody_performance.dDate, Melody_items_New.Product_Or_Size_CN, Melody_performance.qty, Melody_performance.PricePerItem, Melody_performance.RentPricePerItem, Melody_performance.props FROM Melody_performance INNER JOIN Melody_items_New ON Melody_items_New.Item_no=Melody_performance.Item_no WHERE Member = $memberId ORDER BY dDate");
      return $results;
    }

    function getCreditEarnedWithoutRefSGByMemberID($memberID)
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
				$sublist = getBelowTeacherListFromMemberId($results[$x]->FinalMember);
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
				if($results[$x]->props != $prop)
				{
					$wpdb->update(Melody_performance, array('props'=>$prop), array('id' => $results[$x]->id ));
				}
				$map[$results[$x]->FinalMember] += $results[$x]->qty * $results[$x]->PricePerItem * $prop;
				$submap[$results[$x]->FinalMember] += $results[$x]->qty * $results[$x]->PricePerItem * $prop;
				$map[$results[$x]->FinalMember] += $results[$x]->qty * $results[$x]->RentPricePerItem * $prop;
				$submap[$results[$x]->FinalMember] += $results[$x]->qty * $results[$x]->RentPricePerItem * $prop;
			}
			else
			{
				$map[$results[$x]->FinalMember] += $results[$x]->Credit;
			}
        }
        if(is_null($submap[$memberID]))
        {
            $submap[$memberID] = 0;
        }
		return $submap[$memberID];

    }

    function getCreditEarnedWithoutRefCNByMemberID($memberID)
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
		$prop = getGradePropCNByCredit(0);
		for($x = 0; $x < sizeof($results); $x++){
			if(!is_null($results[$x]->Item_no))
			{
				//sell performance
				$sublist = getBelowTeacherListFromMemberId($results[$x]->FinalMember);
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
				$prop = getGradePropCNByCredit($currentSum);
				if($results[$x]->props != $prop)
				{
					$wpdb->update(Melody_performance, array('props'=>$prop), array('id' => $results[$x]->id ));
				}
				$map[$results[$x]->FinalMember] += $results[$x]->qty * $results[$x]->PricePerItem * $prop;
				$submap[$results[$x]->FinalMember] += $results[$x]->qty * $results[$x]->PricePerItem * $prop;
			}
			else
			{
				$map[$results[$x]->FinalMember] += $results[$x]->Credit;
			}
        }
        if(is_null($submap[$memberID]))
        {
            $submap[$memberID] = 0;
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

    function getTomorrowDate(){
        $dateTime = new DateTime('tomorrow');
        return $dateTime->format('Y-m-d');
    }

    function getNextMonthFirstDate(){
        $currentDate = date('Y-m-d');
        $currentYear = substr($currentDate,0,4);
        $currentMonth = substr($currentDate,5,7);
        $currentMonth = $currentMonth+1;
        if($currentMonth>12)
            $currentMonth = 1;
        return $currentYear."-".sprintf("%02d", $currentMonth)."-01";
    }

    function getRedeemedCreditChangeByMemberIDANDDateFromANDDateTo($memberID, $dateFrom, $dateTo)
    {
      global $wpdb;
      $sum = $wpdb->get_results("SELECT CreditChange FROM Melody_Admin_Actions WHERE Member = $memberID AND dDate >= \"$dateFrom\" AND dDate< \"$dateTo\"");
      $result = 0;
      for($x = 0; $x < sizeof($sum); $x++){
          if($sum[$x]->CreditChange<0)
          {
            $result = $result + $sum[$x]->CreditChange;
          }
      }
      return $result;
    }

    function getBonusCreditChangeByMemberIDANDDateFromANDDateTo($memberID, $dateFrom, $dateTo)
    {
      global $wpdb;
      $sum = $wpdb->get_results("SELECT CreditChange FROM Melody_Admin_Actions WHERE Member = $memberID AND dDate >= \"$dateFrom\" AND dDate< \"$dateTo\"");
      $result = 0;
      for($x = 0; $x < sizeof($sum); $x++){
          if($sum[$x]->CreditChange>0)
          {
            $result = $result + $sum[$x]->CreditChange;
          }
      }
      return $result;
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

    function getAllCreditFromSubSGByMemberId($memberID)
    {
      $belowTeacherList = getBelowTeacherListFromMemberId($memberID);
      $CreditEarnedBysubMember = 0;
      for($x = 0; $x < sizeof($belowTeacherList); $x++)
      {
        $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
        $CreditEarnedBysubMember += getCreditEarnedWithRefSGByMemberID($subMemberID);
      }
      return $CreditEarnedBysubMember;
    }

    function getAllCreditFromSubCNByMemberId($memberID)
    {
      $belowTeacherList = getBelowTeacherListFromMemberId($memberID);
      $CreditEarnedBysubMember = 0;
      for($x = 0; $x < sizeof($belowTeacherList); $x++)
      {
        $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
        $CreditEarnedBysubMember += getCreditEarnedWithRefCNByMemberID($subMemberID);
      }
      return $CreditEarnedBysubMember;
    }

    function getBalanceSGByMemberId($memberID)
    {
      return getAllCreditIncSubSGByMemberId($memberID) + getCreditChangeByMemberID($memberID);
    }

    function getBalanceCNByMemberId($memberID)
    {
      return getAllCreditIncSubCNByMemberId($memberID) + getCreditChangeByMemberID($memberID);
    }

    function getCreditEarnedWithRefSGByMemberIDANDDateTo($memberID, $dateTo)
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
          $sublist = getBelowTeacherListFromMemberId($results[$x]->FinalMember);
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
          $map[$results[$x]->FinalMember] +=$results[$x]->qty * $results[$x]->PricePerItem * $prop;
          $map[$results[$x]->FinalMember] +=$results[$x]->qty * $results[$x]->RentPricePerItem * $prop;

        }
        else
        {
          $map[$results[$x]->FinalMember] += $results[$x]->Credit;
        }
      }
      return $map[$memberID];
    }

    function getCreditEarnedWithRefCNByMemberIDANDDateTo($memberID, $dateTo)
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
      $prop = getGradePropCNByCredit(0);
      for($x = 0; $x < sizeof($results); $x++){
        if(!is_null($results[$x]->Item_no))
        {
          //sell performance
          $sublist = getBelowTeacherListFromMemberId($results[$x]->FinalMember);
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
          $prop = getGradePropCNByCredit($currentSum);
          $map[$results[$x]->FinalMember] +=$results[$x]->qty * $results[$x]->PricePerItem * $prop;

        }
        else
        {
          $map[$results[$x]->FinalMember] += $results[$x]->Credit;
        }
      }
      return $map[$memberID];
    }

    function getAllCreditIncSubSGByMemberIdANDDateTo($memberID, $dateTo)
    {
      $belowTeacherList = getBelowTeacherListFromMemberId($memberID);
      $CreditEarnedBysubMember = 0;
      for($x = 0; $x < sizeof($belowTeacherList); $x++)
      {
        $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
        $CreditEarnedBysubMember += getCreditEarnedWithRefSGByMemberIDANDDateTo($subMemberID, $dateTo);
      }
      $total = $CreditEarnedBysubMember + getCreditEarnedWithRefSGByMemberIDANDDateTo($memberID, $dateTo);
      return $total;
    }

    function getAllCreditIncSubCNByMemberIdANDDateTo($memberID, $dateTo)
    {
      $belowTeacherList = getBelowTeacherListFromMemberId($memberID);
      $CreditEarnedBysubMember = 0;
      for($x = 0; $x < sizeof($belowTeacherList); $x++)
      {
        $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
        $CreditEarnedBysubMember += getCreditEarnedWithRefCNByMemberIDANDDateTo($subMemberID, $dateTo);
      }
      $total = $CreditEarnedBysubMember + getCreditEarnedWithRefCNByMemberIDANDDateTo($memberID, $dateTo);
      return $total;
    }

    function updateEmailByMID($Mid, $email)
    {
        global $wpdb;
        $wpdb->update(Teacher_infor, array('Email' => $email), array('Member' =>$Mid));
    }

    function updatePasswordByMID($Mid, $password)
    {
        global $wpdb;
        $wpdb->update(Teacher_infor, array('Password' => $password), array('Member' => $Mid));
    }

    function updateContactNoByMID($Mid, $Contact_no)
    {
        global $wpdb;
        $wpdb->update(Teacher_infor, array('Contact_no' => $Contact_no), array('Member' => $Mid));
    }

    function sendEmail($subject, $emailList, $message, $isHTML)
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

    function getEmailByMid($MId){
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Email FROM `Teacher_infor` WHERE Member = $MId");
        return $sum[0]->Email;
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

    function kickOutCNUserbyMemberId($memberId)
    {
        if(getIsInChinaByMemberId($memberId) == 1)
        {
            header("Location:http://www.melodysac.com.sg/index.php/zh/melodymemberlogin/");
        }
    }

    function kickOutSGUserbyMemberId($memberId)
    {
        if(getIsInChinaByMemberId($memberId) == 0)
        {
            header("Location:http://www.melodysac.com.sg/index.php/zh/melodymemberlogin/");
        }
    }

    function getMembershipFormByMemberId($memberId)
    {
      $contract;
        //individual
        if(getIsAGroupByMemberId($memberId) == 0)
        {
          //sg
          if(getIsInChinaByMemberId($memberId) == 0)
          {
            $contract = get_template_directory_uri() . "/MemberInfo/" . "/MembershipWord/" . "ManLian membership form - SG个人.docx";
          }
          else{
            $contract = get_template_directory_uri() . "/MemberInfo/" . "/MembershipWord/" . "ManLian membership form - CN个人.docx";
          }
        }
        else {
          //sg
          if(getIsInChinaByMemberId($memberId) == 0)
          {
            $contract = get_template_directory_uri() . "/MemberInfo/" . "/MembershipWord/" . "ManLian membership form - SG 机构.docx";
          }
          else{
            $contract = get_template_directory_uri() . "/MemberInfo/" . "/MembershipWord/" . "ManLian membership form - CN机构.docx";
          }
        }
        return $contract;
    }

?>
