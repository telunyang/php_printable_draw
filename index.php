<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>TennisPlayerDraw</title>
<link src="./css/style.css">
</head>
<body>
<?php
//how many players in this tennis competition
$int_player_total = 8;

//get rounds
$int_round = (int)log($int_player_total,2);

//set header
$arr_round_data = array(
		2 => array(2 => 'Final'),
		4 => array(4 => 'SF', 2 => 'Final'),
		8 => array( 8 => 'QF', 4 => 'SF', 2 => 'Final'),
		16 => array(16 => 'R1', 8 => 'QF', 4 => 'SF', 2 => 'Final'),
		32 => array(32 => 'R1', 16 => 'R2', 8 => 'QF', 4 => 'SF', 2 => 'Final'),
		64 => array(64 => 'R1', 32 => 'R2', 16 => 'R3', 8 => 'QF', 4 => 'SF', 2 => 'Final'),
		128 => array(128 => 'R1', 64 => 'R2', 32 => 'R3', 16 => 'R4', 8 => 'QF', 4 => 'SF', 2 => 'Final')
);

// make a table element
$html = '<table>';

$html.= '<tr>';

//round header words by setting "int_round" as header array index
foreach($arr_round_data[$int_player_total] as $key => $value)
	$html.= '<td class="center head">'.$arr_round_data[$int_player_total][$key].'</td>';

//add "Champion" header if you wanna put champion player's name below it.
$html.= '<td class="center head">Champion</td>';

$html.= '</tr>';

/* 
 * 1. begin to make a draw for some matches like tennis, table tennis and so on.
 * 2. r equals to ROW, c equals to COLUMN.
 * 3. r starts from 0, so does c.
 * */

for($r = 0; $r < $int_player_total; $r++)
{
	$html.= '<tr>';
	for($c = 0; $c <= $int_round; $c++)
	{
		//initialize some variables for CSS setting, meanwhile, set them empty.
		$str_class_underline = "";
		$str_class_left = "";
		$str_class_right = "";
		
		//because of zero as initial index, we need to get number less than last round, otherwise, it will print something redundant out.
		if( $c < $int_round )
		{
			/*
			 * it's my algorism to run this code as following code,
			 * you can analyze how it works or send a mail to me,
			 * I'll explain how I use for you.
			 * */
			
			//horizontal line
			if( ($r%((pow(2,$c)-1)*2+2)) == (pow(2,$c)-1) )
			{
				$str_class_underline = "underline";
			}

			//vertical line
			for($t = 0; $t < ($int_player_total*2/pow(2,$c+2)-1); $t++)
			{
				for($tt = pow(2,$c)+$t*pow(2, $c+2); $tt <= pow(2,$c)+$t*pow(2,$c+2)+pow(2,$c+1)-1; $tt++)
				{
					if( $r == $tt )
					{
						$str_class_right = "right";
					}
				}
			}
		}

		//print appropriate line when it's satisfied with above condition.
		$html.= '<td class="';
		$html.= $str_class_underline.' ';
		$html.= $str_class_left.' ';
		$html.= $str_class_right.' ';
		$html.= '">';
		
		//print my coordinate (you can set your player's name here)
		$html.= 'r='.$r.',c='.$c;
		
		$html.= '</td>';
	}
	$html.= '</tr>';
}

$html.= '</table>';

echo $html;
?>
</body>
</html>