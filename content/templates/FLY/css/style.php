<?php  
header('Content-type: text/css');  
ob_start("compress");  
function compress($buffer) {  
  /* 删除注释 */  
  $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);  
  /* 删除标签、空格、卡等. */  
  $buffer = str_replace(array(" 
", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);  
  return $buffer;  
}  
/* 你的CSS文件,可以多个 */  
include('font-awesome.min.css'); 
include('bootstrap.min.css'); 
include('swipebox.css'); 
include('style.css'); 
include('board.css');
include('set.css');
ob_end_flush(); 