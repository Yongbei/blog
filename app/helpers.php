<?php

function flash($msg) {
	session()->flash('msg', $msg);
}