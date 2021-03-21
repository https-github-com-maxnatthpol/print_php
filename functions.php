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
	$number = str_pad($_GET["number"], 4, "0", STR_PAD_LEFT);
	$ref = substr($_GET["ref"], 0 ,4);
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
      $text = "ใบเสร็จซื้อบัตร / เติมเงิน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(2.5), dpimm2px(7));
      $text = "ศูนย์อาหาร สโมสร กก. ตชด 22";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(1), dpimm2px(9));
      $text = "ผู้ออก : ".$SESSION_name;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(13));
			$text = "รหัสอ้างอิง : ".$ref;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(15));
			$text = "เวลา : ".$date_regdate;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(17));

      $text = "---------------------------------------------------";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(19));

			$text = "เลขบัตร";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(21));
			$text = $number;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(21));
			$text = "จำนวนเงิน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(25));
			$text = "B".number_format($amount_f, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(25));
			$text = "เงินที่ได้รับ";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(27));
			$text = "B".number_format($receive_money, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(27));
			$text = "เงินทอน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(29));
			$text = "B".number_format($receive_money-$amount_f, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(29));
			$text = "---------------------------------------------------";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(31));

			$text = "ขอบคุณที่ใช้บริการ";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(35));
			$text = "สโมสร กก. ตชด 22";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(37));

			$text = "-";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(41));


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

	$number = str_pad($_GET["number"], 4, "0", STR_PAD_LEFT);
	$ref = substr($_GET["ref"], 0 ,4);

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
      $text = "ใบเสร็จคืนบัตร";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(5.1), dpimm2px(7));
			$text = "ศูนย์อาหาร สโมสร กก. ตชด 22";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(1), dpimm2px(9));
      $text = "ผู้ออก : ".$SESSION_name;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(13));
			$text = "รหัสอ้างอิง : ".$ref;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(15));
			$text = "เวลา : ".$date_regdate;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(17));

			$text = "---------------------------------------------------";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(19));

			$text = "เลขบัตร";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(21));
			$text = $number;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(21));

			$text = "จำนวนเงินที่คืน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(25));
			$text = "B".number_format($amount_r, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(25));

			$text = "---------------------------------------------------";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(27));

			$text = "ขอบคุณที่ใช้บริการ";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(31));
			$text = "สโมสร กก. ตชด 22";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(33));

			$text = "-";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(37));


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
	$date_regdate  = date("Y-m-d H:i:s");
	$balance       = $_POST['balance'];
	$total_card_s  = $_POST["total_card_s"];
	$name_shop     = $_POST["name_shop"];
    $ref_p = substr($_GET["ref_p"], 0 ,4);
    $card_code = str_pad($_POST["card_code"], 4, "0", STR_PAD_LEFT);

  $printer = '\\\\'.$_POST["ip"].'\\'.$_POST["printname"];
  if($handle = printer_open($printer)){

      printer_set_option($handle, PRINTER_COPIES, 1);
      printer_set_option($handle, PRINTER_MODE, 'text');
      printer_set_option($handle, PRINTER_TITLE, 'printslip_return_customer_his');
      printer_set_option($handle, PRINTER_SCALE, 100);
      printer_set_option($handle, PRINTER_ORIENTATION, PRINTER_ORIENTATION_PORTRAIT);
      printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_A4);

      printer_set_option($handle, PRINTER_TEXT_ALIGN, PRINTER_TA_LEFT);

      printer_start_doc($handle, "printslip_return_customer_his");
      printer_start_page($handle);

      $font = printer_create_font("TH Sarabun New", dpimm2px(2.3), dpimm2px(0), PRINTER_FW_BOLD, false, false, false, 0);
      printer_select_font($handle, $font);
      $text = "ใบเสร็จรับเงิน";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(5.1), dpimm2px(7));
      $text = "ศูนย์อาหาร สโมสร กก. ตชด 22";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(1), dpimm2px(9));
      $text = "ผู้ออก : ".$name_shop;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(13));
      $text = "รหัสอ้างอิง : ".$ref_p;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(15));
      $text = "เวลา : ".$date_regdate;
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(17));

      $text = "---------------------------------------------------";
      $text = iconv("UTF-8","TIS-620",$text);
      
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(19));
        $text = "เลขบัตร";
      $text = iconv("UTF-8","TIS-620",$text);
      
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(21));
			$text = $card_code;
      $text = iconv("UTF-8","TIS-620",$text);
      
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(25));
			$text = "ยอดเงินบัตร";
      $text = iconv("UTF-8","TIS-620",$text);
      
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(27));
			$text = "฿".number_format($total_card_s, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(27));
			$text = "ยอดที่ชำระ";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(29));
			$text = "฿".number_format($balance, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(29));
			$text = "ยอดคงเหลือ";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(31));
			$text = "฿".number_format($total_card_s-$balance, 2, '.', '');
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(11), dpimm2px(31));
			$text = "---------------------------------------------------";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(33));

			$text = "ขอบคุณที่ใช้บริการ";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(37));
			$text = "สโมสร กก. ตชด 22";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(4.1), dpimm2px(39));

			$text = "-";
			$text = iconv("UTF-8","TIS-620",$text);
			printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(43));


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
