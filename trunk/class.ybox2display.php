<?
error_reporting(E_ALL);
ini_set('display_errors',true);
ini_set('error_reporting',1);



/**

''     $00 = clear screen
''     $01 = home
''     $08 = backspace
''     $09 = tab (8 spaces per)
''     $0A = set X position (X follows)
''     $0B = set Y position (Y follows)
''     $0C = set color (color follows)
''     $0D = return
''  others = printable characters

example
//echo "".$home."".$home."".$color."                Information             ".$color."".$color."flick".$color."r".$color." photos tagged : unknown                                                  unknown                                 ".$color."(via Summize.com)".$color."                       unknown                                 ".$color."(via Technorati.com)".$color."                                                                                                                                                                                                                            

*/

class ybox2Display{

var $cls ;
var $home ;
var $backspace ;
var $tab ;
var $xpos ;
var $ypos ;
var $color ;
var $return;
var $base;
var $linelength;
var $blue;
var $red;
var $normal;
var $black;

public function __construct($title, $content)
{
$this->cls = chr('0');
$this->home = chr('1');
$this->backspace = chr('8');
$this->tab = chr('9');
$this->xpos = chr('10');
$this->ypos = chr('11');
$this->color = chr('12');

$this->blue = chr('4');
$this->red = chr('6');
$this->black = chr('2');
$this->normal = chr('8');

$this->return = chr('13');

$this->title = $title;
$this->content = $content;
$this->linelength = 40;

}


function setText($text){
$this->content= $text;
}

function header($title){
$title= str_pad($title,40 ," ", STR_PAD_BOTH);
$str = $this->color."".$title.$this->color."";
return $str;
}

function body($str)
{

$content = split("\n",$str);
foreach($content as $c){
$u[] = substr($c,0,$this->linelength);
}
$content = $u;

return $content;
}

function colorred()
{
return "asd";
}

function display()
{
$output= $this->map_content($this->header($this->title),$this->body($this->content));

return $output;
}

function numColors($line){
	$num = 0;
	for($i=0; $i <strlen($line);$i++)
	{
		if ($this->red == $line[$i])$num +=2;
		if ($this->normal== $line[$i])$num +=2;
		if ($this->black== $line[$i]) $num +=2;
		if ($this->blue== $line[$i]) $num +=2;
	}

	return $num;
}

function pad_string($str,$sub = 0)
{

return str_pad($str,$this->linelength-$sub+$this->numColors($str)," ",STR_PAD_RIGHT);
}

function map_content($headline,$content)
{

$base = $this->base;
$c[0]=$this->pad_string($headline,$sub=9);
for ($i=0;$i<11;$i++)
{
$c[$i+1] = $this->pad_string($content[$i]);

}

$str = implode("",$c);
return $str;

}

function redtext($text)
{
$text = $this->color.$this->red.$text.$this->color.$this->normal;
return $text;
}
function blacktext($text)
{
$text = $this->color.$this->black.$text.$this->color.$this->normal;
return $text;
}

/*
*/
}

$text = "@@@@@@@@  @@@  @@@   @@@@@@@  @@@  @@@  
@@@@@@@@  @@@  @@@  @@@@@@@@  @@@  @@@  
@@!       @@!  @@@  !@@       @@!  !@@  
!@!       !@!  @!@  !@!       !@!  @!!  
@!!!:!    @!@  !@!  !@!       @!@@!@!   
!!!!!:    !@!  !!!  !!!       !!@!!!    
!!:       !!:  !!!  :!!       !!: :!!   
:!:       :!:  !:!  :!:       :!:  !:!  
 ::       ::::: ::   ::: :::   ::  :::  
 :         : :  :    :: :: :   :   :::  
                  OFF
";


$title = date("F j, Y, g:i:s a");
$yb = new ybox2Display($title,"");
$yb->setText($text);
print $yb->display();
