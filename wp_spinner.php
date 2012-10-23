<?php
/*
	Plugin Name: Wordpress Spinner
	Plugin URI: http://www.bradsinfo.com
	Description: A wordpress plugin that dynamically rewrites article content using contractions and conjunctions
	Version: 2.0
	Author: Brad
	Author URI: http://www.bradsinfo.com

	Wordpress Spinner 2.0 - A wordpress plugin that dynamically rewrites article content
	Copyright (C) 2010 Brad - slattman@gmail.com
	
	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

$contractions = array(
	" I'm " => " I am ",
	" I'll " => " I will ",
	" I'd " => " I would ",
	" I've " => " I have ",
	" you're " => " you are ",
	" you'll " => " you will ",
	" you'd " => " you would ",
	" you've " => " you have ",
	" he's " => " he is ",
	" he'll " => " he will ",
	" he'd " => " he would ",
	" she's " => " she is ",
	" she'll " => " she will ",
	" she'd " => " she would ",
	" she'd " => " she had ",
	" it's " => " it is ",
	" it'll " => " it will ",
	" it'd " => " it would ",
	" we're " => " we are ",
	" we'll " => " we will ",
	" we'd " => " we would ",
	" we've " => " we have ",
	" they're " => " they are ",
	" there's " => " there are ",
	" they'll " => " they will ",
	" they'd " => " they would ",
	" they've " => " they have ",
	" that's " => " that is ",
	" that'll " => " that will ",
	" that'd " => " that would ",
	" who's " => " who is ",
	" who'll " => " who will ",
	" who'd " => " who would ",
	" what's " => " what is ",
	" what'll " => " what will ",
	" what'd " => " what would ",
	" where's " => " where is ",
	" where'll " => " where will ",
	" where'd " => " where would ",
	" where'd " => " where had ",
	" when's " => " when is ",
	" when'll " => " when will ",
	" when'd " => " when would ",
	" why's " => " why is ",
	" why'll " => " why will ",
	" why'd " => " why would ",
	" how's " => " how is ",
	" how'll " => " how will ",
	" how'd " => " how would ",
	" isn't " => " is not ",
	" aren't " => " are not ",
	" wasn't " => " was not ",
	" weren't " => " were not ",
	" haven't " => " have not ",
	" hasn't " => " has not ",
	" hadn't " => " had not ",
	" won't " => " will not ",
	" wouldn't " => " would not ",
	" don't " => " do not ",
	" doesn't " => " does not ",
	" didn't " => " did not ",
	" can't " => " cannot ",
	" couldn't " => " could not ",
	" shouldn't " => " should not ",
	" mightn't " => " might not ",
	" mustn't " => " must not ",
	" would've " => " would have ",
	" should've " => " should have ",
	" could've " => " could have ",
	" might've " => " might have ",
	" must've " => " must have "
);

$conjunctions = array(
	' hi ' => ' what is up ',
	' and ' => ' as well as ',
	' but ' => ' however ',
	' because ' => ' due to the fact that ',
	' because of ' => ' due to ',
	' are another ' => ' are also ',
	' very safe ' => ' secure ',
	' you need to ' => ' you have to ',
	' is a ' => ' is simply a ',
	' give up ' => ' quit ',
	' has to be ' => ' should be ',
	' have to be ' => ' should be ',
	' one of the ' => ' among one of the ',
	' tap into ' => ' get into ',
	' quite a ' => ' a rather ',
	' are quite ' => ' are rather ',
	' except ' => ' but ',
	' have to ' => ' gotta ',
	' handy ' => ' useful ',
	' makes you happy ' => ' floats your boat ',
	' even know ' => ' really know ',
	' probably ' => ' most likely ',
	' therefore ' => ' so ',
	' using ' => ' utilizing ',
	' a lot of ' => ' quite a few ',
	' not just to ' => ' not only to ',
	' proper ' => ' appropriate ',
	
);

function wp_spinner($txt) {

	global $contractions,  $conjunctions;

	$txt = iconv(mb_detect_encoding($txt), 'ASCII//TRANSLIT//IGNORE', $txt);

	$txt = str_replace("\n", "", $txt);
	$txt = str_replace("\r", "", $txt);
	$txt = str_replace("\t", "", $txt);
	$txt = " ".$txt;

	foreach ($conjunctions as $a => $r) {
		$txt = str_replace(".", " ", $txt);
		if (!rand(0, 1)) {
			$txt = str_replace($a, $r, $txt);
			$txt = str_replace(str_replace("'", "", $a), $r, $txt);
			$txt = str_replace(cap($a), cap($r), $txt);
			$txt = str_replace(str_replace("'", "", cap($a)), cap($r), $txt);
		} else {
			$txt = str_replace($r, $a, $txt);
			$txt = str_replace($r, str_replace("'", "", $a), $txt);
			$txt = str_replace(cap($r), cap($a), $txt);
			$txt = str_replace(cap($r), str_replace("'", "", cap($a)), $txt);
		}
		$txt = str_replace("  ", ". ", $txt);
	}

	foreach ($contractions as $a => $r) {
		$txt = str_replace(".", " ", $txt);
		if (!rand(0, 1)) {
			$txt = str_replace($a, $r, $txt);
			$txt = str_replace(str_replace("'", "", $a), $r, $txt);
			$txt = str_replace(cap($a), cap($r), $txt);
			$txt = str_replace(str_replace("'", "", cap($a)), cap($r), $txt);
		} else {
			$txt = str_replace($r, $a, $txt);
			$txt = str_replace($r, str_replace("'", "", $a), $txt);
			$txt = str_replace(cap($r), cap($a), $txt);
			$txt = str_replace(cap($r), str_replace("'", "", cap($a)), $txt);
		}
		$txt = str_replace("  ", ". ", $txt);
	}

	return substr($txt,1,strlen($txt)-1);
}

function cap($txt) {
	if (substr($txt,0,1) == " ") {
		$txt = " ".ucfirst(substr($txt,1,strlen($txt)));
	} else {
		$txt = ucfirst($txt);
	}
	return $txt;
}

add_filter('the_content', 'wp_spinner');
add_filter('the_excerpt', 'wp_spinner');


?>