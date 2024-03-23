
<?php
/*
	calendar.class.php日曆類
	宣告一個日曆類，名稱為Calendar，用來顯示可以設定日期的日曆
 */
class Calendar{
	private $year;//當前的年
	private $month;//當前的月
	private $start_weekday;//當月的第一天對應的是周幾，作為當月遍歷日期的開始
	private $days;//當前月的總天數
	private $out;

	/**
	 * 構造方法，初始化一些屬性
	 */
	function __construct(){ 
		//如果使用者沒有設定年份數，則使用當前系統時間的年份
		$this->year = isset($_GET["year"]) ? $_GET["year"] :date("Y") ;
		//如果使用者沒有設定月份數，則使用當前系統時間的月份
		$this->month = isset($_GET["month"]) ? $_GET["month"] :date("m") ;
		//通過具體的年份和月份，利用date() 函式的w引數獲取當月第一天對應的是周幾
		$this->start_weekday = date("w",mktime(0, 0, 0, $this->month, 1, $this->year));
		//通過具體的年份和月份，利用date()函式的引數獲取當月的天數
		$this->days = date("t",mktime(0, 0, 0, $this->month, 1, $this->year));
		$out="";
	}
	/**
	 * 列印整個日曆
	 * @return string 日曆字串
	 */
	function __toString(){
        date_default_timezone_set("Asia/Taipei");
		$out="<font color=\"blue\"><a href=\"chart.php?year=$this->year&month=$this->month\" style='font-size: 18px;'class='btn btn-outline-success'>查看本月曲線圖</a></font><br><br>";
		$out .= '<table align="center">'; //日曆以表格形式列印
		$out .= $this->changeDate(); //使用者設定日期
		$out .= $this->weeksList(); //列印·周·列表
		$out .= $this->daysList(); //列印·日·列表
		$out .= '</table>'; //表格結束
		return $out; //返回整個日曆，輸出需要的全部字串 
	}
	/**
	 * 輸出周列表
	 * @return string 周列表字串
	 */
	private function weeksList(){
		$out="";
		$week = array ('日','一','二','三','四','五','六');
		$out .= '<tr>';
		for($i = 0; $i < count($week); $i++){
			$out .= '<th class="fontb">' . $week [$i]. '</th>';
		}
		$out .= '</tr>';
		return $out; // 返回周列表字串
	}
	/**
	 * 輸出日列表
	 * @return string 日曆表字串
	 */
	private function daysList(){
		$out = "";
		$out .= '<tr>';
		// 輸出空格(當月第一天對應的是周幾，就是幾個空格)
		for($j = 0; $j < $this->start_weekday; $j++){
			$out .= '<td>&nbsp;</td>';
		}
		// 迴圈輸出當前月所有日期
		$now_month=date('m');
		$now_year=date('Y');
		$now_day=date('d');
		
		for($k = 1; $k <= $this->days; $k++){
			$j++;
			
			if ($now_year < $this->year)
			{
				$out .= "<td>".$k.'</td>';
			}
			else if ($now_month < $this->month)
			{
				$out .= "<td>".$k.'</td>';
			}
			else if ($now_day < $k && $now_month == $this->month)
			{
				$out .= "<td>".$k.'</td>';
			}
			else if($now_month == $this->month && $k == date('d')){// 若為當前日期，設定為深色背景
				$out .= "<td><a href=\"weight.php?rdate=$this->year-$this->month-$k\">*".$k.'</a></td>';
			} 
			else {
				$out .= "<td><a href=\"weight.php?rdate=$this->year-$this->month-$k\">".$k.'</a></td>';
			}
			
			if($j%7 == 0){//每輸出7個日期，就換一行
				$out .= '</tr><tr>';//輸出行結束和下一行開始
			}
		}
		while ($j%7 != 0) {//遍歷完日期後，剩下的用空格補全
			$out .= '<td>&nbsp;</td>';
			$j++;
		}
		$out .= '</tr>';
		return $out; //返回當月日列表
	}
	/**
	 * 用於處理當前年份的上一年需要的資料
	 * @param  int $year  當前年份
	 * @param  int $month 當前月份
	 * @return string   最終的年份和月份設定引數
	 */
	private function prevYear($year, $month){ 
		$year = $year-1; //上一年是當前年減1
		if ($year < 1970){ //如果設至的年份小於1970年
			$year = 1970; //年份設定最小值是1970年
		}
		//返回最終的年份和月份設定引數
		return "year={$year}&month={$month}";
	}
	/**
	 * 用於處理當前月份的上一月份的資料
	 * @param  int $year  當前年份
	 * @param  int $month 當前月份
	 * @return string   最終的年份和月份設定引數
	 */
	private function prevMonth($year, $month){
		if($month== 1){
			$year = $year -1;
			if($year < 1970){ // 最小年份數不能小於1970年
				$year = 1970;
			}
			//如果月是1月，上一月就是上一年的最後一月
			$month = 12;
		} else {
			$month--; //上一月就是當前月減1
		}
		// 返回最終的年份和月份設定引數
		return "year={$year}&month={$month}";
	}
	/**
	 * 用於處理當前年份的下一年份的資料
	 * @param  int $year  當前年份
	 * @param  int $month 當前月份
	 * @return string   最終的年份和月份設定引數
	 */
	private function nextYear($year, $month){
		$year = $year+1; // 下一年是當前年加1
		if ($year> 2038){ //如果設量的年份大於2038年
			$year=2038; //最大年份不能超過2038年
		}
		//返回最終的年份和月份設定引數
		return "year={$year}&month={$month}";
	}
	/*
	 * 用於處理當前月份的下一個月份的資料
	 * @param  int $year  當前年份
	 * @param  int $month 當前月份
	 * @return string   最終的年份和月份設定引數
	 */
	private function nextMonth($year, $month){
		if($month == 12){//如果已經是當年的最後一個月
			$year++;//下一個月就是下一年的第一個月，讓年份加1
			if($year> 2038){ //如果設豆的年份大於2038年
				$year = 2038; //最大年份不能超過2038年
			}
			$month = 1; //設定月份為下一年的第一個月
		} else {
			$month++;//其他月份的下一個月都是當前月份加1即可
		}
		//返回最終的年份和月份設定引數
		return "year={$year}&month={$month}";
	}
	/**
	 * 調整日期
	 * @param  string $url 頁面路徑
	 * @return string 頁面字串
	 */
	private function changeDate($url='weightrecord.php'){
		$out="";
		$out .= '<tr>';
		//上一年
		$out .= '<td><a href="'.$url.'?'.$this->prevYear($this->year,$this->month).'">'.'<<'.'</a></td>';
		//上個月
		$out .= '<td><a href="'.$url.'?'.$this->prevMonth($this->year,$this->month).'">'.'<'.'</a> </td>';
		$out .= '<td colspan="3">';
		//年份選擇框
		$out .= $this->year."/".$this->month;
		$out .= '</td>';
		//下一年
		$out .= '<td> <a href="'.$url.'?'.$this->nextMonth($this->year,$this->month).'">'.'>'.'</a></td>';
		//下個月
		$out .= '<td> <a href="'.$url.'?'.$this->nextYear($this->year,$this->month).'">'.'>>'.'</a></td>';
		$out .= '</tr>';
		return $out; //返回調整日期的表單
	}
}
