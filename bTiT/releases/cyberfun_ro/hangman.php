<?php

require_once("include/functions.php");
require_once("include/config.php");


dbconn();


if ($CURUSER["view_news"]=="yes")
{
standardheader("hangman");
block_begin("Hangman");
/*
#####################################################################
# PHP Hangman Game #
# Version 1.2.0 #
# ©2002,2003 0php.com - Free PHP Scripts #
#####################################################################

#####################################################################
# #
# Author : 0php.com #
# Created : July 12, 2002 #
# Modified : March 22, 2004 #
# E-mail : webmaster@0php.com #
# Website : http://www.0php.com/ #
# License : FREE (GPL); See Copyright and Terms below #
# #
# Donations accepted via PayPal to webmaster@0php.com #
# #
#####################################################################

>> Copyright and Terms:

This software is copyright © 2002-2004 0php.com. It is distributed
under the terms of the GNU General Public License (GPL). Because it is licensed
free of charge, there is NO WARRANTY, it is provided AS IS. The author can not
be held liable for any damage that might arise from the use of this software.
Use it at your own risk.

All copyright notices and links to 0PHP.com website MUST remain intact in the scripts and in the HTML for the scripts.

For more details, see http://www.0php.com/license_GNU_GPL.php (or http://www.gnu.org/).

>> Installation
Copy the PHP script and images to the same directory. You can optionally edit the category and list of words/phrases to solve below. You can also add additional characters to $additional_letters and/or $alpha if you want to use international (non-English) letters or other characters not included by default (see further instructions below for those).

To prevent Google from playing hangman, add the line below between <HEAD> and </HEAD>:
<META NAME="robots" CONTENT="NOINDEX,NOFOLLOW">


================================================================================
=======*/


// $Category = "Web Programming";

# list of words (phrases) to guess below, separated by new line
$list = "JAVA BEANS
PHP SCRIPTS
SOURCE CODE
JAVASCRIPT GAMES
SSI IS SERVER SIDE INCLUDES
BILL GATES
COOKIES
HTTP AUTHENTICATION
ERROR HANDLING
MANIPULATING IMAGES
FILE UPLOADS
DATABASE CONNECTION
APACHE SERVER
ZIP FILE
TAR COMPRESSION
FUNCTIONS
ENCRYPTION
MYSQL DATABASE
INITIALIZATION
FAQ - FREQUENTLY ASKED QUESTIONS
DEBUGGING
VERIFICATION
HTML VALIDATION
CASCADING STYLE SHEETS
GAY
FUCK
YOUR MOTHER
YOUR FATHER
DICK
HEAD
SUCK
HELLO
PUSSY
babied
backward
bad
badgered
baffled
baited
chicken
chided
childish
childless
childlike
chipper
chivalrous
choked
choked-up
chosen
churlish
circumspect
disheartened
disheveled
dishonest
dishonorable
dishonored
disillusioned
disinclined
diplomatic
direct
directionless
dirty
disabled
fine
finicky
finished
fired
firm
first
first-class
first-rate
fit
fixated
flabbergasted
flagellated
flaky
flamboyant
flammable
flappable
flat
flattered
flawed
fledgling
fleeced
flexible
flighty
flippant
flipped-out
flirtatious
floored
floundering
flourishing
flush
gallant
galled
game
gauche
gaudy
gawky
gay
generous
genial
gentle
genuine
giddy
gifted
giggly
gilded
giving
glad
glamorous
gleeful
glib
heady
healed
health-conscious
healthy
heard
heartbroken
heartened
heartful
heartless
heartsick
in pain
in the dumps
in the way
in touch
in tune
inaccessible
inadequate
inappropriate
inattentive
incapable
incapacitated
incensed
incoherent
incommunicative
incompetent
incomplete
inconclusive
influential
informed
infuriated
infused
ingenious
ingenuous
ingratiated
ingratiating
inhibited
inhospitable
inhumane
inimical
injured
innocent
innovative
inquiring
inquisitive
insane
insatiable
keen
kept
kept away
kept out
kicked
kicked around
kidded
kind
kindhearted
kindly
kinky
knackered
knocked
knocked down
knocked out
knowledgeable
loud
lousy
lovable
love
loved
loveless
lovely
loving
low
lowly
low-spirited
loyal
luckless
lucky
ludicrous
luminous
lured
luring
lust
lustful
lusty
lynched
maternal
mature
maudlin
meager
mean
mechanical
medicated
mediocre
meditative
meek
melancholic
melancholy
melded
mellow
melodramatic
menaced
menacing
merciful
merry";


# make sure that any characters to be used in $list are in either
# $alpha OR $additional_letters, but not in both. It may not work if you change fonts.
# You can use either upper OR lower case of each, but not both cases of the same letter.

# below ($alpha) is the alphabet letters to guess from.
# you can add international (non-English) letters, in any order, such as in:
# $alpha = "¿¡¬√ƒ≈∆«»… ÀÃÕŒœ—“”‘’÷ÿŸ⁄€‹›üABCDEFGHIJKLMNOPQRSTUVWXYZ";
$alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

# below ($additional_letters) are extra characters given in words; '?' does not work
# these characters are automatically filled in if in the word/phrase to guess
$additional_letters = " -.,;!?%&0123456789";

#========= do not edit below here ======================================================


echo<<<endHTML
<HTML><HEAD><TITLE>Play PHP Hangman Game</TITLE>
<META NAME="DESCRIPTION" CONTENT="Hangman">
<meta content="text/html; charset=windows-1252" http-equiv=content-type>
</HEAD>

<BODY bgColor="#CCCCCC" link="navy" vlink="navy" alink="navy">
<DIV ALIGN="center">
endHTML;

$len_alpha = strlen($alpha);

if(isset($_GET["n"])) $n=$_GET["n"];
if(isset($_GET["letters"])) $letters=$_GET["letters"];
if(!isset($letters)) $letters="";

if(isset($PHP_SELF)) $self=$PHP_SELF;
else $self=$_SERVER["PHP_SELF"];

$links="";






$max=6; # maximum number of wrong
# error_reporting(0);
$list = strtoupper($list);
$words = explode("\n",$list);
srand ((double)microtime()*1000000);
$all_letters=$letters.$additional_letters;
$wrong = 0;

echo "<P><B>Play PHP Hangman Game</B><BR>\n";

if (!isset($n)) { $n = rand(1,count($words)) - 1; }
$word_line="";
$word = trim($words[$n]);
$done = 1;
for ($x=0; $x < strlen($word); $x++)
{
if (strstr($all_letters, $word[$x]))
{
if ($word[$x]==" ") $word_line.="&nbsp; "; else $word_line.=$word[$x];
}
else { $word_line.="_<font size=1>&nbsp;</font>"; $done = 0; }
}

if (!$done)
{

for ($c=0; $c<$len_alpha; $c++)
{
if (strstr($letters, $alpha[$c]))
{
if (strstr($words[$n], $alpha[$c])) {$links .= "\n<B>$alpha[$c]</B> "; }
else { $links .= "\n<FONT color=\"red\">$alpha[$c] </font>"; $wrong++; }
}
else
{ $links .= "\n<A HREF=\"$self?letters=$alpha[$c]$letters&n=$n\">$alpha[$c]</A> "; }
}
$nwrong=$wrong; if ($nwrong>6) $nwrong=6;
echo "\n<p><BR>\n<IMG SRC=\"images/hangman_$nwrong.gif\" ALIGN=\"MIDDLE\" BORDER=0 WIDTH=100 HEIGHT=100 ALT=\"Wrong: $wrong out of $max\">\n";

if ($wrong >= $max)
{
$n++;
if ($n>(count($words)-1)) $n=0;
echo "<BR><BR><H1><font size=5>\n$word_line</font></H1>\n";
echo "<p><BR><FONT color=\"red\"><BIG>SORRY, YOU ARE HANGED!!!</BIG></FONT><BR><BR>";
if (strstr($word, " ")) $term="phrase"; else $term="word";
echo "The $term was \"<B>$word</B>\"<BR><BR>\n";
echo "<A HREF=$self?n=$n>Play again.</A>\n\n";
}
else
{
echo " &nbsp; # Wrong Guesses Left: <B>".($max-$wrong)."</B><BR>\n";
echo "<H1><font size=5>\n$word_line</font></H1>\n";
echo "<P><BR>Choose a letter:<BR><BR>\n";
echo "$links\n";
}
}
else
{
$n++; # get next word
if ($n>(count($words)-1)) $n=0;
echo "<BR><BR><H1><font size=5>\n$word_line</font></H1>\n";
echo "<P><BR><BR><B>Congratulations!!! &nbsp;You win!!!</B><BR><BR><BR>\n";
echo "<A HREF=$self?n=$n>Play again</A>\n\n";
}

echo<<<endHTML

<p align="center"><BR><BR><font face="Verdana" size="1">PHP Hangman Game - Version 1.2.0<br>


</DIV></BODY></HTML>

endHTML;
}
	else
	{
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	}
block_end();
stdfoot();
?>