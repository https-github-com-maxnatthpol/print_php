<?php
header('Access-Control-Allow-Origin: *');

if (isset($_POST['print'])) {
	if ($_POST['print'] == "printslip_return_card") {
		printslip_return_card();
		exit;
	} elseif ($_POST['print'] == "printslip_buy_card") {
		printslip_buy_card();
		exit;
	} elseif ($_POST['print'] == "printslip_return_customer_his") {
		printslip_return_customer_his();
		exit;
	}
}

function printslip_buy_card()
{
	date_default_timezone_set("Asia/Bangkok");
	//data
	$date_regdate = date("Y-m-d H:i:s");
	$amount_f = $_POST["amount_f"];
	$receive_money = $_POST["receive_money"];
	$SESSION_name = $_POST["SESSION_name"];

  $printer = '\\\\'.$_POST["ip"].'\\'.$_POST["printname"];
  if($handle = printer_open($printer)){

      printer_set_option($handle, PRINTER_COPIES, 1);
      printer_set_option($handle, PRINTER_MODE, 'text');
      printer_set_option($handle, PRINTER_TITLE, 'printslip_buy_card');
      printer_set_option($handle, PRINTER_SCALE, 100);
      printer_set_option($handle, PRINTER_ORIENTATION, PRINTER_ORIENTATION_PORTRAIT);
      printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_A4);

      printer_set_option($handle, PRINTER_TEXT_ALIGN, PRINTER_TA_LEFT);

      printer_start_doc($handle, "printslip_buy_card");
      printer_start_page($handle);

      $font = printer_create_font("TH Sarabun New", dpimm2px(2.3), dpimm2px(0), PRINTER_FW_BOLD, false, false, false, 0);
      printer_select_font($handle, $font);
      $text = "ใบเสร็จรับเงิน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(5.1), dpimm2px(7));
      $text = "ศูนย์อาหาร สโมสร กก. ตชด 22";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(1), dpimm2px(9));
      $text = "ผู้รับเงิน : ".$SESSION_name;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(13));
			$text = "เวลา : ".$date_regdate;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(15));

      $text = "---------------------------------------------------";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(17));

			$text = "จำนวนเงิน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(19));
			$text = "B".number_format($amount_f, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(19));
			$text = "เงินที่ได้รับ";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(21));
			$text = "B".number_format($receive_money, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(21));
			$text = "เงินทอน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(23));
			$text = "B".number_format($receive_money-$amount_f, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(23));
			$text = "---------------------------------------------------";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(25));

			$text = "ขอบคุณที่ใช้บริการ";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(29));
			$text = "สโมสร กก. ตชด 22";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(31));

			$text = "-";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(35));


      printer_delete_font($font);

      printer_end_page($handle);
      printer_end_doc($handle);
      printer_close($handle);
  }else{
      echo "Connot connect to: ".$printer;
  }
}

function printslip_return_card()
{
	date_default_timezone_set("Asia/Bangkok");
	//data
	$date_regdate = date("Y-m-d H:i:s");
	$amount_r = $_POST["amount_r"];
	$SESSION_name = $_POST["SESSION_name"];

  $printer = '\\\\'.$_POST["ip"].'\\'.$_POST["printname"];
  if($handle = printer_open($printer)){

      printer_set_option($handle, PRINTER_COPIES, 1);
      printer_set_option($handle, PRINTER_MODE, 'text');
      printer_set_option($handle, PRINTER_TITLE, 'printslip_buy_card');
      printer_set_option($handle, PRINTER_SCALE, 100);
      printer_set_option($handle, PRINTER_ORIENTATION, PRINTER_ORIENTATION_PORTRAIT);
      printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_A4);

      printer_set_option($handle, PRINTER_TEXT_ALIGN, PRINTER_TA_LEFT);

      printer_start_doc($handle, "printslip_buy_card");
      printer_start_page($handle);

      $font = printer_create_font("TH Sarabun New", dpimm2px(2.3), dpimm2px(0), PRINTER_FW_BOLD, false, false, false, 0);
      printer_select_font($handle, $font);
      $text = "ใบเสร็จคืนเงิน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(5.1), dpimm2px(7));
      $text = "ศูนย์อาหาร สโมสร กก. ตชด 22";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(1), dpimm2px(9));
      $text = "ผู้คืนเงิน : ".$SESSION_name;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(13));
			$text = "เวลา : ".$date_regdate;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(15));

      $text = "---------------------------------------------------";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(17));

			$text = "จำนวนเงินที่คืน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(19));
			$text = "B".number_format($amount_r, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(19));

			$text = "---------------------------------------------------";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(21));

			$text = "ขอบคุณที่ใช้บริการ";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(25));
			$text = "สโมสร กก. ตชด 22";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(27));

			$text = "-";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(31));


      printer_delete_font($font);

      printer_end_page($handle);
      printer_end_doc($handle);
      printer_close($handle);
  }else{
      echo "Connot connect to: ".$printer;
  }
}

function printslip_return_customer_his()
{
	date_default_timezone_set("Asia/Bangkok");
	//data
	$date_regdate = date("Y-m-d H:i:s");
	$amount_f = 555;
	$receive_money = 5555;
	$SESSION_name = 5555;

  $printer = '\\\\'.$_POST["ip"].'\\'.$_POST["printname"];
  if($handle = printer_open($printer)){

      printer_set_option($handle, PRINTER_COPIES, 1);
      printer_set_option($handle, PRINTER_MODE, 'text');
      printer_set_option($handle, PRINTER_TITLE, 'printslip_buy_card');
      printer_set_option($handle, PRINTER_SCALE, 100);
      printer_set_option($handle, PRINTER_ORIENTATION, PRINTER_ORIENTATION_PORTRAIT);
      printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_A4);

      printer_set_option($handle, PRINTER_TEXT_ALIGN, PRINTER_TA_LEFT);

      printer_start_doc($handle, "printslip_buy_card");
      printer_start_page($handle);

      $font = printer_create_font("TH Sarabun New", dpimm2px(2.3), dpimm2px(0), PRINTER_FW_BOLD, false, false, false, 0);
      printer_select_font($handle, $font);
      $text = "ใบเสร็จรับเงิน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(5.1), dpimm2px(7));
      $text = "ศูนย์อาหาร สโมสร กก. ตชด 22";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(1), dpimm2px(9));
      $text = "ผู้รับเงิน : ".$SESSION_name;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(13));
			$text = "เวลา : ".$date_regdate;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(15));

      $text = "---------------------------------------------------";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(17));

			$text = "จำนวนเงิน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(19));
			$text = "B".number_format($amount_f, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(19));
			$text = "เงินที่ได้รับ";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(21));
			$text = "B".number_format($receive_money, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(21));
			$text = "เงินทอน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(23));
			$text = "B".number_format($receive_money-$amount_f, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(23));
			$text = "---------------------------------------------------";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(25));

			$text = "ขอบคุณที่ใช้บริการ";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(29));
			$text = "สโมสร กก. ตชด 22";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(31));

			$text = "-";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(35));


      printer_delete_font($font);

      printer_end_page($handle);
      printer_end_doc($handle);
      printer_close($handle);
  }else{
      echo "Connot connect to: ".$printer;
  }
}

function dpimm2px($val,$dpi=600){
    return ((($dpi*0.393701)/10)*$val);
}
?>
